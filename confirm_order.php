<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
echo $_GET['token'];
echo "<br>";

echo $time = $_GET['t'];
echo "<br>";

echo date('d-m-Y h:i:s',$time);


?>