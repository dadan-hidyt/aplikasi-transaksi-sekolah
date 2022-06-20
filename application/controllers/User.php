<?php
defined("BASEPATH") or die('no redirect');
class User extends CI_Controller
{
    private $data = array();
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("user_id")) {
            $this->session->set_flashdata("login_error", "Kamu harus login dulu");
            redirect("login");
        }
        if ($this->session->userdata("akses") !== 'admin') {
            redirect('dashboard');
        }
        $this->load->model("UserModel");
        $this->load->library("form_validation");
    }
    public function index()
    {
        $this->data['DataUser'] = $this->UserModel->fetchAll();
        $this->load->view("partials/head", [
            'title'=>"User",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/user", $this->data);
        $this->load->view("partials/footer");
    }
    public function post_user()
    {
        if ($this->input->server("REQUEST_METHOD") === "POST") {
            if (isset($_POST['submit'])) {
                $user = $this->input->post('username');
                $pass = $this->input->post('password');
                $akses = $this->input->post("accesspermission");
                $data = array(
                    "username" => $user,
                    "password" => password_hash($pass,PASSWORD_DEFAULT),
                    "akses" => $akses
                );
                if (!$this->UserModel->findUserByUsername($user)) {
                    if ($this->UserModel->insert($data)) {
                        $this->session->set_flashdata("message", "<p class='alert alert-success'>Data berhasil di tambahkan</p>");
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata("message", "<p class='alert alert-danger'>Username sudah digunakan</p>");
                    redirect('user/add');
                }

            }
        }
    }
    //fungsi untuk delete user berdasarkan id
    public function delete($id = null)
    {
        if (is_null($id)){
            redirect("user");
        }
        if($this->UserModel->deleteById($id)) {
            $this->session->set_flashdata("message", "<p class='alert alert-success'>Data berhasil di hapus</p>");
            redirect('user');
        } else {
            $this->session->set_flashdata("message", "<p class='alert alert-danger'>Data gagal di hapus</p>");
            redirect('user');
        }
    }
    public function add()
    {
        $this->load->view("partials/head", [
            'title'=>"Add User",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/add-user");
        $this->load->view("partials/footer");
    }
    public function update($userId = null)
    {
        if ($userId === null)
        {
            redirect("user");
        }
        $this->data['dataUser'] = $this->UserModel->findById($userId);
        if ($this->input->server("REQUEST_METHOD") === "POST") {
            if (isset($_POST['submit'])) {
                $username = $this->input->post("username");
                $password = $this->input->post("password");
                $akses = $this->input->post("accesspermission");
                if (empty($password)){
                    $password = $this->data['dataUser']->password;
                } else {
                    $password = password_hash($password,PASSWORD_DEFAULT);
                }
                $data = array(
                    "username" => $username,
                    "password" => $password,
                    "akses" => $akses
                );
               if ($this->UserModel->update($data, $userId)) {
                $this->session->set_flashdata("message", "<p class='alert alert-success'>Data berhasil di update</p>");
                redirect('user');
               } else {
                $this->session->set_flashdata("message", "<p class='alert alert-danger'>Data gagal di hapus</p>");
                redirect('user/update/'.$id);
               }
            }
        }
        if($this->data['dataUser'] === NULL) {
            redirect('user');
        }
        $this->load->view("partials/head", [
            'title'=>"update User",
            'bodyId' => "page-top"
        ]);
        $this->load->view("partials/sidebar");
        $this->load->view("pages/edit-user", $this->data);
        $this->load->view("partials/footer");
    }
    
}