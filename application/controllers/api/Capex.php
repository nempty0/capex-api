<?php
defined('BASEPATH') OR exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH.'libraries/RestController.php');
require(APPPATH.'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Capex extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capexmodel');
    }
    public function capex_get() //1.	Show Capex All   //แสดงข้อมูล capex ทั้งหมด
    {      
        $result = $this->capexmodel->getCapex();
    //    $result = array(
    //        "status" => "success"
    //    );
        $this->response($result,200);

        // foreach ($capex->result() as $row){
        //     echo $row->capexName."<br>";
        // }
        
    }
    public function capexID_get($capexID) //2.	Show Capex One // แสดงข้อมูล capex เฉพาะ
    {      
        $result = $this->CapexModel->getCapex();
        $this->response($result,200);
        
    }
    public function capexDivision_get($division) //9.	show Capex for each Division  // แสดงข้อมูล Capex เฉพาะแผนก
    {      
        $result = $this->CapexModel->getCapex();
        $this->response($result,200);
        
    }
    public function capex_put(     //4.	edit Capex // แก้ไข capex
        $capexID,
        $capexName,
        $classificationID, 
        $priorityID,
        $division,     
        $capexYear,      
        $totalPlan,  
        $h1Plan,    
        $h2Plan,
        $goal,
        $mainComponents,
        $expectation
    )  
    {
        // $arr = array(
        //     "capexName" => "Test1"
        // );
        // $where = "capexID = 1";
        // $this->CapexMpdel->updateCapex($arr,$where);
        $arr = array(
            "capexName"         => $capexName,
            "classificationID"  => $classificationID,
            "prioityID"         => $priorityID,
            "division"          => $division,
            "capexYear"         => $capexYear,      
            "totalPlan"         => $totalPlan,
            "h1Plan"            => $h1Plan,    
            "h2Plan"            => $h2Plan,
            "goal"              => $goal,
            "mainComponents"    => $mainComponents,
            "expectation"       => $expectation
        );
        $where = "capexID = $capexID";
        $this->CapexMpdel->updateCapex($arr,$where);
    }
    public function approval_get($capexStatusID)  //5.	show Capex Approv  // แสดงข้อมูล capex ที่ approv แล้ว
    {
        $result = $this->CapexModel->getCapex();
        $this->response($result,200);
    }
    public function create_post(    //3.	create Capex  // สร้าง capex
            $capexName,
            $classificationID, 
            $priorityID,
            $division,     
            $capexYear,      
            $totalPlan,  
            $h1Plan,    
            $h2Plan,
            $goal,
            $mainComponents,
            $expectation
        ) 
        {
            $arr = array(
                "capexName"         => $capexName,
                "classificationID"  => $classificationID,
                "prioityID"         => $priorityID,
                "division"          => $division,
                "capexYear"         => $capexYear,      
                "totalPlan"         => $totalPlan,
                "h1Plan"            => $h1Plan,    
                "h2Plan"            => $h2Plan,
                "goal"              => $goal,
                "mainComponents"    => $mainComponents,
                "expectation"       => $expectation
            );
            $this->CapexModel->insertCapex($arr);
        }    
}
