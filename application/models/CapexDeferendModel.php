<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class CapexDeferendModel extends CI_model 
{
    public function getCapexDeferend()
    {
        $query = $this->db->select("*")->from("capexDeferend")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexDeferendSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("capexDeferend")
                        ->join("capex","capexDeferend.capexID = capex.capexID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertCapexDeferend($arr)
    {
        $this->db->insert('capexDeferend',$arr);
        return $this->db->insert_id();
    }
    public function updateCapexDeferend($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capexDeferend');
    }
    public function deleteCapexDeferend($where)
    {
        $this->db->where($where);
        $this->db->delete('capexDeferend');
    }
    
}