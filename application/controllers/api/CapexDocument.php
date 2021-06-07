<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class CapexDocument extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capexdocumentmodel');
    }
    public function capexDocument_get() 
    {
        $status = $this->get('status');
        $docID = $this->get('docID');
        $capexID = $this->get('capexID');

        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->capexdocumentmodel->getCapexDocument();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "docID" => $docID
            );
            $result = $this->capexdocumentmodel->getCapexDocumentSelect($arr);
        }
        else if($status == "capexID"){
            $where = "capexID = '$capexID'";
            $result = $this->capexdocumentmodel->getCapexDocumentSelect($where);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function capexDocument_put( )  //	edit approval // แก้ไข capex
    {
        $docID     = $this->put('$docID');
        $docName       = $this->put('$docName');
	    $capexID      = $this->put('capexID');

        $arr = array(
            "docID"      => $docID,
	        "docName"      => $docName,
	        "capexID"    => $capexID 
        );
        $where="docID = $docID";
        $this->capexdocumentmodel->updateCapexDocument($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update CapexDocument completed"
        );
        $this->response($result,200);
    }
    public function capexDocument_post()     //6.	create Approval  //สร้าง Approval    
    {
        $docName       = $this->post('$docName');
	    $capexID      = $this->post('capexID');

        $id = 0;
        
        $arr = array(
            "docName"      => $docName,
	        "capexID"    => $capexID 
        );
        $id = $this->approvalmodel->insertCapexDocument($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create CapexDocument success',
                "docID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create CapexDocument"
            );
        }
        $this->response($result,200);
    }
    public function capexDocument_delete()
    {
        $docID = $this->delete('docID');
        $where = "docID = " . $docID;
        $this->prioritymodel->deleteCapexDocument($where);

        $result = array(
            "status" => "success",
            "detail" => "delete CapexDocument completed"
        );
        $this->response($result, 200);
    }
}

