<?php
file_put_contents("a.txt",json_encode($_SERVER));
file_put_contents("b.txt",json_encode($_POST));
file_put_contents("c.txt",$_POST);
file_put_contents("d.txt",json_encode($_REQUEST));
?>
