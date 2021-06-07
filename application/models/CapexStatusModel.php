<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class CapexStatusModel extends CI_Controller 
{
    public function getCapexStatus()
    {
        $query = $this->db->select("*")->from("capexStatus")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexStatusSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("capexStatus")
                        ->join("capex","capexStatus.capexStatusID = capex.capexStatusID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertCapexStatus($arr)
    {
        $this->db->insert('capexStatus',$arr);
        return $this->db->insert_id();
    }
    public function updateCapexStatus($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capexStatus');
    }
    public function deleteCapexStatus($where)
    {
        $this->db->where($where);
        $this->db->delete('capexStatus');
    }
    
}