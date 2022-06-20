<?php
defined('BASEPATH') or exit('No direct script access allowed');
//product
class Product extends CI_Controller
{
    private const POST = "POST";
    public $data = array();
    public function __construct()
    {
        parent::__construct();
        //jika belum login redirect ke halaman login
        if (!$this->session->userdata("user_id")) {
            $this->session->set_flashdata("login_error", "Kamu harus login dulu");
            redirect("login");
        }
        if ($this->session->userdata("akses") === 'kepsek') {
            redirect('dashboard');
        }
        $this->load->library("form_validation");
        $this->load->model("ProductModel");
    }
    public function index()
    {
        $this->data['productData'] = $this->ProductModel->getAllProduct();
        $this->load->view("partials/head", [
            'title' => "Product",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/product", $this->data);
        $this->load->view("partials/footer");
    }
    public function edit_product($kodeProduk = null)
    {
        if (is_null($kodeProduk)) {
            redirect("product");
        } else {
            $data_product = $this->ProductModel->findProductByKode($kodeProduk);
            if ($this->input->server("REQUEST_METHOD") === self::POST) {
                if (isset($_POST['edit'])) {
                    $product_name = $this->input->post("product_name");
                    $product_price = $this->input->post("product_price");
                    if ($product_name === $data_product->nama_produk && $product_price === $data_product->harga_produk) {
                        $this->session->set_flashdata("update_error", "Tidak ada data yang di ubah");
                        redirect('product/edit_product/' . $kodeProduk, 'refresh');
                        exit;
                    }
                    if ($this->ProductModel->update(['nama_produk' => $product_name, 'harga_produk' => $product_price], $kodeProduk)) {
                        $this->session->set_flashdata("update_success", "Data {$data_product->kode_produk} berhasil di update");
                        redirect("product");
                        exit;
                    }
                }
            }
            $this->load->view("partials/head", [
                'title' => "Edit produk",
                'bodyId' => "page-top"
            ]);
            $this->load->view("partials/sidebar");
            $this->load->view("pages/edit-product", ['data_product' => $data_product]);
            $this->load->view("partials/footer");
        }
    }
    public function add()
    {
        if ($this->input->server("REQUEST_METHOD") === self::POST) {
            if (isset($_POST['add_product'])) {
                $this->form_validation->set_rules("nama_produk", "Nama produk", "required|trim");
                $this->form_validation->set_rules("harga_produk", "Harga produk", "required|trim");
                if ($this->form_validation->run() !== FALSE) {
                    $kode_produk = "PRD-" . substr(rand(), 0, 4);
                    $data = array(
                        "kode_produk" => $kode_produk,
                        "nama_produk" => $this->input->post("nama_produk"),
                        "harga_produk" => $this->input->post("harga_produk"),
                    );
                    if ($this->ProductModel->insert($data)) {
                        $this->session->set_flashdata("suksess_tambah_data", "<p class='alert alert-success'>1 Data berhasil di tambahkan</p>");
                        redirect("product");
                        exit(0);
                    }
                } else {
                    $err =  $this->form_validation->error_string("<p class='alert alert-danger'>", '</p>');
                    $this->session->set_flashdata("error_tambah_data", $err);
                    redirect('product/add');
                    exit(0);
                }
            }
        }
        $this->load->view("partials/head", [
            'title' => "Add product",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/add-product");
        $this->load->view("partials/footer");
    }
    public function delete($productCode = null)
    {
        if (is_null($productCode)) {
            redirect("product");
        } else {
            if ($this->ProductModel->deleteByKodeProduct($productCode)) {
                echo "<script>alert('data berhasil di hapus!');window.location.href='" . base_url('product') . "'</script>";
            }
        }
    }
}
