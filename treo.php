<?php 
    if (isset($_GET['u']) && isset($_GET['p'])) {
        $u = addslashes($_GET['u']);
        $p = addslashes($_GET['p']);
        $ch =curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://elearning.vlute.edu.vn:8080/login/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
        curl_setopt($ch, CURLOPT_COOKIEJAR, "");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "");
        $d = curl_exec($ch);
        preg_match('/name="logintoken" value="([a-zA-Z0-9]+)"/',$d,$preg);
        $param = array(
            "anchor" => "",
            "logintoken"=>$preg[1],
            "username"=>$u,
            "password"=>$p
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        $d = curl_exec($ch);
        $url = curl_getinfo($ch);
        echo $url['url'];
        curl_close($ch);
    }
?>
<form action="" method="get">
    <input type="text" name="u">
    <input type="text" name="p">
    <input type="submit" value="treo nick">
</form>
