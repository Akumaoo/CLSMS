<?php 
echo $str="asdasdasdas  ''  'HELLO' <br>";

echo htmlentities(str_replace("'","", str_replace('"', '', $str))); 
 ?>