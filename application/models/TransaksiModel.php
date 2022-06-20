<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiModel extends CI_Model {
	private const TB_TRAS = "tbl_trans";
	private const TB_SISWA = "tbl_siswa";
	private const TB_PRODUCT = "tbl_produk";
	public function fetchAll($order = null) {
		$this->db->select("SUM(tbl_trans.jumlah_bayar) as subtotal");
        $this->db->select("tbl_trans.*");
        $this->db->select("tbl_siswa.*");
        $this->db->select("tbl_produk.*");
        $this->db->from(self::TB_TRAS);
		$this->db->join(self::TB_PRODUCT, self::TB_TRAS.".kode_produk = ".self::TB_PRODUCT.".kode_produk");
		$this->db->join(self::TB_SISWA, self::TB_TRAS.".nisn = ".self::TB_SISWA.".nisn");
        if (!is_null($order)) {
            $this->db->group_by(self::TB_TRAS.".id_transaksi");
        }
        return $this->db->get()->result_object();
	}
	public function fetchGroupByTanggal(){
		$this->db->group_by("tanggal_transaksi");
		$this->db->select("*");
		$this->db->from(self::TB_TRAS);
		$this->db->join(self::TB_PRODUCT, self::TB_TRAS.".kode_produk = ".self::TB_PRODUCT.".kode_produk");
		return $this->db->get()->result_object();
	}
	public function findByNisn($nisn) {
		$this->db->where("nisn",$nisn);
		$this->db->group_by("id_transaksi");
		return $this->db->get(self::TB_TRAS)->result_object();
	}
	public function insertTransaksi($data)
	{
		foreach ($data as $value) {
			$this->db->insert(self::TB_TRAS,$value);
		}
		return true;
	}
    public function fetchByKodeTransaksi($kode_transaksi = null) {
        $this->db->select("*");
        $this->db->from(self::TB_TRAS);
        $this->db->join(self::TB_PRODUCT, self::TB_TRAS.".kode_produk = ".self::TB_PRODUCT.".kode_produk");
        $this->db->join(self::TB_SISWA , self::TB_TRAS.".nisn=".self::TB_SISWA.".nisn");
        $this->db->where(self::TB_TRAS.".id_transaksi", $kode_transaksi);
        return $this->db->get()->result_object();
    }
}
