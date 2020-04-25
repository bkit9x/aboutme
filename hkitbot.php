<?php 
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time; 
?>
<?php

include "class.php";
$token = '602124013:AAG78A2jgbuN8JK_kcLtpP4BIwK6FbWu7cA';
$hkitbot = new hkitbot();
$tkb = $hkitbot->getTKBtoday("17004073");
foreach ($tkb as $mon) {
    $text = "Mã: ".$mon['ma']."\n Tên: ".$mon['ten']."\n Tiết: ".$mon['tiet']."\n Lớp: ".$mon['lop']."\n Thông tin: ".$mon['thongtin'];
    echo $text;
}

?>
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Page generated in '.$total_time.' seconds.';
?>