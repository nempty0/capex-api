<?php
defined('BASEPATH') OR exit('No direct script acess allowed');

class PriorityModel extends CI_Controller 
{
    public function getClassification()
    {
        $query = $this->db->select("*")->from("classification")->get();
        $result = $query->result();
        return $result;
    }
    public function getClassificationSelect($arr)
    {
        $query = $this->db->select("*")
                        ->from("classification")
                        ->join("capex","classification.classificationID = capex.classificationID")
                        ->where($arr)
                        ->get();
        $result = $query->result();
        return $result;
    } 
    public function insertClassification($arr)
    {
        $this->db->insert('classification',$arr);
        return $this->db->insert_id();
    }
    public function updateClassification($arr,$where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('classification');
    }
    public function deleteClassification($where)
    {
        $this->db->where($where);
        $this->db->delete('classification');
    }
    
}