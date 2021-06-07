<?php
defined('BASEPATH') or exit('No direct script acess allowed');

class CapexModel extends CI_Controller
{
    public function getCapex()
    {
        $query = $this->db->select("*")->from("capex")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexSelect($arr)
    {
        $query = $this->db->select("*")
            ->from("capex")
            ->join("classification", "capex.classificationID = classification.classificationID", "inner")
            ->join("priority", "capex.priorityID = priority.priorityID", "inner")
            ->join("capexStatus", "capexStatus.capexStatusID = capex.capexStatusID", "inner")
            ->where($arr)
            ->get();
        $result = $query->result();
        return $result;
    }

    public function getCapexApproval($arr)
    {
        $query = $this->db->select("*")
            ->from("capex")
            ->join("classification", "capex.classificationID = classification.classificationID", "inner")
            ->join("priority", "capex.priorityID = priority.priorityID", "inner")
            ->join("capexStatus", "capexStatus.capexStatusID = capex.capexStatusID", "inner")
            ->join("capexFlowDetail", "capexFlowDetail.capexID = capex.capexID", "inner")
            ->join("capexFlow", "capexFlow.capexFlowID = capexFlowDetail.capexFlowID", "inner")
            ->where($arr)
            ->get();
        $result = $query->result();
        return $result;
    }

    public function insertCapex($arr)
    {
        $this->db->insert('capex', $arr);
        return $this->db->insert_id();
    }
    public function updateCapex($arr, $where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capex');
    }
    public function deleteCapex($where)
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