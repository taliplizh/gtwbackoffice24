<!-- <link  href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" /> -->
<style>
    @font-face {
        font-family: 'THSarabunNew';
        src: url('fonts/thsarabunnew-webfont.eot');
        src: url('fonts/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
            url('fonts/thsarabunnew-webfont.woff') format('woff'),
            url('fonts/thsarabunnew-webfont.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;

    }

    @font-face {
        font-family: 'THSarabunNew';
        src: url('fonts/thsarabunnew_bolditalic-webfont.eot');
        src: url('fonts/thsarabunnew_bolditalic-webfont.eot?#iefix') format('embedded-opentype'),
            url('fonts/thsarabunnew_bolditalic-webfont.woff') format('woff'),
            url('fonts/thsarabunnew_bolditalic-webfont.ttf') format('truetype');
        font-weight: bold;
        font-style: italic;

    }

    @font-face {
        font-family: 'THSarabunNew';
        src: url('fonts/thsarabunnew_italic-webfont.eot');
        src: url('fonts/thsarabunnew_italic-webfont.eot?#iefix') format('embedded-opentype'),
            url('fonts/thsarabunnew_italic-webfont.woff') format('woff'),
            url('fonts/thsarabunnew_italic-webfont.ttf') format('truetype');
        font-weight: normal;
        font-style: italic;

    }

    @font-face {
        font-family: 'THSarabunNew';
        src: url('fonts/thsarabunnew_bold-webfont.eot');
        src: url('fonts/thsarabunnew_bold-webfont.eot?#iefix') format('embedded-opentype'),
            url('fonts/thsarabunnew_bold-webfont.woff') format('woff'),
            url('fonts/thsarabunnew_bold-webfont.ttf') format('truetype');
        font-weight: bold;
        font-style: normal;

    }


    body {
        font-family: 'THSarabunNew', sans-serif;
        font-size: 13px;
        line-height: 0.8;
        padding: 2.10pt 14.1pt 1.1pt 14.00pt;
        /* เรียงจากบน ขวา ล่าง  ซ้าย */
    }


    table,
    th,
    td {
        border: none;
    }


    .text-pedding {
        padding-left: 10px;
        padding-right: 10px;
    }
</style>

<?php
    
    function Removeconvert($number){ 
        $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
        $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
        $number = str_replace(",","",$number); 
        $number = str_replace(" ","",$number); 
        $number = str_replace("บาท","",$number); 
        $number = explode(".",$number); 
        if(sizeof($number)>2){ 
        return ''; 
        exit; 
        } 
        $strlen = strlen($number[0]); 
        $convert = ''; 
        for($i=0;$i<$strlen;$i++){ 
            $n = substr($number[0], $i,1); 
            if($n!=0){ 
                if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
                elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
                elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
                else{ $convert .= $txtnum1[$n]; } 
                $convert .= $txtnum2[$strlen-$i-1]; 
            } 
        } 
        
        $convert .= 'บาท'; 
        if($number[1]=='0' OR $number[1]=='00' OR 
        $number[1]==''){ 
        $convert .= 'ถ้วน'; 
        }else{ 
        $strlen = strlen($number[1]); 
        for($i=0;$i<$strlen;$i++){ 
        $n = substr($number[1], $i,1); 
            if($n!=0){ 
            if($i==($strlen-1) AND $n==1){$convert 
            .= 'เอ็ด';} 
            elseif($i==($strlen-2) AND 
            $n==2){$convert .= 'ยี่';} 
            elseif($i==($strlen-2) AND 
            $n==1){$convert .= '';} 
            else{ $convert .= $txtnum1[$n];} 
            $convert .= $txtnum2[$strlen-$i-1]; 
            } 
        } 
        $convert .= 'สตางค์'; 
        } 
        return $convert; 
    } 

    function caldate($displaydate_end,$displaydate_bigen){ 
            $sumdate = round(abs(strtotime($displaydate_end) - strtotime($displaydate_bigen))/60/60/24)+1;
            return thainumDigit($sumdate); 
    } 
    
    function DateThaifrom($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
    
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        //return thainumDigit($strDay.' '.$strMonthThai.'  พ.ศ. '.$strYear);
        return $strDay.' '.$strMonthThai.' '.$strYear;
    }
    
    function timefrom($strtime){
        $time = substr($strtime,0,5);
        return thainumDigit($time);
    }

    function month($strMonth){
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strMonthThai";
    }
    $date = date('Y-m-d');

    use App\Http\Controllers\ManagercompensationController;

?>

</head>

<body>
    <table width="100%">
        <tr>
            <td>
                <center><B style="font-size: 22px;">บันทึกข้อความ</B></center>
            </td>
        </tr>
    </table>
    <br>
    ส่วนราชการ {{$infoorg->ORG_NAME}}<br>
    <table width="100%">
        <tr>
            <td width="40%">ที่</td>
            <td>{{DateThaifrom($date)}}</td>
        </tr>
    </table>
    เรื่อง ขออนุมัติเบิกเงินค่าตอบเเทน <br>
    <label for="">เรียน ผู้อำนวยการ{{$infoorg->ORG_NAME}}<label> <br><br>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$infoorg->ORG_NAME}}
            อ.{{$infoorg->DISTRICT}} จ.{{$infoorg->PROVINCE}} ขออนุมัติเบิกเงินค่าตอบเเทนเจ้าหน้าที่ที่ขึ้นปฎิบัติงานนอกเวลา
            ราชการตามแผนโครงงาน/โครงการประจำเดือน{{month($date_salary->SALARYALL_HEAD_MONTH_ID)}}
            {{$date_salary->SALARYALL_HEAD_YEAR_ID}} ดังรายการต่อไปนี้ <br>

            <table width="100%">
                <?php $number = 0; ?>
                @foreach($infoperson as $row)
                    @if($row->salary_sub == '0')

                    @else
                    <?php $number++; ?>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$number}}
                        </td>
                        <td>{{$row -> SALARYALL_RECEIVE_LISTNAME}}</td>
                        <td>จำนวนเงิน</td>
                        <td align="right">{{number_format($row->salary_sub,2)}}</td>
                        <td>บาท</td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td align="right" style="border-bottom: solid 1px; border-top:solid 1px;">
                        {{number_format(ManagercompensationController::sumsalarysub($id),2)}}</td>
                    <td></td>
                </tr>
            </table>
            <br>
            รวมเป็นเงินทั้งสิ้น {{number_format(ManagercompensationController::sumsalarysub($id),2)}} บาท
            ({{convert(number_format(ManagercompensationController::sumsalarysub($id),2))}}) โดยขออนุมัติเบิกจ่ายจากเงินบำรุง
            {{$infoorg->ORG_NAME}} พร้อมหนังสือนี้ได้เเนบเอกสารการจ่ายเงินมาพร้อมเเล้ว <br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ<br>
            <br>
            <br>
            <br>
            <br>
            <table>
                <tr>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;............................................</td>
                    <td width="55%"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;............................................
                    </td>

                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(นายธีรศักดิ์ รัตนเทวะเนตร)</td>
                    <td width="55%"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(นางอรอินทร์ ขวาลา)
                    </td>

                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นักจัดการทั่วไปชำนาญการ </td>
                    <td width="55%"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;เจ้าพนักงานการเงินเเละบัญชีชำนาญงาน</td>

                </tr>
            </table>

            <br><br>
            <table width="100%">
                <tr>
                    <td width="55%"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;............................................</td>
                </tr>
                <tr>
                    <td width="55%"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(นายกิรพุทธิ เฉลิมเกียรตสกุล)</td>
                </tr>
                <tr>
                    <td width="55%"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้อำนวยการ{{$infoorg->ORG_NAME}}</td>
                </tr>
            </table>



</body>

</html>