<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class CapexModel extends CI_Controller 
{
    public function getCapex()
    {
        $query = $this->db->select("*")->from("capex")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexWhere($arr)
    {
        $query = $this->db->select("*")->from("capex")->where($arr)->get();
        $result = $query->result();
        return $result;
    }

    public function getCapex1()
    {
        $query = $this->db->select("capexID,capexName")->from("capex")->get();
        $result = $query->result();
        return $result;
    }
    
    public function insertCapex($arr)
    {
        $this->db->insert('capex',$arr);
        return $this->db->insert_id();
    }
    public function updateCapex($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capex');
    }
    // public function deleteCapex($where)
    // {
    //     $this->db->delete('capex',$where);
    // }

}