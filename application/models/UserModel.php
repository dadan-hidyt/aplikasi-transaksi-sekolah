<?php
class  UserModel extends CI_Model 
{
    const TABEL = "tbl_user";
    public function findUserByUsername($username)
    {
        $query = $this->db->get_where(self::TABEL, array("username"=>$username),0,1);
        if ($query->num_rows() > 0) {
           return $query->row_object();
        }
    }
    public function fetchAll()
    {
        return $this->db->get(self::TABEL)->result_object();
    }
    public function getDataUsersBySession($id)
    {
        $row = $this->db->get_where(self::TABEL,['id'=> $id])->row_object();
        if (!is_null($row)) {
            return $row;
        }
    }
    public function findById($id)
    {
        return $this->db->get_where(self::TABEL, ['id'=> $id])->row_object();
    }
    public function deleteById($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete(self::TABEL);
    }
    public function update($data,$id)
    {
        $this->db->where("id", $id);
        return $this->db->update(self::TABEL, $data);
    }
    public function insert($data)
    {
        return $this->db->insert(self::TABEL, $data);
    }
}