<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class ApprovalModel extends CI_Controller 
{
    public function getApproval()
    {
        $query = $this->db->select("*")->from("Approval")->get();
        $result = $query->result();
        return $result;
    }
    public function getApprovalSelect($arr)
    {
        $query = $this->db->select("*")->from("Approval")->where($arr)->get();
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
        $this->db->delete('capex');
    }

}

// public function getCapex1()
    // {
    //     $query = $this->db->select("capexID,capexName")->from("capex")->get();
    //     $result = $query->result();
    //     return $result;
    // }