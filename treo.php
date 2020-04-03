<?php 
    $url = "http://elearning.vlute.edu.vn:8080/webservice/rest/server.php?moodlewsrestformat=json&wsfunction=tool_lp_data_for_plans_page";
    $data = "userid=685&moodlewssettingfilter=true&moodlewssettingfileurl=true&wsfunction=tool_lp_data_for_plans_page&wstoken=063e9ceeca9d22831ebbe4fd80c3242c";
    $ch =curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    echo curl_exec($ch);
    curl_close($ch);
?>
