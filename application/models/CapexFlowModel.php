<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class CapexFlowModel extends CI_Controller 
{
    public function getCapexFlow()
    {
        $query = $this->db->select("*")->from("capexFlow")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexFlowSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("capexFlow")
                        ->join("capexFlowDetail","capexFlow.capexFlowID = capexFlowDetail.capexFlowID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertCapexFlow($arr)
    {
        $this->db->insert('capexFlow',$arr);
        return $this->db->insert_id();
    }
    public function updateCapexFlow($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capexFlow');
    }
    public function deleteCapexFlow($where)
    {
        $this->db->where($where);
        $this->db->delete('capexFlow');
    }
    
}