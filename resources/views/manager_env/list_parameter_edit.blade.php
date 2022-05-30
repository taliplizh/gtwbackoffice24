@extends('layouts.env')
   
    <link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">


@section('content')
<style>
.center {
  margin: auto;
  width: 100%;
  padding: 10px;
}
body {
      font-family: 'Kanit', sans-serif;
      font-size: 13px;
     
      }

label{
            font-family: 'Kanit', sans-serif;
            font-size: 13px;
           
      } 
</style>
<script>
    function checklogin(){
     window.location.href = '{{route("index")}}'; 
    }
    </script>
<?php
if(Auth::check()){
    $status = Auth::user()->status;
    $id_user = Auth::user()->PERSON_ID;   
}else{
    
    echo "<body onload=\"checklogin()\"></body>";
    exit();
}  
$url = Request::url();
$pos = strrpos($url, '/') + 1;
$user_id = substr($url, $pos); 


?>

<center>    
     <div class="block mt-5" style="width: 95%;">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
               
                <div align="left">
                    <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขรายการพารามิเตอร์</B></h3>
                </div>

            </div>
        <div class="block-content block-content-full">
            <form action="{{ route('menv.list_parameter_update') }}" method="post">
                @csrf       

                <input type="hidden" name="LIST_PARAMETER_ID" name="LIST_PARAMETER_ID" value=" {{$list_parameters->LIST_PARAMETER_ID}}" class="form-control">

            <div class="row push">
          
            <div class="col-sm-2 text-right">
                <label for="LIST_PARAMETER_DETAIL">รายการพารามิเตอร์ :</label>
                </div> 
                <div class="col-lg-3 ">              
                <input value=" {{$list_parameters->LIST_PARAMETER_DETAIL}}" name="LIST_PARAMETER_DETAIL" id="LIST_PARAMETER_DETAIL" class="form-control input-lg fo13" required>
                </div> 
                <div class="col-sm-1 text-right">
                    <label for="LIST_PARAMETER_UNIT">หน่วย :</label>
                    </div> 
                    <div class="col-lg-2 ">              
                    <input value=" {{$list_parameters->LIST_PARAMETER_UNIT}}" name="LIST_PARAMETER_UNIT" id="LIST_PARAMETER_UNIT" class="form-control input-lg fo13" required>
                    </div> 
                    <div class="col-sm-1 text-right">
                        <label for="LIST_PARAMETER_NORMAL">ค่ามาตรฐาน :</label>
                        </div> 
                        <div class="col-lg-3 ">              
                        <input value=" {{$list_parameters->LIST_PARAMETER_NORMAL}}" name="LIST_PARAMETER_NORMAL" id="LIST_PARAMETER_NORMAL" class="form-control input-lg fo13" required>
                        </div> 

                </div>
                <div class="row push">

                    <div class="col-sm-2 text-right">
                        <label for="LIST_USEANALYSIS_RESULTS">วิธี่ที่ใช้วิเคราะห์ :</label>
                    </div>
                    <div class="col-lg-10 ">
                        <input name="LIST_USEANALYSIS_RESULTS" id="LIST_USEANALYSIS_RESULTS"
                        value=" {{$list_parameters->LIST_USEANALYSIS_RESULTS}}"  class="form-control input-lg fo13" >
                    </div>
                </div>
               
<hr>
                <div class="footer">
                    <div align="right">
                        <button type="submit" class="btn btn-hero-sm btn-hero-info foo15" ><i class="fas fa-save mr-2"></i>บันทึกข้อมูล</button>
                            <a href="{{ url('manager_env/list_parameter')}}" class="btn btn-hero-sm btn-hero-danger foo15" onclick="return confirm('ต้องการที่จะยกเลิกการแก้ไขข้อมูล ?')" ><i class="fas fa-window-close mr-2"></i>ยกเลิก</a>
                    </div>
                </div>
        </div>
    </div>


@endsection

@section('footer')

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>


 <script>
   $(document).ready(function () {
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
    });

   

    function chkmunny(ele){
var vchar = String.fromCharCode(event.keyCode);
if ((vchar<'0' || vchar>'9' )&& (vchar != '.')) return false;
ele.onKeyPress=vchar;
}
    
  
</script>



@endsection