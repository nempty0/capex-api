<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class ApprovalModel extends CI_model 
{
    public function getApproval()
    {
        $query = $this->db->select("*")->from("Approval")->get();
        $result = $query->result();
        return $result;
    }
    public function getApprovalSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("Approval")
                        ->join("ApprovalPosition","Approval.positionID = ApprovalPosition.positionID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertApproval($arr)
    {
        $this->db->insert('Approval',$arr);
        return $this->db->insert_id();
    }
    public function updateApproval($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('Approval');
    }
    public function deleteApproval($where)
    {
        $this->db->where($where);
        $this->db->delete('Approval');
    }
}