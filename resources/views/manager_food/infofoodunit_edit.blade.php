@extends('layouts.backend_admin')
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
        font-size: 14px;
       
        }
  
        .text-pedding{
     padding-left:10px;
                      }
  
          .text-font {
      font-size: 14px;
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
<?php
function RemoveDateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));

  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  }


  function Removeformate($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));

  
  return $strDay."/".$strMonth."/".$strYear;
  }

  
?>
                    <!-- Advanced Tables -->
                    <br>
<br>
<center>    
     <div class="block" style="width: 95%;">
                <div class="block block-rounded block-bordered">

    
                               <!-- Dynamic Table Simple -->
                               <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <h3 class="block-title" style="font-family: 'Kanit', sans-serif;"><B>แก้ไขหน่วยปริมาณ</B></h3>

                </div>
    <form  method="post" action="{{ route('mfood.infofoodunit_update') }}"  enctype="multipart/form-data"  class="needs-validation" novalidate>      
    @csrf
        <div class="block-content">
        
        <input type="hidden" name = "FOOD_UNIT_ID"  id="FOOD_UNIT_ID" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infofoodunitref->FOOD_UNIT_ID}}">

        <div class="row">
            <div class="col-md-2">
            <p style="text-align: left" >หน่วยปริมาณ</p>
            </div>
            <div class="col-md-3">
            <input  name = "FOOD_UNIT_NAME"  id="FOOD_UNIT_NAME" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infofoodunitref->FOOD_UNIT_NAME}}">
            </div>
        
        </div>

        <div class="row">
   

        <table class="gwt-table table-striped table-vcenter" style="width: 50%;">
                        <thead style="background-color: #F0F8FF;">
                            <tr>        
                                <td style="text-align: center;" >อัตราส่วนเท่ากับ</td>
                                <td style="text-align: center;" >หน่วย</td>
                                <td style="text-align: center;" width="8%"><a  class="btn btn-success fa fa-plus addRow0" style="color:#FFFFFF;"></a></td>
                            </tr>
                        </thead> 
                        <tbody class="tbody0"> 
                        
                        @foreach ($infofodsubs as $infofodsub)
                        <tr>
                           
                            <td class="text-font text-pedding" align="left"> 
                              <input name="FOOD_UNIT_SUB_AMOUNT[]" id="FOOD_UNIT_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: 'Kanit', sans-serif;" value="{{$infofodsub->FOOD_UNIT_SUB_AMOUNT}}">
                            </td>
                            <td class="text-font text-pedding" align="left"> 
                               <select name="FOOD_UNIT_SUB_NUMBER[]" id="FOOD_UNIT_SUB_NUMBER[]" class="form-control input-sm " style=" font-family: 'Kanit', sans-serif;" >
                                @foreach ($infounits as $infounit)
                                  @if($infofodsub->FOOD_UNIT_SUB_NUMBER == $infounit -> FOOD_UNIT_ID)
                                  <option value="{{ $infounit -> FOOD_UNIT_ID }}" selected>{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                  @else
                                  <option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>            
                                  @endif
                              
                                @endforeach  
                                </select>
                            </td>
                            <td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>
                        </tr>
                        @endforeach  
                        </tbody> 
        </table>

        </div>


        <br>
        <div class="modal-footer">
        <div align="right">
        <button type="submit"  class="btn btn-hero-sm btn-hero-info" >บันทึกข้อมูล</button>
        <a href="{{ url('manager_food/infofoodunit')  }}" class="btn btn-hero-sm btn-hero-danger" onclick="return confirm('ต้องการที่จะยกเลิกการเพิ่มข้อมูล ?')" >ยกเลิก</a>
        </div>

        </form>

        </div> 



@endsection

@section('footer')
  <!-- Page JS Plugins -->
  <script src="{{ asset('asset/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('asset/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('asset/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
  <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('asset/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

  <!-- Page JS Code -->
  <script src="{{ asset('asset/js/pages/be_tables_datatables.min.js') }}"></script>
<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });


    
    


    $('.addRow0').on('click',function(){
        addRow0();
        });

    function addRow0(){
        var count = $('.tbody0').children('tr').length;
            var tr =        '<tr>'+
                            '<td class="text-font text-pedding" align="left">'+ 
                            '<input name="FOOD_UNIT_SUB_AMOUNT[]" id="FOOD_UNIT_SUB_AMOUNT[]" class="form-control input-sm" style=" font-family: \'Kanit\', sans-serif;" >'+
                            '</td>'+
                            '<td class="text-font text-pedding" align="left">'+ 
                            '<select name="FOOD_UNIT_SUB_NUMBER[]" id="FOOD_UNIT_SUB_NUMBER[]" class="form-control input-sm " style=" font-family: \'Kanit\', sans-serif;" >'+
                            '@foreach ($infounits as $infounit)'+
                            '<option value="{{ $infounit -> FOOD_UNIT_ID }}">{{ $infounit -> FOOD_UNIT_NAME }}</option>'+            
                            '@endforeach'+  
                            '</select>'+
                            '</td>'+
                            '<td style="text-align: center;"><a class="btn btn-danger fa fa-trash-alt remove" style="color:#FFFFFF;"></a></td>'+
                        '</tr>';
                        
        $('.tbody0').append(tr);
    };

    $('.tbody0').on('click','.remove', function(){
        $(this).parent().parent().remove();
});  
  

</script>



@endsection