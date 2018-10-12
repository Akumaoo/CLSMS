$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_MS")){
			$('#table_MS').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_manage_serials.php"
			});
		}

});