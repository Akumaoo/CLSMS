$(function(){
	
 	$('#rb').addClass('active');

 	$('#table_MS_wrapper').removeClass('form-inline');

 	$.ajax({
 			url:"recycle/manage_serials.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 	});

 	$('#rb_ser').addClass('btn-active');


// NAV
 	$('#rb_ser').click(function(){

	if($('#rb_disb').hasClass('btn-active'))
	{
		$('#rb_disb').removeClass('btn-active');
	}
	else if($('#rb_dept').hasClass('btn-active'))
	{
		$('#rb_dept').removeClass('btn-active');
	}
	else if($('#rb_user').hasClass('btn-active'))
	{
		$('#rb_user').removeClass('btn-active');
	}
	else if($('#rb_ps').hasClass('btn-active'))
	{
		$('#rb_ps').removeClass('btn-active');
	}
	else if($('#rb_subs').hasClass('btn-active'))
	{
		$('#rb_subs').removeClass('btn-active');
	}
	else if($('#rb_org').hasClass('btn-active'))
	{
		$('#rb_org').removeClass('btn-active');
	}


 		$(this).addClass('btn-active');

 		$.ajax({
 			url:"recycle/manage_serials.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 		});
 	});

 	$('#rb_disb').click(function(){

 		if($('#rb_ser').hasClass('btn-active'))
		{
			$('#rb_ser').removeClass('btn-active');
		}
		else if($('#rb_dept').hasClass('btn-active'))
		{
			$('#rb_dept').removeClass('btn-active');
		}
		else if($('#rb_user').hasClass('btn-active'))
		{
			$('#rb_user').removeClass('btn-active');
		}
		else if($('#rb_ps').hasClass('btn-active'))
		{
			$('#rb_ps').removeClass('btn-active');
		}
		else if($('#rb_subs').hasClass('btn-active'))
		{
			$('#rb_subs').removeClass('btn-active');
		}
		else if($('#rb_org').hasClass('btn-active'))
		{
			$('#rb_org').removeClass('btn-active');
		}

 		$(this).addClass('btn-active');

 		$.ajax({
 			url:"recycle/Distributors.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 		});
 	});

 	$('#rb_dept').click(function(){

 		if($('#rb_ser').hasClass('btn-active'))
		{
			$('#rb_ser').removeClass('btn-active');
		}
		else if($('#rb_disb').hasClass('btn-active'))
		{
			$('#rb_disb').removeClass('btn-active');
		}
		else if($('#rb_user').hasClass('btn-active'))
		{
			$('#rb_user').removeClass('btn-active');
		}
		else if($('#rb_ps').hasClass('btn-active'))
		{
			$('#rb_ps').removeClass('btn-active');
		}
		else if($('#rb_subs').hasClass('btn-active'))
		{
			$('#rb_subs').removeClass('btn-active');
		}
		else if($('#rb_org').hasClass('btn-active'))
		{
			$('#rb_org').removeClass('btn-active');
		}

 		$(this).addClass('btn-active');

 		$.ajax({
 			url:"recycle/Dept.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 		});
 	});

 	$('#rb_user').click(function(){

 		if($('#rb_ser').hasClass('btn-active'))
		{
			$('#rb_ser').removeClass('btn-active');
		}
		else if($('#rb_disb').hasClass('btn-active'))
		{
			$('#rb_disb').removeClass('btn-active');
		}
		else if($('#rb_dept').hasClass('btn-active'))
		{
			$('#rb_dept').removeClass('btn-active');
		}
		else if($('#rb_ps').hasClass('btn-active'))
		{
			$('#rb_ps').removeClass('btn-active');
		}
		else if($('#rb_subs').hasClass('btn-active'))
		{
			$('#rb_subs').removeClass('btn-active');
		}
		else if($('#rb_org').hasClass('btn-active'))
		{
			$('#rb_org').removeClass('btn-active');
		}

 		$(this).addClass('btn-active');

 		$.ajax({
 			url:"recycle/User.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 		});
 	});

 	$('#rb_ps').click(function(){

 		if($('#rb_ser').hasClass('btn-active'))
		{
			$('#rb_ser').removeClass('btn-active');
		}
		else if($('#rb_disb').hasClass('btn-active'))
		{
			$('#rb_disb').removeClass('btn-active');
		}
		else if($('#rb_dept').hasClass('btn-active'))
		{
			$('#rb_dept').removeClass('btn-active');
		}
		else if($('#rb_user').hasClass('btn-active'))
		{
			$('#rb_user').removeClass('btn-active');
		}
		else if($('#rb_subs').hasClass('btn-active'))
		{
			$('#rb_subs').removeClass('btn-active');
		}
		else if($('#rb_org').hasClass('btn-active'))
		{
			$('#rb_org').removeClass('btn-active');
		}

 		$(this).addClass('btn-active');

 		$.ajax({
 			url:"recycle/PS.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 		});
 	});

 	$('#rb_subs').click(function(){

 		if($('#rb_ser').hasClass('btn-active'))
		{
			$('#rb_ser').removeClass('btn-active');
		}
		else if($('#rb_disb').hasClass('btn-active'))
		{
			$('#rb_disb').removeClass('btn-active');
		}
		else if($('#rb_dept').hasClass('btn-active'))
		{
			$('#rb_dept').removeClass('btn-active');
		}
		else if($('#rb_user').hasClass('btn-active'))
		{
			$('#rb_user').removeClass('btn-active');
		}
		else if($('#rb_ps').hasClass('btn-active'))
		{
			$('#rb_ps').removeClass('btn-active');
		}
		else if($('#rb_org').hasClass('btn-active'))
		{
			$('#rb_org').removeClass('btn-active');
		}

 		$(this).addClass('btn-active');

 		$.ajax({
 			url:"recycle/Subs.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 		});
 	});

 	$('#rb_org').click(function(){

 		if($('#rb_ser').hasClass('btn-active'))
		{
			$('#rb_ser').removeClass('btn-active');
		}
		else if($('#rb_disb').hasClass('btn-active'))
		{
			$('#rb_disb').removeClass('btn-active');
		}
		else if($('#rb_dept').hasClass('btn-active'))
		{
			$('#rb_dept').removeClass('btn-active');
		}
		else if($('#rb_user').hasClass('btn-active'))
		{
			$('#rb_user').removeClass('btn-active');
		}
		else if($('#rb_ps').hasClass('btn-active'))
		{
			$('#rb_ps').removeClass('btn-active');
		}
		else if($('#rb_subs').hasClass('btn-active'))
		{
			$('#rb_subs').removeClass('btn-active');
		}

 		$(this).addClass('btn-active');

 		$.ajax({
 			url:"recycle/orgs.php",
 			method:"GET",
 			success:function(data){
 				$('#col_serials').html(data);
 			}
 		});
 	});


});
