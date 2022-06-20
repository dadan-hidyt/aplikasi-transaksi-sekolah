<?php
class LaporanTransaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("TransaksiModel");
	}
	public function index()
	{

		$tanggal_transaksi = $this->TransaksiModel->fetchGroupByTanggal();
		foreach ($tanggal_transaksi as $value) {
			$e =  strtotime($value->tanggal_transaksi);
		}
		$this->load->view("partials/head", [
			'title' => "Laporan",
			'bodyId' => "page-top"
		]);
		$this->load->view("partials/sidebar");
		$this->load->view("pages/laporan-transaksi");
		$this->load->view("partials/footer");
	}
    //ini  bagian cetak laporan dan membuat file pdf
	public function cetak()
	{
		$this->load->model("CommonModel");
		$setting = $this->CommonModel->getSetting();
		$this->load->library("LibFpdf");
		if ($this->input->get("start")) {
			$start = $this->input->get("start");
			$end = $this->input->get("end");
			$reformatStart = date("d-m-Y", strtotime($start));
			$reformatend = date("d-m-Y", strtotime($end));
			$this->db->where('tanggal_transaksi >=', $reformatStart);
			$this->db->where('tanggal_transaksi <=', $reformatend);
			$this->db->join("tbl_siswa", "tbl_trans.nisn=tbl_siswa.nisn");
			$this->db->join("tbl_produk", "tbl_trans.kode_produk=tbl_produk.kode_produk");
            $this->db->group_by("tbl_trans.id_transaksi");
			$data = $this->db->get('tbl_trans')->result_object();

			if (!empty($data)) {
				$pdf = new FPDF('l', 'mm', 'A5');
				// membuat halaman baru
				$pdf->AddPage();
				// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
				$pdf->SetFont('Arial', 'B', 16);
				// judul
				$pdf->Cell(190, 7, $setting->nama_intansi, 0, 1, 'C');
				$pdf->SetFont('Arial', 'B', 12);
				$pdf->Cell(190, 7, "Laporan transaksi tanggal {$reformatStart} sampai {$reformatend}", 0, 1, 'C');
				// Memberikan space kebawah agar tidak terlalu rapat
				$pdf->Cell(10, 7, '', 0, 1);
				$pdf->SetFont('Arial', 'B', 10);
				$pdf->Cell(54, 6, 'KODE', 1, 0);
				$pdf->Cell(50, 6, 'NAMA SISWA', 1, 0);
				$pdf->Cell(20, 6, 'ITEMS', 1, 0);
				$pdf->Cell(35, 6, 'BULAN BAYAR', 1, 0);
				$pdf->Cell(30, 6, 'TOTAL BAYAR', 1, 1);
				$pdf->SetFont('Arial', '', 7);
				$total = 0;
				foreach ($data as  $value) {
					$pdf->Cell(54, 6, $value->id_transaksi, 1, 0);
					$pdf->Cell(50, 6, $value->nama, 1, 0);
                    $str = "[ ";
                    $trans = $this->db->query("SELECT tbl_produk.nama_produk FROM tbl_trans INNER JOIN tbl_produk ON tbl_trans.kode_produk = tbl_produk.kode_produk WHERE tbl_trans.id_transaksi='".$value->id_transaksi."'");
                    foreach ($trans->result_array() as $tr) {
                        $str .= "{$tr['nama_produk']},";
                    }
                    $str = trim($str,',');
                    $str .= " ]";
					$pdf->Cell(20, 6, $str, 1, 0);
					$pdf->Cell(35, 6, $value->bulan_bayar, 1, 0);
					$pdf->Cell(30, 6, "RP " . number_format($value->total_bayar, 0, '', ','), 1, 0);
					$pdf->Cell(30, 6, 0, '', 1, 0);
					$total +=  $value->total_bayar;
				}
				$pdf->Cell(54, 6, '', 0, 0);
				$pdf->Cell(50, 6, '', 0, 0);
				$pdf->Cell(20, 6, '', 0, 0);
				$pdf->Cell(35, 6, 'Total: ', 1, 0);
				$pdf->Cell(30, 6, "RP " . number_format($total, 0, '', ','), 1, 0);
				$pdf->Cell(30, 6, 0, '', 1, 0);
				$pdf->Output();
			}
		}
	}
}
