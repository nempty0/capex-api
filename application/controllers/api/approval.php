<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Approval extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('approvalmodel');
    }
    public function approval_get() 
    {
        $status = $this->get('status');
        $approvalID = $this->get('approvalID');
        $division = $this->get("division");

        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->approvalmodel->getApproval();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "approvalID" => $approvalID
            );
            $result = $this->approvalmodel->getApprovalSelect($arr);
        }
        else if($status == "division"){
            $where = "division = '$division'";
            $result = $this->approvalmodel->getApprovalSelect($where);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function approval_put( )  //	edit approval // แก้ไข capex
    {
        $approvalID     = $this->put('$approvalID');
        $approval       = $this->put('$approval');
	    $division       = $this->put('division');
	    $positionID     = $this->put('positionID');

        $arr = array(
            "approval"      => $approval,
	        "division"      => $division,
	        "positionID"    => $positionID 
        );
        $where="approvalID = $approvalID";
        $this->approvalmodel->updateApproval($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update approval completed"
        );
        $this->response($result,200);
    }
    public function approval_post()     //6.	create Approval  //สร้าง Approval    
    {
        $approval       = $this->post('$approval');
	    $division       = $this->post('division');
	    $positionID     = $this->post('positionID');

        $id = 0;
        
        $arr = array(
            "approval"      => $approval,
	        "division"      => $division,
	        "positionID"    => $positionID
        );
        $id = $this->approvalmodel->insertApproval($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create approval success',
                "approvalID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create approval"
            );
        }
        $this->response($result,200);
    }
    public function approval_delete()
    {
        $approvalID = $this->delete('approvalID');
        $where = "approvalID = " . $approvalID;
        $this->queuecapcapexmodelexmodel->deleteApproval($where);

        $result = array(
            "status" => "success",
            "detail" => "delete Approval completed"
        );
        $this->response($result, 200);
    } 
}

