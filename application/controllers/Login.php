<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    private const POST = "POST";
    private const ADMIN   = 1;
    private const PETUGAS = 2;
    private const KEPSEK  = 3;
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("user_id")) {
            redirect("dashboard");
        }
        //meload library form vaidation
        $this->load->library("form_validation");
        //load model user
        $this->load->model("UserModel");
    }
    public function index()
    {
        $data['title'] = "login";
        $this->load->view('pages/login', $data);
    }
    //untuk memperoses login
    public function post_login()
    {
        //fungsi untuk proses login
        if ($this->input->server("REQUEST_METHOD") === self::POST) {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $this->form_validation->set_rules('username', "Username", "required", array(
                "required" => "Username tidak boleh kosong"
            ));
            $this->form_validation->set_rules('password', "Password", "required", array(
                "required" => "password tidak boleh kosong"
            ));

            if ($this->form_validation->run() === FALSE) {
                $error = "";
                foreach ($this->form_validation->error_array() as $value) {
                    $error .= $value . "<br>";
                }
                $this->session->set_flashdata("login_error", $error);
                redirect("login");
            } else {
                $login_error = null;
                if ($data = $this->UserModel->findUserByUsername($username)) {
                    if (password_verify($password, $data->password)) {
                        $hak_akses = null;
                        if ($data->akses == self::ADMIN) {
                            $hak_akses = "admin";
                        } elseif ($data->akses == self::PETUGAS) {
                            $hak_akses = "petugas";
                        } elseif ($data->akses == self::KEPSEK) {
                            $hak_akses = "kepsek";
                        } else {
                            show_404();
                            exit(0);
                        }
                        $session = array(
                            "user_id" => $data->id,
                            "akses" => $hak_akses
                        );
                        $this->session->set_userdata($session);
                        $this->session->set_flashdata("welcome_message", "Selamat datang {$data->username} Kamu login sebagai {$hak_akses}");
                        redirect("dashboard");
                    } else {
                        $login_error = "Password yang kamu ketikan salah!";
                    }
                } else {
                    $login_error = "Username tidak di temukan!";
                }
                if (!empty($login_error)) {
                    $this->session->set_flashdata("login_error", $login_error);
                    redirect("login");
                }
            }
        } else {
            show_404();
        }
    }
}
