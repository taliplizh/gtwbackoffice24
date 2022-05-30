<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRiskStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('risk_status')) {
            DB::table('risk_status')->truncate();
        }
      

        DB::table('risk_status')->insert(array(
            'RISK_STATUS_ID' => '1',
           'RISK_STATUS_NAME' => 'REPEAT',
           'RISK_STATUS_NAME_TH' => 'ทบทวน',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('risk_status')->insert(array(
            'RISK_STATUS_ID' => '2',
           'RISK_STATUS_NAME' => 'ACCEPT',
           'RISK_STATUS_NAME_TH' => 'ตอบกลับ',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('risk_status')->insert(array(
            'RISK_STATUS_ID' => '3',
           'RISK_STATUS_NAME' => 'CONFIRM',
           'RISK_STATUS_NAME_TH' => 'รอยืนยัน',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),
         ));
         DB::table('risk_status')->insert(array(
            'RISK_STATUS_ID' => '4',
           'RISK_STATUS_NAME' => 'SUCCESS',
           'RISK_STATUS_NAME_TH' => 'เรียบร้อย',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),
        ));
         DB::table('risk_status')->insert(array(
            'RISK_STATUS_ID' => '5',
           'RISK_STATUS_NAME' => 'REPORT',
           'RISK_STATUS_NAME_TH' => 'รายงาน',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('risk_status')->insert(array(
            'RISK_STATUS_ID' => '6',
            'RISK_STATUS_NAME' => 'CANCEL',
            'RISK_STATUS_NAME_TH' => 'ยกเลิก',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
        DB::table('risk_status')->insert(array(
            'RISK_STATUS_ID' => '7',
           'RISK_STATUS_NAME' => 'CANCELED',
           'RISK_STATUS_NAME_TH' => 'แจ้งยกเลิก',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::table('risk_status')->where('RISK_STATUS_NAME','=','REPEAT')->where('RISK_STATUS_NAME_TH','=','ทบทวน')->delete();
        // DB::table('risk_status')->where('RISK_STATUS_NAME','=','ACCEPT')->where('RISK_STATUS_NAME_TH','=','ตอบกลับ')->delete();
        // DB::table('risk_status')->where('RISK_STATUS_NAME','=','CONFIRM')->where('RISK_STATUS_NAME_TH','=','รอยืนยัน')->delete();
        // DB::table('risk_status')->where('RISK_STATUS_NAME','=','SUCCESS')->where('RISK_STATUS_NAME_TH','=','เรียบร้อย')->delete();
        // DB::table('risk_status')->where('RISK_STATUS_NAME','=','REPORT')->where('RISK_STATUS_NAME_TH','=','รายงาน')->delete();
        // DB::table('risk_status')->where('RISK_STATUS_NAME','=','CANCEL)')->where('RISK_STATUS_NAME_TH','=','ยกเลิก')->delete();
        // DB::table('risk_status')->where('RISK_STATUS_NAME','=','CANCELED')->where('RISK_STATUS_NAME_TH','=','แจ้งยกเลิก')->delete();
    }
}
