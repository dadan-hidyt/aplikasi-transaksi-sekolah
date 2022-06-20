<?php
defined("BASEPATH") or exit("Tidak dapat mengakses secara langsung halaman ini!");
class SiswaModel extends CI_Model 
{
	const TABEL = "tbl_siswa";
	//mendapatkan semua data di tabel tbl_siswa
	public function fetchAll()
	{
		return $this->db->get(self::TABEL)->result_object();
	}
	//menginsert data
	public function insert($data)
	{
		return $this->db->insert(self::TABEL,$data);
	}
	public function checkNisn($nisn)
	{
		if ($this->db->get_where(self::TABEL, ['nisn'=>$nisn])->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function update($data, $id) 
	{
		$this->db->where("id_siswa", $id);
		return $this->db->update(self::TABEL, $data);
	}
	public function findByNisn($nisn)
	{
		return $this->db->get_where(self::TABEL,['nisn'=>$nisn])->row_object();
	}
	public function findById($id)
	{
		$this->db->where("id_siswa", $id);
		return $this->db->get(self::TABEL)->row_object();
	}
	public function deleteById($id)
	{
		$this->db->where("id_siswa", $id);
		return $this->db->delete(self::TABEL);
	}
}


 ?>
