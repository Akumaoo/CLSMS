$(function(){
  
    $('.receive_seen').click(function(){
      $(this).closest('.receive_tab').find('#hidden_form').submit();
    });

    $('.pending_click').click(function(){
      $(this).closest('.pending_tab').find('#pending_form').submit();
    });

    $('.click_seen_deleyed').click(function(){
      $(this).closest('.deleyed_tab').find('#late_deliv_form').submit();
    });


  $('#RS_SEE_ALL>a').click(function() {
    $.post('php_codes/update_seen_deleyed.php',{type:'see all'});
  });

    $('#OG_Click').click(function(){
      $.ajax({
        url:"php_codes/bar_clicked.php",
        method:"POST",
        data:{type:'OnGoing'},
        success:function(data){
          $('#panel_subs_chart').html(data);
        }
      });
    });

    $('#Cancel_Click').click(function(){
      $.ajax({
        url:"php_codes/bar_clicked.php",
        method:"POST",
        data:{type:'Cancelled'},
        success:function(data){
          $('#panel_subs_chart').html(data);
        }
      });
    });

     $('#REF_Click').click(function(){
      $.ajax({
        url:"php_codes/bar_clicked.php",
        method:"POST",
        data:{type:'Refunded'},
        success:function(data){
          $('#panel_subs_chart').html(data);
        }
      });
    });

     $('#Fulfilled_Click').click(function(){
      $.ajax({
        url:"php_codes/bar_clicked.php",
        method:"POST",
        data:{type:'Finished'},
        success:function(data){
          $('#panel_subs_chart').html(data);
        }
      });
    });

      $launch_id=$('#morris_select_chart').val();
     $.ajax({

        url:"php_codes/morris_chart_val_change.php",
        method:"POST",
        data:{id:$launch_id},
        success:function(data){

          Morris.Donut({
          element: 'hero-donut',
          data: [
            {label: 'Fulfilled', value: data[0] ,formatted:data[0]+' Titles'},
            {label: 'Refunded', value: data[3],formatted:data[3]+' Titles' },
            {label: 'Cancelled', value: data[2] ,formatted:data[2]+' Titles'},
            {label: 'OnGoing', value: data[1],formatted:data[1]+' Titles' }
          ],
          backgroundColor: '#ccc',
          colors: ['#3498db', '#2980b9', '#34495e'],
          formatter: function (y,data) { return data.formatted;}
        });

        }
      });



     $('#morris_select_chart').on('change',function(){
      var disbID=$(this).val();

      $value_donut=$.ajax({
        url:"php_codes/morris_chart_val_change.php",
        method:"POST",
        data:{id:disbID},
        success:function(data){

          Morris.Donut({
          element: 'hero-donut',
          data: [
            {label: 'Fulfilled', value: data[0] ,formatted:data[0]+' Titles'},
            {label: 'Refunded', value: data[3],formatted:data[3]+' Titles' },
            {label: 'Cancelled', value: data[2] ,formatted:data[2]+' Titles'},
            {label: 'OnGoing', value: data[1],formatted:data[1]+' Titles' }
          ],
          backgroundColor: '#ccc',
          colors: ['#3498db', '#2980b9', '#34495e'],
          formatter: function (y,data) { return data.formatted;}
        });

        }
      });

      $('#hero-donut').html($value_donut);

     });


  });