<?php
defined('BASEPATH') or exit('No direct script acess allowed');

class CapexModel extends CI_model
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
            ->join("classification", "classification.classificationID = capex.classificationID", "inner")
            ->join("priority", "priority.priorityID = capex.priorityID", "inner")
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
            ->join("classification", "classification.classificationID = capex.classificationID", "inner")
            ->join("priority", "priority.priorityID = capex.priorityID", "inner")
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

    public function getInfo($where)
    {
        $query = $this->db->select("COUNT(capexStatus.capexStatusName) AS c,capexStatus.capexStatusName")
            ->from("capex")
            ->join("capexStatus", "capexStatus.capexStatusID = capex.capexStatusID", "inner")
            ->where($where)
            ->group_by('capexStatus.capexStatusName')
            ->get();
        $result = $query->result();
        return $result;
    }

    public function getCapexCount($where)
    {
        $query = $this->db->select("SUM(capex.totalPlan) AS total,capex.division")
            ->from("capex")
            ->where($where)
            ->group_by('capex.division')
            ->get();
        $result = $query->result();
        return $result;
    }
}
 // public function getCapex1()
    // {
    //     $query = $this->db->select("capexID,capexName")->from("capex")->get();
    //     $result = $query->result();
    //     return $result;
    // }