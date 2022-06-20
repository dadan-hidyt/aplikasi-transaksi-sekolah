<?php
class ProductModel extends CI_Model
{
    const TABEL = "tbl_produk";
    public function getAllProduct()
    {
        return $this->db->get(self::TABEL)->result_object();
    }
    public function deleteByKodeProduct($code)
    {
        return $this->db->delete(self::TABEL,['kode_produk'=>$code]);
    }
    public function findProductByKode($kode_produk) 
    {
        return $this->db->get_where(self::TABEL, ['kode_produk'=> $kode_produk])->row_object();
    }
    public function update($data, $kode_produk)
    {
        $this->db->where("kode_produk", $kode_produk);
        return $this->db->update(self::TABEL, $data);
    }
    public function insert($data) 
    {
        return $this->db->insert(self::TABEL,$data);
    }
}
