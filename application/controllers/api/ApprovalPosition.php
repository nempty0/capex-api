<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class ApprovalPosition extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(' approvalpositionmodel');
    }
    public function approvalPosition_get() 
    {
        $status = $this->get('status');
        $positionID = $this->get('positionID');
        $positionName = $this->get('positionName');

        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->approvalpositionmodel->getApprovalPosition();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "positionID" => $positionID
            );
            $result = $this->approvalpositionmodel->getApprovalPositionSelect($arr);
        }
        else if($status == "positionName"){
            $arr = array(
                "positionName" => $positionName
            );
            $result = $this->approvalpositionmodel->getApprovalPositionSelect($arr);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function approvalPosition_put( )  //	edit approval // แก้ไข capex
    {
        $positionID = $this->put('positionID');
        $positionName = $this->put('positionName');

        $arr = array(
            "positionID" => $positionID,
            "positionName" => $positionName
        );
        $where="positionID = $positionID";
        $this->approvalpositionmodel->updateApprovalPosition($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update ApprovalPosition completed"
        );
        $this->response($result,200);
    }
    public function approvalPosition_post()     //6.	create Approval  //สร้าง Approval    
    {
        $positionName = $this->post('positionName');

        $id = 0;
        
        $arr = array(
            "positionName" => $positionName
        );
        $id = $this->approvalpositionmodel->insertApprovalPosition($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create ApprovalPosition success',
                "positionID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create ApprovalPosition"
            );
        }
        $this->response($result,200);
    }
    public function approvalPosition_delete()
    {
        $positionID = $this->delete('positionID');
        $where = "positionID = " . $positionID;
        $this->approvalpositionmodel->deleteApprovalPosition($where);

        $result = array(
            "status" => "success",
            "detail" => "delete ApprovalPosition completed"
        );
        $this->response($result, 200);
    }
}

