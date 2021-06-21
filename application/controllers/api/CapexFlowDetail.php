<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class CapexFlowDetail extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capexflowdetailmodel');
    }
    public function capexFlowDetail_get() 
    {
        $status = $this->get('status');
        $capexFlowDetailID = $this->get('capexFlowDetailID');
        $capexFlowID = $this->get('capexFlowID');
        $capexID = $this->get('capexID');
        
        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->capexflowdetailmodel->getCapexFlowDetail();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "capexFlowDetailID" => $capexFlowDetailID
            );
            $result = $this->capexflowdetailmodel->getCapexFlowDetailSelect($arr);
        }
        else if($status == "capexFlowID"){
            $arr = array(
                "capexFlowID" => $capexFlowID
            );
            $result = $this->capexflowdetailmodel->getCapexFlowDetailSelect($arr);
        }
        else if($status == "capexID"){
            $where = "capexID = '$capexID'";
            $result = $this->capexflowdetailmodel->getCapexFlowDetailSelect($where);  
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function capexFlowDetail_put( )  //	edit approval // แก้ไข capex
    {
        $capexFlowDetailID = $this->put('capexFlowDetailID');
        $capexFlowID = $this->put('capexFlowID');
        $capexID = $this->put('capexID');

        $arr = array(
            "capexID" => $capexID,
            "capexFlowID" => $capexFlowID     
        );
        $where="capexFlowDetailID = $capexFlowDetailID";
        $this->capexflowdetailmodel->updateCapexFlowDetail($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update CapexFlowDetail completed"
        );
        $this->response($result,200);
    }
    public function capexFlowDetail_post()     //6.	create Approval  //สร้าง Approval    
    {
        $capexFlowID = $this->post('capexFlowID');
        $capexID = $this->post('capexID');

        $id = 0;
        
        $arr = array(
            "capexID" => $capexID,
            "capexFlowID" => $capexFlowID    
        );
        $id = $this->capexflowdetailmodel->insertCapexFlowDetail($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create CapexFlowDetail success',
                "capexFlowDetail"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create CapexFlowDetail"
            );
        }
        $this->response($result,200);
    }
    public function capexFlowDetail_delete()
    {
        $capexFlowDetailID = $this->delete('capexFlowDetailID');
        $where = "capexFlowDetailID = " . $capexFlowDetailID;
        $this->capexflowdetailmodel->deleteCapexFlowDetail($where);

        $result = array(
            "status" => "success",
            "detail" => "delete CapexFlowDetail completed"
        );
        $this->response($result, 200);
    }
}

