<?php 
    $uid = addslashes($_GET['uid']);
    $token = addslashes($_GET['token']);
    $url = "http://elearning.vlute.edu.vn:8080/webservice/rest/server.php?moodlewsrestformat=json&wsfunction=tool_lp_data_for_plans_page";
    $data = "userid=".$uid."&moodlewssettingfilter=true&moodlewssettingfileurl=true&wsfunction=tool_lp_data_for_plans_page&wstoken=".$token;
    $ch =curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    echo curl_exec($ch);
    curl_close($ch);
?>
