	$(function(){
		$table="";
		var dept=$('span#dept_n').html();
		if( ! $.fn.DataTable.isDataTable("#table_dept_program")){
		$table=$('#table_dept_program').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":{
			"url":"SSP/serverside_programs.php",
			"method":"POST",
			"data":{dept:dept}
			}
			});
		}

});