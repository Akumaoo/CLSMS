$(function(){
$table="";
$data=$('span#dept').text();
	if( ! $.fn.DataTable.isDataTable("#table_RS_notif")){
	$table=$('#table_RS_notif').DataTable({			
	"processing":true,
	"serverSide":true,
	"order":[[0,"desc"]],
	"searching":true,
	"ajax":
		{"url":"SSP/serverside_RS_NOTIF.php",
		"method":"POST",
		"data":{data:$data}
		}
		});
	}

	$('#table_RS_notif').on('draw.dt', function() {
		
		$('tbody tr td:nth-child(1)').addClass('rsID');
		$('tbody tr td:nth-child(3)').addClass('progName');
		$('tbody tr td:nth-child(4)').addClass('ser_click');

		$(".ser_click").click(function(){
			var sername=$(this).text();
			var RSID=$(this).closest('tr').find('.rsID').text();
			var prog=$(this).closest('tr').find('.progName').text();
			$.ajax({
			type:'POST',
			url:'View_RS_Serial.php',
			data:{sername:sername,RSID:RSID,prog:prog,type:'received'},
			success:function(data){
				$('.main-chart').html(data)
			}
			});
			// alert(prog);
		});
	});

});