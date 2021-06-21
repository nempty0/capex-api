<?php
defined('BASEPATH') or exit('No direct script acess allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: origin, content-type, accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
require(APPPATH . 'libraries/RestController.php');
require(APPPATH . 'libraries/Format.php');

use chriskacerguis\RestServer\RestController;

class Member extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('membermodel');
    }

    public function status_get()
    {
        $username = $this->get('username');
        $where = "username = '$username'";
        $result = $this->membermodel->getStatus($where);
        $this->response($result, 200);
    }
}
