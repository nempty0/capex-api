<?php
defined('BASEPATH') or exit('No direct script acess allowed');

class CapexFlowModel extends CI_model
{
    public function getCapexFlow()
    {
        $query = $this->db->select("*")->from("capexFlow")->get();
        $result = $query->result();
        return $result;
    }
    public function getCapexFlowSelect($arr)
    {
        $query = $this->db->select("*")
            ->from("capexFlow")
            ->join("capexFlowDetail", "capexFlow.capexFlowID = capexFlowDetail.capexFlowID")
            ->where($arr)
            ->get();
        $result = $query->result();
        return $result;
    }

    public function getCapexFlowData($arr)
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

    public function insertCapexFlow($arr)
    {
        $this->db->insert('capexFlow', $arr);
        return $this->db->insert_id();
    }
    public function updateCapexFlow($arr, $where)
    {
        $this->db->set($arr);
        $this->db->where($where);
        $this->db->update('capexFlow');
    }
    public function deleteCapexFlow($where)
    {
        $this->db->where($where);
        $this->db->delete('capexFlow');
    }
}
