$(function(){
    $('.click_seen_deleyed').click(function(){
      $pack=$(this).closest('.deleyed_tab').find('.pack_name').text();
      $type=$(this).closest('.deleyed_tab').find('.Type').text();
      
      $.ajax({
        url:'php_codes/update_seen_deleyed.php',
        method:'POST',
        data:{pn:$pack,type:$type},
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
      $dept=$(this).closest('.receive_tab').find('.rec_dept').text();
      $.ajax({
        url:'php_codes/update_seen_deleyed.php',
        method:'POST',
        data:{date:$date,serial:$serial,dept:$dept},
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