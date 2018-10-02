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
    $("#CS").click(function(){
     $.ajax({
      url:'currentsubscribe.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

    $("#overallreport").click(function(){
     $.ajax({
      url:'overallreport.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

    $("#Deli").click(function(){
     $.ajax({
      url:'Delivery.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

    $("#Disb").click(function(){
     $.ajax({
      url:'Distributors.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

});
