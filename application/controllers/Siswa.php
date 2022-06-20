<?php
defined("BASEPATH") or exit("No accsess redirect");
class Siswa extends CI_Controller
{
    private $data = array();
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("user_id")) {
            $this->session->set_flashdata("login_error", "Kamu harus login dulu");
            redirect("login");
        }
        if ($this->session->userdata("akses") === 'kepsek') {
            redirect('dashboard');
        }
        $this->load->model("SiswaModel");
        $this->load->library("form_validation");
        $this->load->library("LibExcel");
    }
    //method untuk mengimport data dari excek
    public function importExcel()
    {
        if ($this->input->post()) {
            if ($_FILES['files']['error'] === UPLOAD_ERR_NO_FILE) {
                $this->session->set_flashdata("message","<p class='alert alert-warning'>Silahkan pilih file yang mau di upload</p>");
                redirect("siswa/importExcel");
            } else {
                $file = $_FILES['files']['tmp_name'];
                $extensi = pathinfo($_FILES['files']['name'],PATHINFO_EXTENSION);
                if (strtolower($extensi) == 'xlsx') {
                    if ($xlsx = Shuchkin\SimpleXLSX::parse($file)) {
                     $row = $xlsx->rows();
                     unset($row[0]);
                     $row =  array_values($row);
                     $data = array();
                     foreach ($row as $value) {
                        $data['nisn'] = $value[0];
                        $data['nama'] = $value[1];
                        $data['tahun_masuk'] = $value[2];
                        $flag = $this->SiswaModel->checkNisn($value[0]);
                        if ($flag) {
                            continue;
                        }
                        $this->SiswaModel->insert($data);                     
                    }
                    $this->session->set_flashdata("message","<p class='alert alert-success'>Data berhasil di exsport</p>");
                    redirect("siswa/importExcel");   
                }
            } else {
             $this->session->set_flashdata("message","<p class='alert alert-danger'>File harus ber extensi xlsx</p>");
             redirect("siswa/importExcel");
         }
     }
 } 
 $this->load->view("partials/head", [
    'title' => "Import excel",
    'bodyId' => "page-top"
]);
 $this->load->view("partials/sidebar");
 $this->load->view("pages/import-excel");
 $this->load->view("partials/footer");
}
public function index()
{
    $this->data['DataSiswa'] = $this->SiswaModel->fetchAll();
    $this->load->view("partials/head", [
        'title' => "Siswa",
        'bodyId' => "page-top"
    ]);
    $this->load->view("partials/sidebar");
    $this->load->view("pages/siswa", $this->data);
    $this->load->view("partials/footer");
}
    //method untuk menambah data
public function add()
{
    if ($this->input->server("REQUEST_METHOD") === "POST") {
        if (isset($_POST['add_data_siswa'])) {
            $this->form_validation->set_rules("nama_siswa", "Nama siswa", "trim|required");
            $this->form_validation->set_rules("nisn", "nisn", "trim|required");
            $this->form_validation->set_rules("tahun_masuk", "Tahun masuk", "trim|required");
            if ($this->form_validation->run() !== FALSE) {
                $data = array(
                    "nisn" => $this->input->post("nisn"),
                    "nama" => $this->input->post("nama_siswa"),
                    "tahun_masuk" => $this->input->post("tahun_masuk")
                );
                    //cek nisn dulu
                if (!$this->SiswaModel->checkNisn($data['nisn'])) {
                    if ($this->SiswaModel->insert($data)) {
                        $this->session->set_flashdata("suksess_tambah_data", "<p class='alert alert-success'>1 Data berhasil di tambahkan</p>");
                        redirect("siswa");
                    }
                } else {
                    $this->session->set_flashdata("error_tambah_data", "<p class='alert alert-warning'>Nisn sudah di gunakan siswa lain!</p>");
                    redirect("siswa/add");
                }
            } else {
                $err =  $this->form_validation->error_string("<p class='alert alert-danger'>", "</p>");
                $this->session->set_flashdata("error_tambah_data", $err);
                redirect("siswa/add");
            }
        }
    }
    $this->load->view("partials/head", [
        "title" => "Tambah siswa",
        "bodyId" => "page-top"
    ]);
    $this->load->view("partials/sidebar");
    $this->load->view("pages/add-siswa");
    $this->load->view("partials/footer");
}
    //method for update siswa berdasarkan id
public function edit_siswa($id = null)
{
    if (is_null($id)) {
        redirect("siswa");
        exit(0);
    }
    $this->data['DataSiswa'] = $this->SiswaModel->findById($id);
    if ($this->input->server("REQUEST_METHOD") === "POST") {
        if (isset($_POST['edit_siswa'])) {
            $nisn = $this->input->post("nisn");
            $nama = $this->input->post("nama");
            $tahun_masuk = $this->input->post("tahun_masuk");
            if (
                $nisn === $this->data['DataSiswa']->nisn
                && $nama === $this->data['DataSiswa']->nama
                && $tahun_masuk === $this->data['DataSiswa']->tahun_masuk
            ) {
                $this->session->set_flashdata("error_tambah_data", "<p class='alert alert-warning'>Tidak ada data yang di ubah!</p>");
                redirect('siswa/edit_siswa/' . $id);
            } else {
                $data = array(
                    "nama" => $nama,
                    "nisn" => $nisn,
                    "tahun_masuk" => $tahun_masuk
                );
                if ($nisn === $this->data['DataSiswa']->nisn or !$this->SiswaModel->checkNisn($data['nisn'])) {
                    if ($this->SiswaModel->update($data, $id)) {
                        $this->session->set_flashdata("suksess_tambah_data", "<p class='alert alert-success'>1 Data siswa berhasil di update</p>");
                        redirect("siswa");
                    }
                } else {
                    $this->session->set_flashdata("error_tambah_data", "<p class='alert alert-warning'>Nisn sudah di gunakan siswa lain!</p>");
                    redirect("siswa/edit_siswa/" . $id);
                }
            }
        }
    }
    $this->load->view("partials/head", [
        "title" => "Edit siswa",
        "bodyId" => "page-top"
    ]);
    $this->load->view("partials/sidebar");
    $this->load->view("pages/edit-siswa", $this->data);
    $this->load->view("partials/footer");
}
public function delete($id = null)
{
    if (is_null($id)) {
        redirect("siswa");
        exit(0);
    }
    if ($this->SiswaModel->deleteById($id)) {
        echo "<script>alert('data berhasil di hapus!');window.location.href='" . base_url('siswa') . "'</script>";
        exit(0);
    }
}
}
