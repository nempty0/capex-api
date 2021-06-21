<?php

class MemberModel extends CI_model
{
    public function getStatus($where)
    {
        $query = $this->db->select("*")
            ->from("member")
            ->join("memberStatus", "member.memberStatusID = memberStatus.memberStatusID", "inner")
            ->where($where)
            ->get();
        $result = $query->result();
        return $result;
    }
}
