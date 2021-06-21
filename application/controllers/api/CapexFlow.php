<?php
defined('BASEPATH') or exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH . 'libraries/RestController.php');
require(APPPATH . 'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class CapexFlow extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capexflowmodel');
        $this->load->model('capexmodel');
    }
    public function capexFlow_get()
    {
        $status = $this->get('status');
        $flowID = $this->get('capexFlowID');
        $flowStatus = $this->get('flowStatus');
        $capexFlowID = $this->get('capexFlowID');
        $division = $this->get("division");

        if ($status == "all") {       //7.	show Approval All // แสดงข้อมูล Approval ทั้งหมด
            $result = $this->capexflowmodel->getCapexFlow();
        } else if ($status == "one") {      //8.	show Approval One  // แสดงข้อมูล Approval เฉพาะ
            $arr = array(
                "capexFlowID" => $capexFlowID
            );
            $result = $this->capexflowmodel->getCapexFlowSelect($arr);
        } else if ($status == "flowID") {
            $arr = array(
                "flowID" => $flowID
            );
            $result = $this->capexflowmodel->getCapexFlowSelect($arr);
        } else if ($status == "flowStatus") {
            $arr = array(
                "flowStatus" => $flowStatus
            );
            $result = $this->capexflowmodel->getCapexFlowSelect($arr);
        } else if ($status == "division") {
            $where = "capex.division = '$division'";
            $result = $this->capexflowmodel->getCapexFlowData($where);
        } else {   // status ไม่ตรงกับเงื่อนไข
            $result = array(
                "Status" => "This status is not available"
            );
        }

        $this->response($result, 200);
    }
    public function capexFlow_put()  //	edit approval // แก้ไข capex
    {
        $flowID = $this->put('flowID');
        $flowStatus = $this->put('flowStatus');
        //$capexFlowID = $this->put('capexFlowID');

        // $arr = array(
        //     "flowID" => $flowID,
        //     "flowStatus" => $flowStatus,
        //     "capexFlowID" => $capexFlowID
        // );

        $arr = array(
            "flowStatus" => $flowStatus
        );
        $where = "flowID = $flowID";
        $this->capexflowmodel->updateCapexFlow($arr, $where);
        $result = array(
            "status" => "success",
            "detail" => "update Capex Flow completed"
        );
        $this->response($result, 200);
    }
    public function capexFlow_post()     //6.	create Approval  //สร้าง Approval    
    {
        $flowID = $this->post('flowID');
        $flowStatus = $this->post('flowStatus');

        $id = 0;

        $arr = array(
            "flowID" => $flowID,
            "flowStatus" => $flowStatus
        );
        $id = $this->capexflowmodel->insertCapexFlow($arr);

        if ($id != 0) {
            $result = array(
                "status" => 'success',
                "detail" => 'create CapexFlow success',
                "capexFlowID" => $id
            );
        } else {
            $result = array(
                "status" => "error",
                "detail" => "can' not create CapexFlow"
            );
        }
        $this->response($result, 200);
    }
    public function capexFlow_delete()
    {
        $capexFlowID = $this->delete('capexFlowID');
        $where = "capexFlowID = " . $capexFlowID;
        $this->capexflowmodel->deleteCapexFlow($where);

        $result = array(
            "status" => "success",
            "detail" => "delete CapexFlow completed"
        );
        $this->response($result, 200);
    }
}
