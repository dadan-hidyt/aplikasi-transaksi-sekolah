<?php
class Setting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
        $this->load->model("CommonModel");
        $setting = $this->CommonModel->getSetting();
		if ($this->input->post()) {
            $file = $_FILES['file-logo'];
            $extensi = pathinfo($file['name'], PATHINFO_EXTENSION);
            if ($file['error'] == UPLOAD_ERR_OK && in_array(strtolower($extensi), ['png','jpg','jpeg'])) {
                $file_name = "logo-".uniqid().".{$extensi}";
                move_uploaded_file($file['tmp_name'], "assets/img/{$file_name}");
            } else {
                if (empty($setting->logo)) {
                    $file_name = "default.png";
                } else {
                    $file_name = $setting->logo;
                }
            }
			$data = array(
				"nama_intansi" => $this->input->post('nama_intansi'),
				"email" => $this->input->post('email'),
				"no_hp" => $this->input->post('telpon'),
				"alamat" => $this->input->post('alamat'),
                "logo" => $file_name
			);
			if ($this->db->update('tbl_setting', $data)) {
				$this->session->set_flashdata('message', "<p class='alert alert-success'>Pengaturan telah di update</p>");
				//redirect('setting');
			}
		}

		$this->load->view("partials/head", [
			'title' => "Setting",
			'bodyId' => "page-top"
		]);
		$this->load->view("partials/sidebar");
		$this->load->view("pages/setting", ['setting'=>$setting]);
		$this->load->view("partials/footer");
	}
}