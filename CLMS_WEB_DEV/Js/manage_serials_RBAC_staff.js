$(function(){

	$dept=$('strong#dept').html();
	if(!$.fn.DataTable.isDataTable("#table_MS")){
	$('#table_MS').DataTable({			
	"processing":true,
	"serverSide":true,
	"ordering":true,
	"searching":true,
	"ajax":{
		"url":"SSP/serverside_LOS_Staff.php",
		"method":'POST',
		"data":{dept:$dept}}
		});
	}

});