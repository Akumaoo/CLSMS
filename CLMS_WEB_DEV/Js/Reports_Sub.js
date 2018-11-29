$(function(){
	$table="";
	if(!$.fn.DataTable.isDataTable("#Reports_Sub")){
	$table=$('#Reports_Sub').DataTable({			
	"processing":true,
	"serverSide":true,
	"ordering":true,
	"searching":true,
	"ajax":"SSP/serverside_Reports_Sub.php"
		});
	}

	
 	$('#report_subs').closest('li.sub-menu').find('a.dcjq-parent').addClass('active');
 	$('#report_subs').closest('li.sub-menu ul.sub').css('display', 'block');
 	$('#report_subs').addClass('active');

 	$('#table_MS_wrapper').removeClass('form-inline');

 	
});
