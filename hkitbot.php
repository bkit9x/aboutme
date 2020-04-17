<?php
include "class.php";
$token = '602124013:AAG78A2jgbuN8JK_kcLtpP4BIwK6FbWu7cA';
$getUpdates = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getUpdates"),1);
$message = $getUpdates['result'][count($getUpdates['result'])-1]['message'];
if (time()-$message['date']<61) {
    $hkitbot = new hkitbot();
    if ($message['text']=="/tkbtoday") {
        $tkb = $hkitbot->getTKBtoday("17004073");
        foreach ($tkb as $mon ) {
            $text = "Mã: ".$mon['ma']."\n Tên: ".$mon['ten']."\n Tiết: ".$mon['tiet']."\n Lớp: ".$mon['lop']."\n Thông tin: ".$mon['thongtin'];
            $hkitbot->curl("https://api.telegram.org/bot".$token."/sendMessage",
            array(
                "chat_id" => $message['from']['id'],
                 "text"=>$text
                )
            );
        }
    }    
}
?>
