$(function(){

	$('.rs_content').click(function(){
		$serial=$(this).closest('.rs-notif').find('strong.rs_dept').text();
		$dept=$('#dept_branch').text();

		$.ajax({
			url:'php_codes/Receive_Seen.php',
			method:'POST',
			data:{sn:$serial,dept:$dept,type:'seen'},
			success:function(data)
			{
				if(data=='success')
				{
					$('#sn').val($serial);
					$('#Receive_Modal').modal('show');

				}

			}
		})
	});

	$reload=false;
	$('#Receive_Modal').on('hidden.bs.modal', function(){
		$('#cn').val('');
		$('#comm').val('');
		if($reload)
		{
			location.reload(true);
			$reload=false;
		}
	});

	$('#SEND_RECEIVE').on('submit',function(event){
		event.preventDefault();
	 	if($("#cn").val()=="")
	 	{
	 		alert("Control Number Is Required");
	 	}
	 	else{
	 		$cont=$('#cn').val();
			$comm=$('#comm').val();
			$serial=$('#sn').val();
			$dept=$('#dept_branch').text();

	 		$.ajax({
	 			url:'php_codes/Receive_Seen.php',
	 			method:"POST",
	 			data:{cono:$cont,coms:$comm,ser:$serial,depart:$dept,type:'receive'},
	 			success:function(data)
	 			{	
	 				if(data=='success')
	 				{
	 					$("#SEND_RECEIVE")[0].reset();
 						$('#Receive_Modal').modal('hide');
 						$reload=true;

 					}

	 			}
	 		});
	 	}
	});

});