<?php

class CapexNoModel extends CI_model
{

    public function checkNo($capexID)
    {
        $where = "capexID = '$capexID'";
        $query = $this->db->select('capexNo')
            ->from('capex')
            ->where($where)
            ->get();
        $result = $query->result();
        return $result;
    }
    public function getNo($year)
    {
        $where = "capexYear = '$year' ";
        $query = $this->db->select('capexNo')
            ->from('capex')
            ->order_by('capexNo', "DESC")
            ->where($where)
            ->get();
        $result = $query->result();
        return $result;
    }
}
