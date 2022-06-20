<?php
class Dashboard extends CI_Controller
{
    private $data = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $data = array();
        //untuk mendapatkan jumlah product,siswa dan umlah transaksi
        $this->data['productCount'] = $this->CommonModel->countProducts();
        $this->data['countSiswa'] = $this->CommonModel->countSiswa();
        $this->data['countTransaction'] = $this->CommonModel->countTransaction();
        $this->data['totalUangTransaksi'] = $this->CommonModel->totalUangTransaksi();
        if (!$this->session->userdata("user_id")) {
            $this->session->set_flashdata("login_error", "Kamu harus login dulu");
            redirect("login");
        }
    }
    //halaman utama dashboard
    public function index()
    {
        $this->load->view("partials/head", [
            'title' => "dashboard",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/dashboard", $this->data);
        $this->load->view("partials/footer");
    }
    //method untuk logout
    public function logout()
    {
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("akses");
        redirect('login');
    }
}
