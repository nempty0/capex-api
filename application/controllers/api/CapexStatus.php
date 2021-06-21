<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class CapexStatus extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capexstatusmodel');
    }
    public function capexStatus_get() 
    {
        $status = $this->get('status');
        $capexStatusID = $this->get('capexStatusID');
        $capexStatusName = $this->get('capexStatusName');
        
        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->capexstatusmodel->getCapexStatus();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "capexStatusID" => $capexStatusID
            );
            $result = $this->capexstatusmodel->getCapexStatusSelect($arr);
        }
        else if($status == "capexStatusName"){
            $arr = array(
                "capexStatusName" => $capexStatusName
            );
            $result = $this->capexstatusmodel->getCapexStatusSelect($arr);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function capexStatus_put( )  //	edit approval // แก้ไข capex
    {
        $capexStatusID = $this->put('capexStatusID');
        $capexStatusName = $this->put('capexStatusName');

        $arr = array(
            "capexStatusName" => $capexStatusName
        );
        $where="capexStatusID = $capexStatusID";
        $this->capexstatusmodel->updateCapexStatus($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update CapexStatus completed"
        );
        $this->response($result,200);
    }
    public function capexStatus_post()     //6.	create Approval  //สร้าง Approval    
    {
        $capexStatusName = $this->put('capexStatusName');

        $id = 0;
        
        $arr = array(
            "capexStatusName" => $capexStatusName  
        );
        $id = $this->capexstatusmodel->insertCapexStatus($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create CapexStatus success',
                "capexStatusID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create CapexStatus"
            );
        }
        $this->response($result,200);
    }
    public function capexStatus_delete()
    {
        $capexStatusID = $this->delete('capexStatusID');
        $where = "capexStatusID = " . $capexStatusID;
        $this->capexstatusmodel->deleteCapexStatus($where);

        $result = array(
            "status" => "success",
            "detail" => "delete CapexStatus completed"
        );
        $this->response($result, 200);
    }
}

