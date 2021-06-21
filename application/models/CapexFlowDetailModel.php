<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class CapexFlowDetailModel extends CI_model 
{
    public function getCapexFlowDetail()
    {
        $query = $this->db->select("*")->from("capexFlowDetail")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexFlowDetailSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("capexFlowDetail")
                        ->join("capexFlow","capexFlowDetail.capexFlowID = capexFlow.capexFlowID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertCapexFlowDetail($arr)
    {
        $this->db->insert('capexFlowDetail',$arr);
        return $this->db->insert_id();
    }
    public function updateCapexFlowDetail($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capexFlowDetail');
    }
    public function deleteCapexFlowDetail($where)
    {
        $this->db->where($where);
        $this->db->delete('capexFlowDetail');
    }
    
}