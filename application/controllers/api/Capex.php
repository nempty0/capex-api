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
    public function capex_get() 
    {
        $capexID = $this->get('capexID');
        $division = $this->get('division');
        $capexStatusID = $this->get('capexStatusID');
        $status = $this->get('status');

        if($status == "all"){   //1.	Show Capex All   //แสดงข้อมูล capex ทั้งหมด
            $result = $this->capexmodel->getCapex();
        }
        
        if($status == "one"){   //2.	Show Capex One // แสดงข้อมูล capex เฉพาะ
            $arr = array(
            "capexID" => $capexID,   
            );
            $result = $this->capexmodel->getCapexWhere($arr);        
        }
        
        if($status == "division"){  //9.	show Capex for each Division  // แสดงข้อมูล Capex เฉพาะแผนก
            $arr = array(
            "division" => $division,   
            );
            $result = $this->capexmodel->getCapexWhere($arr);         
        } 

        if($status == "approval"){
            $arr = array(
                "capexStatusID" => $capexStatusID
            );
            $result = $this->capexmodel->getCapexWhere($arr);
        }
        $this->response($result,200);  
    //    $result = array(
    //        "status" => "success"
    //    );
       

        // foreach ($capex->result() as $row){
        //     echo $row->capexName."<br>";
        // }
        
    }
    // public function capexID_get() //2.	Show Capex One // แสดงข้อมูล capex เฉพาะ
    // {      
    //     $capexID = $this->get('capexID');
    //     $arr = array(
    //         "capexID" => $capexID,   
    //     );
    //     $result = $this->capexmodel->getCapexOne($arr);
    //     $this->response($result,200);
        
    // }
    // public function capexDivision_get($division) //9.	show Capex for each Division  // แสดงข้อมูล Capex เฉพาะแผนก
    // {      
    //     $result = $this->CapexModel->getCapex();
    //     $this->response($result,200);
        
    // }
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
            $expectation,
            $statusID
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
                "expectation"       => $expectation,
                "statusID"          => $statusID
            );
            $this->capexmodel->insertCapex($arr);
            $this->response($arr,200);
        }    
}


/*
{
    "capexName": "Test3",
    "classificationID": 789, 
    "priorityID": 1,
    "division": "IT",   
    "capexYear":"300000",     
    "totalPlan": 500000 , 
    "h1Plan": 150000,     
   "h2Plan": 150000,
    "goal": "goal",
    "mainComponents": "main",
    "expectation": "exp",
	"capexStatusID": 2

}
*/
