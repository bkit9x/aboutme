<?php
    error_reporting(0);
    function getTKB($mssv)
    {
        $param = array("hocky"=>"24","masv"=>$mssv);
        $ch =curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://ems.vlute.edu.vn/vTKBSinhVien/ViewTKBSV");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
        $d = curl_exec($ch);
        curl_close($ch);
        $e = explode("events:",$d);
        return $e[1]; 
    }

    function xlnt($t)
    {
        $time = strtotime($t)-25200;
        return date("Ymd\THim",$time);
    }

    if (isset($_GET['mssv'])) {
        $ms = (int) $_GET['mssv'];
        $d = getTKB($ms);
        $listev = explode("},{", $d);
        $str = "BEGIN:VCALENDAR\nPRODID:-//HKIT9x//EN\nVERSION:2.0\nCALSCALE:GREGORIAN\nMETHOD:PUBLISH\nX-WR-CALNAME:Lịch học HK24\nX-WR-TIMEZONE:Asia/Ho_Chi_Minh\n";
        foreach ($listev as $event ) {
            $v = explode("'",$event);
            $str .= "BEGIN:VEVENT\nDTSTART:".xlnt($v[3])."Z\nDTEND:".xlnt($v[5])."Z\nDTSTAMP:20200416T121844Z\nSUMMARY:$v[1]\nEND:VEVENT\n";
        }
        $str .= "\nEND:VCALENDAR";
        file_put_contents($ms.".ics",$str);
        echo '<a href="'.$ms.".ics".'">Download</a>';
    }
?>

<form action="" method="get">
    <input type="text" name="mssv" placeholder="Nhập MSSV">
    <input type="submit" value="Lấy lịch học">
</form>
