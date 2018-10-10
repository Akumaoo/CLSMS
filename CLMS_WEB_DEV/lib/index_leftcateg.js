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

     $("#MS").click(function(){
     $.ajax({
      url:'manage_serials.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

     $("#Dept").click(function(){
     $.ajax({
      url:'Department.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

     $("#MT").click(function(){
     $.ajax({
      url:'Type.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

     $("#SS").click(function(){
     $.ajax({
      url:'Send_serials.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

     $("#MU").click(function(){
     $.ajax({
      url:'User.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

      $("#arch").click(function(){
     $.ajax({
      url:'Archiving.php',
      success:function(data){
        $('.main-chart').html(data)
      }
     });
    });

});
