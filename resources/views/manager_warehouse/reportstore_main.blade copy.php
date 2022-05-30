@extends('layouts.warehouse')     
<link href="{{ asset('datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
@section('content')

<style>
    .center {
    margin: auto;
    width: 100%;
    padding: 10px;
    }
    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
       
        }

        label{
                font-family: 'Kanit', sans-serif;
                font-size: 14px;
           
        } 
        @media only screen and (min-width: 1200px) {
   
        }        
        .text-pedding{
    padding-left:10px;
    padding-right:10px;
                        }


        .text-font {
    font-size: 13px;
                  }
                  .form-control {
    font-size: 13px;
                  }

                  table {
            border: 1px solid black;
            }  
            td {
            border: 0.1px solid black;
            font-size: 13px;
            /* text-align: right; */
           
            }  
            th {
            border: 0.1px solid black;
            font-size: 13px;
            text-align: center;
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
    use App\Http\Controllers\ReportWarehouseController;
    
    $year = ReportWarehouseController::year();
    $mount = ReportWarehouseController::mount();
    $checktype = ReportWarehouseController::checktype();
    $checktotalmain = ReportWarehouseController::checktotalmain();
    $checktotalsub = ReportWarehouseController::checktotalsub();
    $checkbuymount = ReportWarehouseController::checkbuymount();
    $checkpayrpst = ReportWarehouseController::checkpayrpst();
    $checkpayrpr = ReportWarehouseController::checkpayrpr();
    $checkpayrpr_sub = ReportWarehouseController::checkpayrpr_sub();
    $month = date('Y-m-d');
?>

   
    <div class="container-fuid mr-3 ml-3">      
        <div class="row">          
            <div class="col-md-12">
                <div class="block block-rounded block-bordered shadow-lg">
                    <div class="block-content" style="width: 100%;">
                            <h2 class="content-heading pt-0" style="font-family: 'Kanit', sans-serif;">สรุปงานวัสดุคงคลัง คลังพัสดุ </h2> 
                           
                            <div class="row text-center"> 
                                <div class="col-md-5">
                                    <form  method="post" action="{{ route('report.reportstore_main_insert') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">     
                                            @if($mount != 0)                                   
                                                <div class="col-md-1">ปี</div>
                                                <div class="col-md-3">
                                                   <select name="LEAVE_YEAR_ID" id="LEAVE_YEAR_ID" class="form-control input-lg">
                                                       <option value="">เลือก</option>
                                                       @foreach ($budgets as $item)    
                                                            @if($item->LEAVE_YEAR_ID== $year_id)
                                                                <option value="{{ $item->LEAVE_YEAR_ID  }}" selected>{{ $item->LEAVE_YEAR_ID}}</option>
                                                            @else
                                                                <option value="{{ $item->LEAVE_YEAR_ID  }}">{{ $item->LEAVE_YEAR_ID}}</option>
                                                            @endif 

                                                       @endforeach
                                                   </select>
                                                </div>
                                            @endif
                                            @if($mount != 0)  
                                            <div class="col-md-1 ">เดือน</div>
                                            <div class="col-md-4">
                                                <select name="MONTH_ID" id="MONTH_ID">
                                                    <option value="">เลือก</option>
                                                    @foreach ($mounts as $mount)
                                                        @if($mount->MONTH_ID== $mount_id)
                                                        <option value="{{ $mount->MONTH_ID  }}" selected>{{ $mount->MONTH_NAME}}</option>
                                                    @else
                                                        <option value="{{ $mount->MONTH_ID  }}">{{ $mount->MONTH_NAME}}</option>
                                                    @endif 
                                               @endforeach
                                                </select>
                                            </div> 
                                            @endif
                                            @if($checktype != 0) 
                                            <div class="col-md-3"> 
                                                    <!-- <a href="{{url('manager_warehouse/reportstore_main_insert')}}" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">รายการ</a> -->
                                                    <button type="submit" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ประมวลผล</button>                                               
                                            </div>  
                                            @endif                                                          
                                        </div>  
                                   
                                </div> 
                                <div class="col-md-4">      
                                    @if($checktotalmain != 0)                               
                                    <a href="{{url('manager_warehouse/reportstore_main_totalmain')}}" class="btn btn-hero-sm btn-hero-info" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ยอดคงเหลือยกมา <br>คลังหลัก</a>
                                    @endif
                                    @if($checktotalsub != 0) 
                                    <a href="" class="btn btn-hero-sm btn-hero-secondary" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ยอดคงเหลือยกมา <br>คลังย่อย</a>
                                    @endif
                                    @if($checkbuymount != 0) 
                                    <a href="" class="btn btn-hero-sm btn-hero-secondary" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">ซื้อระหว่างเดือน <br>รวม</a>
                                    @endif
                                </div>                            
                                <div class="col-md-3">
                                    @if($checkpayrpst != 0) 
                                    <a href="" class="btn btn-hero-sm btn-hero-secondary" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">จ่ายส่วนของ <br>รพ.สต</a>
                                    @endif
                                    @if($checkpayrpr != 0) 
                                    <a href="" class="btn btn-hero-sm btn-hero-secondary" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">จ่ายส่วนของ รพร <br>คลังหลัก</a>
                                    @endif
                                    @if($checkpayrpr_sub != 0) 
                                    <a href="" class="btn btn-hero-sm btn-hero-secondary" style="font-family: 'Kanit', sans-serif; font-size: 14px;font-weight:normal;">จ่ายส่วนของ รพร <br>คลังย่อย</a>
                                    @endif
                                </div>                               
                            </div>
                        </form> 
                            <br>
                            <div class="table-responsive">                               
                                <table class="table-striped table-vcenter" style="width: 100%;">
                                    <thead style="background-color: #F8F9F9;">
                                        <tr height="25">
                                            <th>ลำดับ</th>
                                            <th>รายการ</th>
                                            <th>ยอดคงเหลือยกมา<br>คลังหลัก</th>  
                                            <th>ยอดคงเหลือยกมา<br>คลังย่อย</th> 
                                            <th>ยอดคงเหลือยกมา<br>รวม</th> 
                                            <th>ซื้อระหว่างเดือน<br>รวม</th> 
                                            <th>มูลค่ารวม</th> 
                                            <th>จ่ายส่วนของ รพ.สต.</th> 
                                            <th>จ่ายส่วนของ รพร. <br>(คลังหลัก)</th> 
                                            <th>จ่ายส่วนของ รพร. <br>(คลังย่อย)</th> 
                                            <th>มูลค่าคงเหลือ <br>(หลังตัดคลังหลัก)</th> 
                                            <th>มูลค่าคงเหลือ <br>(หลังตัดคลังย่อย)</th>    
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php $number=0;  ?>
                                        @foreach ($inforeportmains as $inforeportmain)
                                        <?php $number++; ?>
                                        <tr height="20" style="background-color: #FFFFFF;">
                                            <td class="text-font" align="center">{{$number}}</td>
                                            <td class="text-font text-pedding" style="text-align: left;">{{ $inforeportmain->REPMAIN_LISTTYPE_NAME }}</td>                                           
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_MAIN }}</td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_SUB }}</td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_MAINSUB }}      </td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_BUY }}</td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_MAINSUBBUY }}   </td>                                           
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_PAY_RPST }}</td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_PAY_RPR_MAIN }}</td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_PAY_RPR_SUB }}</td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_CUTMAIN }}</td>
                                            <td class="text-font text-pedding" style="text-align: right;">{{ $inforeportmain->REPMAIN_TOTAL_CUTSUB }}</td>
                                        </tr>   
                                        @endforeach 
                                        <tr height="20" style="background-color: #FFB6C1;">  
                                            <td  colspan="2" style="text-align: center; font-size: 13px;">รวม</td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;">0.0000</td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>
                                            <td class="text-font text-pedding" style="text-align: right;"></td>                                   
                                        </tr>    
                                    </tbody> 
                                </table>
                                <br>
                            </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
<script src="{{ asset('select2/select2.min.js') }}"></script>
<script src="{{ asset('asset/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script>jQuery(function(){ Dashmix.helpers(['masked-inputs']); });</script>

<script src="{{ asset('datepicker/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>
<script>
$(document).ready(function() {
    $('select').select2({
        width: '100%'
});
});

   
   $(document).ready(function () {            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,
                autoclose: true                         //Set เป็นปี พ.ศ.
            });  //กำหนดเป็นวันปัจุบัน
          
    });  
    
       
</script>

@endsection