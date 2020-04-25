<?php
$update = json_decode(file_get_contents("php://input"),1);
$message = $update['message'];
$id = $message['from']['id'];
if ($message['text'] == "/tkbtoday") {

    $msg = "không có tkb";
    send($id, $msg);
}
///send("440899389", "anbc");





function send($id, $msg)
{
    $bot = "bot602124013:AAG78A2jgbuN8JK_kcLtpP4BIwK6FbWu7cA";
    if (!empty($id) && !empty($msg)) {
        $msg = urlencode($msg);
        file_get_contents("https://api.telegram.org/$bot/sendMessage?chat_id=$id&text=$msg");
    }
}
?>
