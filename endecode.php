<?php 
$rs = array();
$c = "";
if (isset($_POST['code'])) {
    $c = $_POST['code'];
    $rs['base64_decode'] = base64_decode($c);
    $rs['base64_encode'] = base64_encode($c);
    $rs['urldecode'] = urldecode($c);
    $rs['urlencode'] = urlencode($c);
    $rs['md5'] = md5($c);
    $rs['htmlentities'] = htmlentities($c);
    $rs['html_entity_decode'] = html_entity_decode($c);
    $rs['addslashes'] = addslashes($c);
    $rs['json_decode'] = json_decode($c,1);
    $rs['json_encode'] = json_encode($c);
    $rs['sha1'] = sha1($c);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encode / Decode</title>
    <style>
        textarea{
            width: 100%;
            height: 80px;
        }
        input[type='submit']{
            background-color: teal;
            width: 100%;
            height: 30px;
            text-align: center;
            color: aliceblue;
            font-weight: bolder;
            display: block;
            margin: auto;
        }
        .input{
            display: block;
            margin: 3px;
        }
        input[type='text']{
            width: 70%;
            height: 25px;
        }
        label{
            width: 20%;
            display: inline-block;
            text-align: right;
            padding-right: 5px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
    <textarea name="code"><?php echo htmlentities($c); ?></textarea>
    <input type="submit" value="encode/decode">
    </form>
    <form action="">
    <?php 
    foreach ($rs as $key => $value) {
        echo '<div class="input"><label>'.$key.'</label><input type="text" value="'.$value.'"></div>';
    }    
    ?>
    </form>
</body>
</html>