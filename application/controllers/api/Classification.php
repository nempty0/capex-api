<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Classification extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(' classificationmodel');
    }
    public function classification_get() 
    {
        $status = $this->get('status');
        $classificationID = $this->get('classificationID');
        $classificationName = $this->get('classificationName');

        if($status == "all"){       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->classificationmodel->getClassification();
        }
        else if($status == "one"){      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "classificationID" => $classificationID
            );
            $result = $this->classificationmodel->getClassificationSelect($arr);
        }
        else if($status == "classificationName"){
            $arr = array(
                "classificationName" => $classificationName
            );
            $result = $this->classificationmodel->getClassificationSelect($arr);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function classification_put( )  //	edit approval // แก้ไข capex
    {
        $classificationID = $this->put('classificationID');
        $classificationName = $this->put('classificationName');

        $arr = array(
            "classificationID" => $classificationID,
            "classificationName" => $classificationName
        );
        $where="classificationID = $classificationID";
        $this->classificationmodel->updateClassification($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update Classification completed"
        );
        $this->response($result,200);
    }
    public function classificationy_post()     //6.	create Approval  //สร้าง Approval    
    {
        $classificationName = $this->post('classificationName');

        $id = 0;
        
        $arr = array(
            "classificationName" => $classificationName
        );
        $id = $this->classificationmodel->insertClassification($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create Classification success',
                "classificationID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create Classification"
            );
        }
        $this->response($result,200);
    }
    public function classification_delete()
    {
        $classificationID = $this->delete('classificationID');
        $where = "classificationID = " . $classificationID;
        $this->classificationmodel->deleteClassification($where);

        $result = array(
            "status" => "success",
            "detail" => "delete Classification completed"
        );
        $this->response($result, 200);
    }
}

