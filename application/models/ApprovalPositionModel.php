<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class ApprovalPositionModel extends CI_Controller 
{
    public function getApprovalPosition()
    {
        $query = $this->db->select("*")->from("ApprovalPosition")->get();
        $result = $query->result();
        return $result;
    }
    public function getApprovalPositionSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("ApprovalPosition")
                        ->join("Approval","ApprovalPosition.positionID = Approval.positionID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertApprovalPosition($arr)
    {
        $this->db->insert('ApprovalPosition',$arr);
        return $this->db->insert_id();
    }
    public function updateApprovalPosition($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('ApprovalPosition');
    }
    public function deleteApprovalPosition($where)
    {
        $this->db->where($where);
        $this->db->delete('ApprovalPosition');
    }
    
}