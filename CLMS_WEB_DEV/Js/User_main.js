$(function(){

	if( !$.fn.DataTable.isDataTable("#table_user")){
		$('#table_user').DataTable({			
		"ordering":true,
		"searching":true,
		"pageLength":100
		});
	}

	$('#table_user').Tabledit({
		url:"php_codes/modify_user.php",
		columns:{
		identifier:[0,"UserID"],
		editable:[]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.UserID).remove();			
			}
		},onDraw: function() 
		{		
			function getdepts(){
				$val=[];				
				$.ajax({
					url:'php_codes/get_depts.php',
					method:"POST",
					success:function(data){
						$val=data;
					},
					async:false
					});
				return $val;
			}
			$return_depts=getdepts();
			$option="";
			for($x=0;$x<$return_depts.length;$x++)
			{	
				$option+='<option value="'+$return_depts[$x]+'">'+$return_depts[$x]+'</option>';
			}

			$('tbody tr td:nth-child(7)>input').each(function(){		 					

			$('<select class="tabledit-input form-control input-sm" style="display: none;" disabled=""><option style="display: none" value="stat">--Status--</option>'+$option+'</select>').attr({ name: this.name, value: this.value }).insertBefore(this)				
			}).remove()

			$('button.tabledit-edit-button').remove();
 		}
	
	});
	
	$('#Add_User').on('submit',function(event){
		event.preventDefault();

		var form = $('#Add_User')[0];
		var data = new FormData(form);

	 	if($("#FN").val()=="")
	 	{
	 		alert("First Name Is Required");
	 	}
	 	else if($("#LN").val()=="")
	 	{
	 		alert("Last Name Is Required");
	 	}
	 	else if($('#mail').val()=="")
	 	{
	 		alert('Email Is Required');
	 	}
	 	else if($("#username").val()=="")
	 	{
	 		alert('Username Is Required');
	 	}
	 	else if($("#pass1").val()=="")
	 	{
	 		alert('Password Is Required');
	 	}
	 	else if($("#pass2").val()=="")
	 	{
	 		alert('Confirm Password Is Required');
	 	}
	 	else if($('#pass1').val()!=$('#pass2').val())
	 	{
	 		alert('Confirm Password Did Not Match');
	 	}
	 	else if($("#role").val()=="stat")
	 	{
	 		alert('User Role Is Required');
	 	}
	 	else if($("#dept").val()=="stat")
	 	{
	 		alert('Department Is Required');
	 	}
	 	else if($("#ava").val()=="")
	 	{
	 		alert('Avatar Is Required');
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_User.php",
	 			method:"POST",
	 			enctype: 'multipart/form-data',
	 			processData:false,
	 			contentType: false,
	 			data:data,
	 			success:function(data)
	 			{
 					$("#Add_User")[0].reset();
 					$("#add_user_modal").modal('hide');
 					if(data.status=='success')
 					{
 						$("#msg_scs").removeClass('collapse');

 					}
 					else
 					{
 						$("#msg_fail").removeClass('collapse');
 						alert(data.status);
 					}
	 			}
	 		});
	 	}
	});

	

});