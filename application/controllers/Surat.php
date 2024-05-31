<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Surat_model');
		$this->load->model('Users_model');
		$this->load->model('Pengesahan_model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}

	public function index()
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		$config['base_url'] = site_url('surat/index');
		$config['total_rows'] = $this->db->count_all('surat');
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		$limit = $config['per_page'];
		$start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$data['i'] = $start + 1;
		$data['surats'] = $this->Surat_model->read($limit, $start);
		$this->load->view('surat/list_surat', $data);
	}

	public function approved()
	{
		$data['surats'] = $this->Surat_model->read_by_approved();
		$this->load->view('surat/list_surat', $data);
	}

	public function add()
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		$data['error'] = '';
		if ($this->input->post('submit')) {
			if ($this->Surat_model->validation()) {
				if ($this->upload()) {
					$fileData = $this->upload->data(); // Get file upload data
					$this->Surat_model->create($fileData);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<p style="color:green">Surat berhasil ditambah!</p>');
					} else {
						$this->session->set_flashdata('msg', '<p style="color:red">Surat gagal ditambah!</p>');
					}
					redirect('surat');
				} else {
					$data['error'] = $this->upload->display_errors();
				}
			}
		}
		$data['user'] = $this->Users_model->read();
		$this->load->view('surat/form_surat', $data);
	}

	public function edit($surat, $legalisir)
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		if ($this->input->post('submit')) {
			if ($this->Surat_model->validation()) {
				$file = $this->Surat_model->read_by($legalisir);
				// var_dump($file);
				if (!empty($_FILES['file_surat']['name'])) {
					if ($this->upload()) {
						$fileData = $this->upload->data(); // Get file upload data
						$fileSurat = $fileData['file_name'];
					} else {
						$data['error'] = $this->upload->display_errors();
						$this->load->view('surat/form_surat', $data);
						return;
					}
				} else {
					$fileSurat = $file->file_surat;
				}

				$this->Surat_model->update($surat, $legalisir, $fileSurat);
				var_dump($this->db->affected_rows());
				if ($this->db->affected_rows() == 0) {
					$this->session->set_flashdata('msg', '<p style ="color:green">Surat berhasil diubah</p>');
				} else {
					$this->session->set_flashdata('msg', '<p style ="color:red">Surat gagal diubah</p>');
				}
				redirect('surat');
			}
		}
		$data['user'] = $this->Users_model->read();
		$data['surat'] = $this->Surat_model->read_by($legalisir);
		$this->load->view('surat/form_surat', $data);
	}

	public function delete($surat, $pengesahan)
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		$this->Surat_model->delete($surat, $pengesahan);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<p style ="color:green">Surat berhasil dihapus</p>');
		} else {
			$this->session->set_flashdata('msg', '<p style ="color:red">Surat gagal dihapus</p>');
		}
		redirect('surat');
	}

	// 	public function changephoto($id)
	//     {
	//         if (!$this->session->userdata('username'))
	//             redirect('auth023/login'); //filter LOGIN

	//         // Load the cat data by id
	//         $data['cat'] = $this->Cats023_model->read_by($id);

	//         if ($this->input->post('upload')) {
	//             if ($this->upload()) { // Jika upload berhasil
	//                 $this->Cats023_model->changephoto($this->upload->data('file_name'), $id); // Ubah data foto di DB
	//                 $this->session->set_userdata('cat_photo', $this->upload->data('file_name')); // Perbarui data session dengan URL foto yang baru diunggah
	//                 $this->session->set_flashdata('msg', '<p style="color:lime">Photo successfully changed!</p>'); // Pesan sukses

	//                 redirect('cats023'); // Redirect ke halaman daftar kucing setelah berhasil mengunggah foto
	//             } else {
	//                 $data['error'] = $this->upload->display_errors(); // Jika upload gagal
	//             }
	//         }
	//         // Jika belum submit form, tampilkan halaman upload foto
	//         $this->load->view('cats023/cat_photo_023', $data);
	//     }

	public function upload()
	{
		$config['upload_path']		= './assets/pdf/';
		$config['allowed_types'] 	= 'pdf';
		$config['max_size']     	= '2000';
		$config['max_width'] 		= '1024';
		$config['max_height'] 		= '768';

		$this->load->library('upload', $config);
		return $this->upload->do_upload('file_surat');
	}
}
