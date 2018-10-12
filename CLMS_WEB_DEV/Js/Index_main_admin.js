$(function(){
    $('.click_seen_deleyed').click(function(){
      $pack=$(this).closest('.deleyed_tab').find('.pack_name').text();
      
      $.ajax({
        url:'php_codes/update_seen_deleyed.php',
        method:'POST',
        data:{pn:$pack},
        success:function(data)
        {
          if(data=='success')
          {
            location.reload(true);
          }

        }
      });
    });

    $('.receive_seen').click(function(){
      $date=$(this).closest('.receive_tab').find('.date').text();
      $serial=$(this).closest('.receive_tab').find('.serial_name').text(); 
      $.ajax({
        url:'php_codes/update_seen_deleyed.php',
        method:'POST',
        data:{date:$date,serial:$serial},
        success:function(data)
        {
          if(data=='success')
          {
            location.reload(true);

          }
          else
          {
            alert(data);
          }

        }
      });

    });

  });