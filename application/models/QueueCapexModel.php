<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class QueueCapexModel extends CI_Controller 
{
    public function getQueueCapex()
    {
        $query = $this->db->select("*")->from("QueueCapex")->get();
        $result = $query->result();
        return $result;
    }
    public function getQueueCapexSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("QueueCapex")
                        ->join("capex","QueueCapex.capexID = capex.capexID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertQueueCapex($arr)
    {
        $this->db->insert('QueueCapex',$arr);
        return $this->db->insert_id();
    }
    public function updateQueueCapex($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('QueueCapex');
    }
    public function deleteQueueCapex($where)
    {
        $this->db->where($where);
        $this->db->delete('QueueCapex');
    }
    
}