$(function(){

    // ADDING TAB
    $('#adduser').click(function(){
      $.ajax({
        url:'adduser.php',
        success:function(data){
          $('.main-chart').html(data)
        }
      });
    });

     $('#adddistrib').click(function(){
      $.ajax({
        url:'adddistrib.php',
        success:function(data){
          $('.main-chart').html(data)
        }
      });
    });

      $('#addserial').click(function(){
      $.ajax({
        url:'addserial.php',
        success:function(data){
          $('.main-chart').html(data)
        }
      });
    });

       $('#addtype').click(function(){
      $.ajax({
        url:'addserialtype.php',
        success:function(data){
          $('.main-chart').html(data)
        }
      });
    });

    // END OF ADDING TAB
     $('#subs').click(function(){
      $.ajax({
        url:'Subscribe.php',
        success:function(data){
          $('.main-chart').html(data)
        }
      });
    });

});
