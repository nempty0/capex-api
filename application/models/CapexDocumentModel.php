<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class CapexDocumentModel extends CI_Controller 
{
    public function getCapexDocument()
    {
        $query = $this->db->select("*")->from("capexDocument")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexDocumentSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("capexDocument")
                        ->join("capex","capexDocument.capexID = capex.capexID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertCapexDocument($arr)
    {
        $this->db->insert('capexDocument',$arr);
        return $this->db->insert_id();
    }
    public function updateCapexDocument($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capexDocument');
    }
    public function deleteCapexDocument($where)
    {
        $this->db->where($where);
        $this->db->delete('capexDocument');
    }
}