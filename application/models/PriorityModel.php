<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class PriorityModel extends CI_Controller 
{
    public function getPriority()
    {
        $query = $this->db->select("*")->from("priority")->get();
        $result = $query->result();
        return $result;
    }
    public function getPrioritySelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("priority")
                        ->join("capex","priority.priorityID = capex.priorityID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertPriority($arr)
    {
        $this->db->insert('priority',$arr);
        return $this->db->insert_id();
    }
    public function updatePriority($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('priority');
    }
    public function deletePriority($where)
    {
        $this->db->where($where);
        $this->db->delete('priority');
    }
    
}