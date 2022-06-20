<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi extends CI_Controller
{
    private $data = array();
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("user_id")) {
            $this->session->set_flashdata("login_error", "Kamu harus login dulu!");
            redirect('login');
        }
        if ($this->session->userdata("akses") === 'kepsek') {
            redirect('dashboard');
        }
        $this->load->model("TransaksiModel");
        $this->load->model("UserModel");
        $this->load->model("SiswaModel");
        $this->load->model("ProductModel");
        $this->load->library("Cart");
    }
    public function output()
    {
        if (!empty($this->input->get()) OR !empty($this->input->post())) {
            $nisn = $this->input->get("siswa");
            $tx = $this->input->get("transaksi");
            if (empty($nisn) && empty($tx)) {
                $nisn = $this->input->post("siswa");
                $tx = $this->input->post("transaksi");
            }
            $siswa = $this->SiswaModel->findByNisn($nisn);
            $kasir = $this->UserModel->findById($this->session->userdata('user_id'))->username;
            $trxdata = $this->db->query("SELECT * FROM tbl_trans WHERE nisn='$nisn' AND id_transaksi='$tx'")->result_object();
            $grandtotal = 0;
            foreach ($trxdata as $value) {
                $data[] = array(
                    "id_transaksi" => $tx,
                    "tanggal_transaksi" => $value->tanggal_transaksi,
                    "qty" => $value->qty,
                    "nisn" => $nisn,
                    "bulan_bayar" => $value->bulan_bayar,
                    "kode_produk" => $value->kode_produk,
                    "jumlah_bayar" => $value->jumlah_bayar,
                    "total_bayar" => $value->total_bayar,
                    "kurang_bayar" => $value->kurang_bayar,

                );
                $grandtotal += $value->jumlah_bayar;
                $total_bayar = $value->total_bayar;
                $belum_bayar = $value->kurang_bayar;
                $waktu = $value->tanggal_transaksi;
            }

            $data['data_trx'] = array(
                'kasir' => $kasir,
                "siswa" => $siswa->nama,
                "id_transaksi" => $tx,
                "subtotal" => $grandtotal,
                "waktu" => $waktu,
                "cash" => $total_bayar,
                "belum_bayar" => $belum_bayar
            );
        $this->load->view("partials/head",['title'=>"struk"]);
            echo $this->_print_struk($data);
        } else {
            exit("no output");
        }
    }

    public function getdataajax($nisn = null)
    {
        if (is_null($nisn)) {
            echo "gagal mendapatkan data";
        }
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = $this->TransaksiModel->findByNisn($nisn);
        if (!empty($data)) {
            foreach ($data as $value) {
                echo "<option value='{$value->id_transaksi}'>{$value->id_transaksi} {$value->tanggal_transaksi} </option>";
            }
        } else {
            echo 0;
        }
    }
    public function cetak_ulang_struk()
    {
        $data = $this->SiswaModel->fetchAll();
        $this->load->view("partials/head", [
            'title' => "Cetak Ulang Struk",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/cetak-ulang-struk", ['siswa' => $data]);
        $this->load->view("partials/footer");
    }
    public function index()
    {
        $this->data['DataTransaksi'] = $this->TransaksiModel->fetchAll(true);
        $this->load->view("partials/head", [
            'title' => "Transaksi",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/transaksi", $this->data);
        $this->load->view("partials/footer");
    }
    public function readCart()
    {
        if (!empty($this->cart->contents())) {
            return $this->cart->contents();
        }
    }
    public function add()
    {
        $this->data['DataProduk'] = $this->ProductModel->getAllProduct();
        $this->data['UserData'] = $this->UserModel->getDataUsersBySession($this->session->userdata("user_id"));
        $this->data['DataSiswa'] = $this->SiswaModel->fetchAll();
        $this->data['cartData'] = $this->readCart();
        $this->data['cart_sub_total'] = $this->cart->total();
        $this->load->view("partials/head", [
            'title' => "Tambah transaksi",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/add-transaksi", $this->data);
        $this->load->view("partials/footer");
    }
    public function cart_item_delete($rowId = null)
    {
        if (is_null($rowId)) {
            redirect('transaksi/add');
        } else {
            $data = array(
                'rowid' => $rowId,
                'qty'   => 0
            );
            $this->cart->update($data);
            $this->session->set_flashdata("cart_msg", "<p class='alert alert-success'>Item Berhasil di hapus dari cart!</p>");
            redirect('transaksi/add');
        }
    }
    public function addCart()
    {
        if ($this->input->server("REQUEST_METHOD") === "POST") {
            $produk_yang_bayarnya_bulanan = array(
                'spp',
                'bayar spp',
                'bayar-spp'
            );
            $kode =  $this->input->post("kode-produk");
            $bulan_bayar_dari = $this->input->post('bulan1');
            $bulan_bayar_sampe = $this->input->post('bulan2');
            $qty = (int) $this->input->post('qty');
            $bulan_bayar = "";
            if ($qty < 1) {
                $qty = 1;
            }
            if (($product = $this->ProductModel->findProductByKode($kode)) && $kode !== '') {
                $harga = $product->harga_produk;
                if (in_array(strtolower($product->nama_produk), $produk_yang_bayarnya_bulanan)) {
                    if (!empty($bulan_bayar_sampe)) {
                        $harga = $product->harga_produk * ($bulan_bayar_sampe - $bulan_bayar_dari + 1);
                    } else {
                        $harga = $product->harga_produk;
                    }
                    if (empty($bulan_bayar_dari) && empty($bulan_bayar_sampe)) {
                        $this->session->set_flashdata("cart_msg", "<p class='alert alert-danger'>Untuk product seperti " . implode(',', $produk_yang_bayarnya_bulanan) . " wajib mengisi bulan bayar</p>");
                        redirect('transaksi/add');
                    }
                    if (!empty($bulan_bayar_sampe) && $bulan_bayar_sampe < $bulan_bayar_dari) {
                        $this->session->set_flashdata("cart_msg", "<p class='alert alert-danger'>Silahkan masukan bulan bayar yang benar</p>");
                        redirect('transaksi/add');
                    }
                    //bulan nya di dekode dulu
                    $bulan_indonesia = array(
                        1 => "Januari",
                        "Februari",
                        "Maret",
                        "April",
                        "Mei",
                        "Juni",
                        "Juli",
                        "Agustus",
                        "September",
                        "Oktober",
                        "November",
                        "Desember"
                    );

                    if (empty($bulan_bayar_sampe) or $bulan_bayar_dari == $bulan_bayar_sampe) {
                        $bulan_bayar = $bulan_indonesia[$bulan_bayar_dari];
                    } else {
                        $bulan_bayar = "{$bulan_indonesia[$bulan_bayar_dari]}-{$bulan_indonesia[$bulan_bayar_sampe]}";
                    }
                }

                $data = array(
                    'id'      => $product->kode_produk,
                    'qty'     => $qty,
                    'price'   => $harga,
                    'name'    => $product->nama_produk,
                    'options' => array()
                );
                if (!empty($bulan_bayar)) {
                    //jika bayar spp qtynya di seting jadi 1
                    $data['qty'] = 1;
                    $data = array_merge($data, ['bulan_bayar_str' => $bulan_bayar, 'bulan_bayar_int' => array($bulan_bayar_dari, $bulan_bayar_sampe)]);
                }
                if ($this->cart->insert($data)) {
                    $this->session->set_flashdata("cart_msg", "<p class='alert alert-success'>Product berhasil di tambahkan ke cart!</p>");
                    redirect("transaksi/add");
                } else {
                    $this->session->set_flashdata("cart_msg", "<p class='alert alert-danger'>Product gagal di tambahkan ke cart!</p>");
                }
            } else {
                $this->session->set_flashdata("cart_msg", "<p class='alert alert-danger'>Produk yang di tambahkan sepertinya tidak ada</p>");
                redirect('transaksi/add');
            }
        }
    }
    //fungsi untuk mencetak struk 
    public function _print_struk($data)
    {
        //mendapatkan pengaturan website
        $this->load->model("CommonModel");
        $setting = $this->CommonModel->getSetting();
        $siswa = $data['data_trx']['siswa'];
        $waktu = $data['data_trx']['waktu'];
        $kasir = $data['data_trx']['kasir'];
        $id = $data['data_trx']['id_transaksi'];
        $subtotal = $data['data_trx']['subtotal'];
        $cash = $data['data_trx']['cash'];
        $kurang = 0;
        if (!empty($data['data_trx']['kurang_bayar'])) {
            $kurang = $data['data_trx']['kurang_bayar'];
        }
        ##########################################
        $content = "<div style='font-family:monospace;width:500px;padding:10px;text-transform:capitalize;' class='struk'>";
        $content .= "<h1>{$setting->nama_intansi}</h1>";
        $content .= "<img width='60' height='60' src='".base_url()."/assets/img/"."{$setting->logo}'><br><br>";
        $content .= "<small>{$setting->alamat}</small>";
        $content .= "<br>";
        $content .= "<small>tel: {$setting->no_hp}</small>";
        $content .= "<br>";
        $content .= "<small>E-mail: {$setting->email}</small>";
        $content .= "<hr style='border:1px dashed;'>";
        $content .= "<b style='font-size:13px;'>#$id | $waktu </b>";
        $content .= "<br>";
        $content .= "<b>Kasir: $kasir </b>";
        $content .= "<br>";
        $content .= "<b>Siswa: $siswa </b>";
        $content .= "<br>";
        $content .= "<hr style='border:1px dashed;'>";
        $content .= "<table style='width:100%;text-align:left;'>";
        $content .= "<thead>";
        $content .= "<tr>";
        $content .= "<th>Items</th>";
        $content .= "<th>jmlh</th>";
        $content .= "<th>bulan_bayar</th>";
        $content .= "<th>total</th>";
        $content .= "</tr>";
        $content .= "</thead>";
        $content .= "<tbody>";
        unset($data['data_trx']);
        foreach ($data as $value) {
            $content .= "<tr>";
            $content .= "<td>" . $this->ProductModel->findProductByKode($value['kode_produk'])->nama_produk . "</td>";
            $content .= "<td>$value[qty]</td>";
            $content .= "<td>$value[bulan_bayar]</td>";
            $content .= "<td>Rp " . number_format($value['jumlah_bayar'], 0, '', '.') . "</td>";
            $content .= "</tr>";
        }
        $content .= "</tbody>";
        $content .= "</table>";
        $content .= "</br>";
        $content .= "<hr style='border:1px dashed;'>";
        $content .= "<b>subtotal: Rp." . number_format($subtotal, 0, '', '.') . " </b>";
        $content .= "<hr style='border:1px dashed;'>";
        if (!empty($cash)) {
            $content .= "<hr style='border:1px dashed;'>";
            $content .= "<b>Cash: Rp." . number_format($cash, 0, '', '.') . " </b>";
            $content .= "</br>";
            $cash_ahir = $cash - $subtotal;
            if ($cash < $subtotal) {
                $content .= "<b>Tunggakan: Rp." . number_format(abs($cash_ahir), 0, '', '.') . " </b>";
            } else {
                $content .= "<b>Kembali: Rp." . number_format(abs($cash_ahir), 0, '', '.') . " </b>";
            }
        }
        $content .= "</div>";
        return $content;
    }

    public function payment()
    {
        if ($this->input->is_ajax_request()) {
            $nisn = $this->input->post("siswa");
            $tanggal = $this->input->post("tanggal");
            $kasir = $this->input->post("kasir");
            $cart_data = $this->cart->contents();
            $cash = $this->input->post("cash");
            $data = array();
            //buat kode transaksi
            $id_transaksi = "TRX-" . substr(strtoupper(bin2hex(random_bytes(32))), 0, 20);
            foreach ($cart_data as $cart) {
                $data[] = array(
                    "id_transaksi" => $id_transaksi,
                    "tanggal_transaksi" => $tanggal,
                    "qty" => $cart['qty'],
                    "nisn" => $nisn,
                    "bulan_bayar" => isset($cart['bulan_bayar_str']) ? $cart['bulan_bayar_str'] : '-',
                    "kode_produk" => $cart['id'],
                    "jumlah_bayar" => $cart['subtotal'],
                    "total_bayar" => $cash,
                    "kurang_bayar" => abs($cash-(int) $this->cart->total())
                );
            }
            if ($this->_tambah_transaksi($data)) {
                $nama_siswa = $this->SiswaModel->findByNisn($nisn)->nama;
                $data['data_trx'] = array(
                    "kasir" => $kasir,
                    "siswa" => $nama_siswa . " ($nisn) ",
                    "id_transaksi" => $id_transaksi,
                    "waktu" => $tanggal,
                    "subtotal" => $this->cart->total(),
                    "cash" => $cash,

                );
                $this->output->set_content_type('application/json')->set_output(json_encode(array(
                    "success" => true,
                    "struk" => $this->_print_struk($data),
                )));;
                $this->cart->destroy();
            }
        }
    }
    public function lunasi($transId = null) {
        if ($this->input->is_ajax_request()) {
            $kode_transaksi = $transId;
            $cash = $this->input->post("cash");
            $total_bayar =$this->input->post("total_bayar");
            #assalammualaikum
            $cash_akhir = $cash-$total_bayar;
            $hutang = 0;
            $kembalian = 0;
            if ($cash < $total_bayar) {
                $hutang = abs($cash_akhir);
            } else {
                $kembalian = $cash_akhir;
            }
            if ($kembalian > 0) {
                $cash = $cash-$total_bayar;
            }
            $tanggal = date("d-m-Y");;
            $up = $this->db->query("UPDATE tbl_trans SET total_bayar=total_bayar+$cash,kurang_bayar='$hutang',tanggal_transaksi	='$tanggal' WHERE id_transaksi='$transId'");
            if ($up) {
                echo "Pembayaran berhasil";
                if ($kembalian > 0) {
                    echo "<br>Kembalian Rp. ".number_format($kembalian,2,',','.');
                }
            } else {
                echo 0;
            }

            exit;
        }
        if (is_null($transId)) {
            redirect("transaksi");
        }
        $kode_transaksi = $transId;
        //get data by kode transaksi
        $data = $this->TransaksiModel->fetchByKodeTransaksi($kode_transaksi);
       if (empty($data)){
           redirect("transaksi");
       }
        $this->load->view("partials/head", [
            'title' => "Lunasi | $transId",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/lunasi", ['DataTransaksi' => $data]);
        $this->load->view("partials/footer");


    }
    public function _tambah_transaksi($data)
    {
        return $this->TransaksiModel->insertTransaksi($data);
    }
}
