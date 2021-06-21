<?php
defined('BASEPATH') or exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH . 'libraries/RestController.php');
require(APPPATH . 'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class CapexNo extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('capexnomodel');
        $this->load->model('capexmodel');
    }

    public function capexno_post()
    {
        $year = $this->post("year");
        $capexID = $this->post('capexID');

        $check = $this->capexnomodel->checkNo($capexID);
        $result = array();
        if ($check[0]->capexNo != null) {
            $result = array(
                "status"    => "error",
                "detail"    => "this capex haved capexNo"
            );
        } else {
            $data = $this->capexnomodel->getNo($year);

            $capexNo = $data[0]->capexNo + 1;

            $arr = array(
                "capexNo" => $capexNo
            );
            $where = "capexID = '$capexID'";
            $this->capexmodel->updateCapex($arr, $where);

            $result = array(
                "capexNo" => $capexNo
            );
        }
        // $data = $this->capexnomodel->getNo($year);

        // $capexNo = $data[0]->capexNo + 1;

        // $result = array(
        //     "capexNo"   => $capexNo,
        //     "capexID"   => $capexID,
        //     "year"      => $year
        // );

        $this->response($result, 200);
    }
}
