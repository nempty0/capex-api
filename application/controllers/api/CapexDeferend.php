<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class CapexDeferend extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capexdeferendmodel');
    }
    public function capexDeferend_get() 
    {
        $status = $this->get('status');
        $capexID = $this->get('capexID');
        $deferID = $this->get('deferID');
        $deferYear = $this->get('deferYear');
        
        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->capexdeferendmodel->getCapexDeferend();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "deferID" => $deferID
            );
            $result = $this->capexdeferendmodel->getCapexDeferendSelect($arr);
        }
        else if($status == "deferYear"){
            $arr = array(
                "deferYear" => $deferYear
            );
            $result = $this->capexdeferendmodel->getCapexDeferendSelect($arr);
        }
        else if($status == "capexID"){
            $arr = array(
                "capexID" => $capexID
            );
            $result = $this->capexdeferendmodel->getCapexDeferendSelect($arr);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function capexDeferend_put( )  //	edit approval // แก้ไข capex
    {
        $capexID = $this->put('capexID');
        $deferID = $this->put('deferID');
        $deferYear = $this->put('deferYear');

        $arr = array(
            "deferYear" => $deferYear,
            "capexID" => $capexID
        );
        $where="deferID = $deferID";
        $this->capexdeferendmodel->updateCapexDeferend($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update CapexDeferend completed"
        );
        $this->response($result,200);
    }
    public function capexDeferend_post()     //6.	create Approval  //สร้าง Approval    
    {
        $capexID = $this->put('capexID');
        $deferYear = $this->put('deferYear');

        $id = 0;
        
        $arr = array(
            "deferYear" => $deferYear,
            "capexID" => $capexID
        );
        $id = $this->capexdeferendmodel->insertCapexDeferend($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create CapexDeferend success',
                "deferID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create CapexDeferend"
            );
        }
        $this->response($result,200);
    }
    public function capexDeferend_delete()
    {
        $deferID = $this->delete('deferID');
        $where = "deferID = " . $deferID;
        $this->capexdeferendmodel->deleteCapexDeferend($where);

        $result = array(
            "status" => "success",
            "detail" => "delete CapexDeferend completed"
        );
        $this->response($result, 200);
    }
}

