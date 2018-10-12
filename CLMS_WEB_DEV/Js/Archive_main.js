$(function(){

	if( !$.fn.DataTable.isDataTable("#table_subs")){
		$('#table_subs').DataTable({			
			"processing":true,
			"serverSide":true,
			"ordering":true,
			"searching":true,
			"pageLength":50,
			"ajax":"SSP/serverside_archiving.php",
			"columnDefs":
				[{
					"targets":[0,3,4,5],
					"searchable":false,
				}]
		});
	}
	 
	$('#archive_btn').click(function(){
		$.ajax({
			url:'php_codes/Archive_Data.php',
			method:'POST',
			data:{data_type:'Count_Archive'},
			success:function(data)
			{
				$('.arch_value').text(data);
				$('#Verfiy_Modal').modal('show');
			}
		});
	});


});