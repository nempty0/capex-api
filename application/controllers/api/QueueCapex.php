<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class QueueCapex extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('queuecapexmodel');
    }
    public function queueCapex_get() 
    {
        $status = $this->get('status');
        $capexID = $this->get('capexID');
        $queueID = $this->get('queueID');
        $capexStart = $this->get('capexStart');
        $capexEnd = $this->get('capexEnd');
        
        if($status == "all"){       //	show QueueCapex All // แสดงข้อมูล QueueCapex ทั้งหมด
            $result = $this->queuecapexmodel->getQueueCapex();
        }
        else if($status == "one"){      //	show QueueCapex One  // แสดงข้อมูล QueueCapex เฉพาะ
            $arr = array(
                "queueID" => $queueID
            );
            $result = $this->queuecapexmodel->getQueueCapexSelect($arr);
        }
        else if($status == "capexStart"){
            $arr = array(
                "capexStart" => $capexStart
            );
            $result = $this->queuecapexmodel->getQueueCapexSelect($arr);
        }
        else if($status == "capexEnd"){
            $arr = array(
                "capexEnd" => $capexEnd
            );
            $result = $this->queuecapexmodel->getQueueCapexSelect($arr);
        }
        else if($status == "capexID"){
            $arr = array(
                "capexID" => $capexID
            );
            $result = $this->queuecapexmodel->getQueueCapexSelect($arr);
        }
        else{   // status ไม่ตรงกับเงื่อนไข
            $result = array(
               "Status" => "This status is not available"
            );   
        }
        
        $this->response($result,200);
    }
    public function queueCapex_put( )  //	edit QueueCapex // แก้ไข QueueCapex
    {
        $capexID = $this->put('capexID');
        $queueID = $this->put('queueID');
        $capexStart = $this->put('capexStart');
        $capexEnd = $this->put('capexEnd');

        $arr = array(
            "capexStart" => $capexStart,
            "capexEnd" => $capexEnd,
            "capexID" => $capexID
        );
        $where="queueID = $queueID";
        $this->queuecapexmodel->updateQueueCapex($arr,$where);
        $result = array(
            "status" => "success",
            "detail" => "update QueueCapex completed"
        );
        $this->response($result,200);
    }
    public function queueCapex_post()     //6.	create QueueCapex  //สร้าง QueueCapex    
    {
        $capexID = $this->put('capexID');
        $capexStart = $this->put('capexStart');
        $capexEnd = $this->put('capexEnd');

        $id = 0;
        
        $arr = array(
            "capexStart" => $capexStart,
            "capexEnd" => $capexEnd,
            "capexID" => $capexID
        );
        $id = $this->queuecapexmodel->insertQueueCapex($arr);

        if($id != 0 ){
            $result = array(
                "status" => 'success',
                "detail" => 'create QueueCapex success',
                "queueID"=> $id
            );
        }else{
            $result = array(
                "status" => "error",
                "detail" => "can' not create QueueCapex"
            );
        }
        $this->response($result,200);
    }
    public function queueCapex_delete()
    {
        $queueID = $this->delete('queueID');
        $where = "queueID = " . $queueID;
        $this->queuecapexmodel->deleteQueueCapex($where);

        $result = array(
            "status" => "success",
            "detail" => "delete QueueCapex completed"
        );
        $this->response($result, 200);
    }
}

