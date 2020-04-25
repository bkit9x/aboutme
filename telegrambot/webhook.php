<?php
//func
function curl($url, $param=NULL)
{
    $ch =curl_init();
    $opt = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HEADER => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6',
    );
    if ($param)
        $opt[CURLOPT_POSTFIELDS] = $param;
    curl_setopt_array($ch, $opt);
    $d = curl_exec($ch);
    curl_close($ch);
    return $d;
}
function getTKB($mssv, $hocky=0)
{
    if (!$hocky)
        $hocky = json_decode(curl("https://ems.vlute.edu.vn/api/danhmuc/getdshocky"),1)[0]['id'];
    $param = array("hocky"=>$hocky,"masv"=>$mssv);
    $tkb = curl("https://ems.vlute.edu.vn/vTKBSinhVien/ViewTKBSV", $param);
    $d = explode("<table class='table table-responsive table-striped'>",$tkb);
    $e = explode("</table>",$d[1]);
    return $e[0]; 
}
function getTKBtomorrow($mssv)
{
    $data = getTKB($mssv);
    $rs = array();
    $t = date("N", time()+3600*24)+1;
    $thu = "";
    if ($t==8) {
        $thu = "Chủ nhật";    
    }
    else{
        $thu = "Thứ ".$t;
    }
    preg_match_all("#<tr><td>".$thu."</td>(.*?)</tr>#",$data,$today);
    foreach ($today[1] as $key => $value) {
        preg_match_all("#<td>(.*?)</td>#",$value,$detail);
        if (preg_match("/warning/", $detail[1][0])) {
            $e = explode('strong>', $detail[1][0]);
            $rs[$key]['ma'] = strip_tags($e[0]);
            $rs[$key]['ten'] = strip_tags($e[1]);
            $rs[$key]['tiet'] = $detail[1][1];
            $rs[$key]['lop'] = strip_tags($detail[1][2]);
            $rs[$key]['thongtin'] = strip_tags(str_replace('</br>',' ',$detail[1][3]));
        }            
    }
    return $rs;
}

function getTKBtoday($mssv)
{
    $data = getTKB($mssv);
    $rs = array();
    $t = date("N", time())+1;
    $thu = "";
    if ($t==8) {
        $thu = "Chủ nhật";    
    }
    else{
        $thu = "Thứ ".$t;
    }
    preg_match_all("#<tr><td>".$thu."</td>(.*?)</tr>#",$data,$today);
    foreach ($today[1] as $key => $value) {
        preg_match_all("#<td>(.*?)</td>#",$value,$detail);
        if (preg_match("/warning/", $detail[1][0])) {
            $e = explode('strong>', $detail[1][0]);
            $rs[$key]['ma'] = strip_tags($e[0]);
            $rs[$key]['ten'] = strip_tags($e[1]);
            $rs[$key]['tiet'] = $detail[1][1];
            $rs[$key]['lop'] = strip_tags($detail[1][2]);
            $rs[$key]['thongtin'] = strip_tags(str_replace('</br>',' ',$detail[1][3]));
        }            
    }
    return $rs;
}

function send($id, $msg)
{
    $bot = "bot602124013:AAG78A2jgbuN8JK_kcLtpP4BIwK6FbWu7cA";
    if (!empty($id) && !empty($msg)) {
        curl("https://api.telegram.org/$bot/sendMessage","chat_id=$id&text=$msg");
    }
}


//code

$update = json_decode(file_get_contents("php://input"),1);

$message = $update['message'];
$id = $message['from']['id'];
if ($message['text'] == "/tkbtoday") {
    $rs = getTKBtoday("17004073", "24");
    foreach ($rs as $mon) {
        $text = "Mã: ".$mon['ma']."\nTên: ".$mon['ten']."\nTiết: ".$mon['tiet']."\nLớp: ".$mon['lop'];
        send($id, $text);        
    }
}
elseif($message['text'] == "/tkbtomorrow"){
    $rs = getTKBtomorrow("17004073", "24");
    foreach ($rs as $mon) {
        $text = "Mã: ".$mon['ma']."\nTên: ".$mon['ten']."\nTiết: ".$mon['tiet']."\nLớp: ".$mon['lop'];
        send($id, $text);        
    }
}
?>
