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



	$('#arch').closest('li.sub-menu').find('a.dcjq-parent').addClass('active');
 	$('#arch').closest('li.sub-menu ul.sub').css('display', 'block');
 	$('#arch').addClass('active');

 	$('#btn_yes').click(function(){
		$.ajax({
			method:'POST',
			url:'php_codes/Archive_Data.php',
			data:{data_type:'Archive_datas'},
			success:function(data){

				$('#Verfiy_Modal').modal('hide');

				if(data=='complete_archive')
				{
					if(!$('#msg_fail_archive').hasClass('collapse'))
					{
						$('#msg_fail_archive').addClass('collapse');
					}
					else if(!$('#msg_warning_archive').hasClass('collapse'))
					{
						$('#msg_warning_archive').addClass('collapse');
					}

					$('#msg_scs_archive').removeClass('collapse');
				}
				else if(data=='error_archive')
				{
					if(!$('#msg_scs_archive').hasClass('collapse'))
					{
						$('#msg_scs_archive').addClass('collapse');
					}
					else if(!$('#msg_warning_archive').hasClass('collapse'))
					{
						$('#msg_warning_archive').addClass('collapse');
					}

					$('#msg_fail_archive').removeClass('collapse');
				}
				else
				{
					if(!$('#msg_scs_archive').hasClass('collapse'))
					{
						$('#msg_scs_archive').addClass('collapse');
					}
					else if(!$('#msg_fail_archive').hasClass('collapse'))
					{
						$('#msg_fail_archive').addClass('collapse');
					}

					$('#msg_warning_archive').removeClass('collapse');
				}
			}
		});
	});

	$('#btn_no').click(function() {
		$('#Verfiy_Modal').modal('hide');
	});


});