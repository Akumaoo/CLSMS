$(function(){

      $("#MS_staff").click(function(){
     $.ajax({
      url:'RBAC/manage_serials.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

});
