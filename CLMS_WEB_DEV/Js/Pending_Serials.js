$(function(){
$table="";
$data=$('span#dept').text();
$date=$('span#date').text();
	if( ! $.fn.DataTable.isDataTable("#table_pending_ser")){
	$table=$('#table_pending_ser').DataTable({			
	"processing":true,
	"serverSide":true,
	"order":[[0,"desc"]],
	"searching":true,
	"ajax":
		{"url":"SSP/serverside_Pending_Serials.php",
		"method":"POST",
		"data":{data:$data,date:$date}
		}
		});
	}


	$('#table_pending_ser').on('draw.dt', function() {
		
		$('tbody tr td:nth-child(1)').addClass('rsID');
		$('tbody tr td:nth-child(3)').addClass('ser_click');

		$(".ser_click").click(function(){
			var sername=$(this).text();
			var RSID=$(this).closest('tr').find('.rsID').text();
			$.ajax({
			type:'POST',
			url:'View_RS_Serial.php',
			data:{sername:sername,RSID:RSID},
			success:function(data){
				$('.main-chart').html(data)
			}
			});
		});
	});
});