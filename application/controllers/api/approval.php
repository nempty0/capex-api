<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/format.php');

use chriskacerguis\RestServer\RestController;

class Approval extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('approvalmodel');
    }
    public function approval_get() //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด, 8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
    {
        $status = $this->get('status');

        if($status == 'all'){
            $result = $this->approvalmodel->getApproval();
        }
        
        $this->response($result,200);
    }
    public function approval_put(  //	edit approval // แก้ไข capex
        $approvalID,
        $approval,
	    $division,
	    $positionName
    )
    {
        $arr = array(
            "approval"      => $approval,
	        "division"      => $division,
	        "positionName"  => $positionName
        );
        $where="approvalID = $approvalID";
        $this->ApprovalModel->updateApproval($arr,$where);
    }
}

class create extends RestController
{
    public function create_post(    //6.	create Approval  //สร้าง Approval
        $approval,
	    $division,
	    $positionName
    ) 
    {
        $arr = array(
            "approval"      => $approval,
	        "division"      => $division,
	        "positionName"  => $positionName
        );
        $this->ApprovalModel->insertApproval($arr);
    }
   
}