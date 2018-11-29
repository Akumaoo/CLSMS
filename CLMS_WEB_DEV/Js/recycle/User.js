$(function(){

$table_MS="";
	if(!$.fn.DataTable.isDataTable("#table_user")){
	$table_MS=$('#table_user').DataTable({			
	"processing":true,
	"serverSide":true,
	"ordering":true,
	"searching":true,
	"ajax":"SSP/recycle/serverside_users.php"
		});
	}

$('#table_user').on('draw.dt', function() {

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('#th_add').remove();
			$('tbody>tr>td:nth-child(2)').remove();

			if(!$('#PRS').hasClass('collapse'))
			{
				$('#PRS').addClass('collapse');
				$('#RS').addClass('collapse');
			}
		}
		else
		{
		
			// RECYCLE
			$checkele=document.getElementById('th_add');
			if(!$checkele)
			{
				$('thead>tr').append('<th id="th_add" class="radio-label-center" tabindex="0" aria-controls="table_user" rowspan="1" colspan="1" style="width: 63px; font-size:10px">Check All <br><input type="checkbox" id="SA_ser" value="SA"> </th>');

				$('#SA_ser').on('change',function(){
					if($(this).prop('checked'))
					{
						$('.cb_ser').each(function(){
							$(this).prop('checked',true);
						});
					}
				});
			}

			   $('tbody>tr').append('<td><input type="checkbox" class="cb_ser" style="margin-left:25px"></td>');
			$('thead>tr>th:nth-child(9)').addClass('collapse');
			$('tbody>tr>td:nth-child(9)').addClass('collapse');
		}
	});

 	$('#cog_action').click(function(){

 		if($('thead>tr>th:nth-child(9)').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child(9)').removeClass('collapse');
			$('tbody>tr>td:nth-child(9)').removeClass('collapse');
			$('#PRS').removeClass('collapse');
			$('#RS').removeClass('collapse');
			
 		}
 		else
 		{

 			$('thead>tr>th:nth-child(9)').addClass('collapse');
			$('tbody>tr>td:nth-child(9)').addClass('collapse');
			$('#PRS').addClass('collapse');
			$('#RS').addClass('collapse');
 		}
 	});

	$('#RS').click(function(){

 		if(CheckList())
 		{
	 		$ret_list=[];
	 		$('.cb_ser').each(function(){
	 			if($(this).prop('checked'))
	 			{	
	 				$sID=$(this).closest('tr').find('.sorting_1').html();
	 				$ret_list.push($sID);
	 			}
	 		});

	 		$.ajax({
	 			url:"php_codes/recycle/modify_User.php",
	 			method:"POST",
	 			data:{action:'retrieve',ret_list:$ret_list},
	 			success:function(){

	 				if(!$('#msg_scs_remove').hasClass('collapse'))
	 				{
	 					$('#msg_scs_remove').addClass('collapse');
	 				}

	 				$('#msg_scs_update').removeClass('collapse');
	 				$table_MS.ajax.reload(null,false);

	 			}
	 		});
 		}
 		else
 		{
 			alert('Nothing Is Selected!');
 		}
 	});
 	function CheckList()
 	{
 		$inc=0;
 		$('.cb_ser').each(function(){
	 			if($(this).prop('checked'))
	 			{	
	 				$inc++;
	 			}
	 	});

	 	if($inc==0)
	 	{
	 		return false;
	 	}
	 	else
	 	{
	 		return true;
	 	}
 	}

 	$('#PRS').click(function(){

 		if(CheckList())
 		{
	 		if(confirm("Are You Sure You Want To Permanently Delete Data?"))
	 		{
		 		$ret_list=[];

		 		$('.cb_ser').each(function(){
		 			if($(this).prop('checked'))
		 			{	
		 				$sID=$(this).closest('tr').find('.sorting_1').html();
		 				$ret_list.push($sID);
		 			}
		 		});

		 		$.ajax({
		 			url:"php_codes/recycle/modify_User.php",
		 			method:"POST",
		 			data:{action:'PRS',ret_list:$ret_list},
		 			success:function(){

		 				if(!$('#msg_scs_update').hasClass('collapse'))
		 				{
		 					$('#msg_scs_update').addClass('collapse');
		 				}

		 				$('#msg_scs_remove').removeClass('collapse');
		 				$table_MS.ajax.reload(null,false);

		 			}
		 		});
	 		}
 		}
 		else
 		{
 			alert('Nothing Is Selected!');
 		}
 		
 	});
});