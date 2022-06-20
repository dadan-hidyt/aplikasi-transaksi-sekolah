<?php
class CommonModel extends CI_Model
{
    const TB_PRODUCT= "tbl_produk";
    const TB_SISWA  = "tbl_siswa";
    const TB_TRANS  = "tbl_trans";
    public function countProducts()
    {
        return $this->db->get(self::TB_PRODUCT)->num_rows();
    }
    public function countSiswa()
    {
        return $this->db->get(self::TB_SISWA)->num_rows();
    }
    public function countTransaction()
    {
        return $this->db->get(self::TB_TRANS)->num_rows();
    }
    public function totalUangTransaksi()
    {
        $bayar =  $this->db->query("SELECT total_bayar FROM ".self::TB_TRANS." GROUP BY id_transaksi")->result_object();
        $total = 0;
        foreach ($bayar as $byr) {
           $total += $byr->total_bayar;
        }
        return $total;
    }
    public function getSetting()
    {
        return $this->db->get("tbl_setting")->row_object();
    }
}