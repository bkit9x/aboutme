<?php 
class hkitbot
{
    private $param;
    public function curl($url, $param=[])
    {
        $ch =curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if (count($param)>0) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
        $d = curl_exec($ch);
        curl_close($ch);
        return $d;
    }
    public function getTKB($mssv)
    {
        $hocky = json_decode($this->curl("https://ems.vlute.edu.vn/api/danhmuc/getdshocky"),1)[0]['id'];
        $param = array("hocky"=>$hocky,"masv"=>$mssv);
        $tkb = $this->curl("https://ems.vlute.edu.vn/vTKBSinhVien/ViewTKBSV", $param);
        $d = explode("<table class='table table-responsive table-striped'>",$tkb);
        $e = explode("</table>",$d[1]);
        return $e[0]; 
    }
    public function getTKBtoday($mssv)
    {
        $data = $this->getTKB($mssv);
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
}
?>
