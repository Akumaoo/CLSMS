$(function(){

	$('input[type="number"]').keydown(function(e){
		if(e.keyCode==189 || e.keyCode==69)
		{
			return false;
		}
		else
		{
			return true;
		}
	});

	$('input[type="number"]').attr('min', '0');

	$('#remove-active').click(function() {
		if($('#remove-active').hasClass('active'))
		{
			$('#remove-active').removeClass('active');
		}
	});

	

});