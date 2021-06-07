<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Priority extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('prioritymodel');
    }
    public function priority_get() 
    {
        $status = $this->get('status');
        $priorityID = $this->get('docID');
        $priorityName = $this->get('priorityName');

        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->prioritymodel->getPriority();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "priorityID" => $priorityID
            );
            $result = $this->prioritymodel->getPrioritySelect($arr);
        }
        else if($status == "priorityName"){
            $arr = array(
                "priorityName" => $priorityName
            );
            $result = $this->prioritymodel->getPrioritySelect($arr);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function priority_put( )  //	edit approval // แก้ไข capex
    {
        $priorityID = $this->put('docID');
        $priorityName = $this->put('priorityName');

        $arr = array(
            "priorityID" => $priorityID,
            "priorityName" => $priorityName
        );
        $where="priorityID = $priorityID";
        $this->prioritymodel->updatePriority($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update Priority completed"
        );
        $this->response($result,200);
    }
    public function priority_post()     //6.	create Approval  //สร้าง Approval    
    {
        $priorityName = $this->post('priorityName');

        $id = 0;
        
        $arr = array(
            "priorityName" => $priorityName
        );
        $id = $this->prioritymodel->insertPriority($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create Priority success',
                "priorityID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create Priority"
            );
        }
        $this->response($result,200);
    }
    public function priority_delete()
    {
        $priorityID = $this->delete('priorityID');
        $where = "priorityID = " . $priorityID;
        $this->prioritymodel->deletePriority($where);

        $result = array(
            "status" => "success",
            "detail" => "delete Priority completed"
        );
        $this->response($result, 200);
    }
}

