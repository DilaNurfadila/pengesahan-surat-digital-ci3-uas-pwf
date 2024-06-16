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
		if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
		if (!$this->session->userdata('email')) redirect('auth/login');
		$config['base_url'] = site_url('surat/index');
		$config['total_rows'] = $this->db->count_all('surat');
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		$limit = $config['per_page'];
		$start = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$data['i'] = $start + 1;
		$data['title'] = 'Daftar Surat';
		$data['surats'] = $this->Surat_model->read($limit, $start);
		$this->load->view('surat/list_surat', $data);
	}

	public function approved()
	{
		$data['title'] = 'Daftar Surat yang Disetujui';
		$data['surats'] = $this->Surat_model->read_by_approved();
		$this->load->view('surat/surat_disetujui', $data);
	}

	public function checked()
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		$data['title'] = 'Daftar Surat yang Diperiksa';
		$data['surats'] = $this->Surat_model->read_by_checked();
		$this->load->view('surat/surat_diperiksa', $data);
	}

	public function rejected()
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		$data['title'] = 'Daftar Surat yang Ditolak';
		$data['surats'] = $this->Surat_model->read_by_rejected();
		$this->load->view('surat/surat_ditolak', $data);
	}

	public function add()
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
		$data['error'] = '';
		$data['title'] = 'Tambah surat';
		if ($this->input->post('submit')) {
			if ($this->Surat_model->validation()) {
				$pdfFile = $this->upload();
				if (!$pdfFile) {
					$data['error'] = $this->upload->display_errors();
					$this->session->set_flashdata('msg', '
					<div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">' .
						$data["error"] .
						'</div>
					');
					redirect('surat');
					return;
				}

				$this->Surat_model->create($pdfFile);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '
					<div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                		Surat berhasil ditambahkan!
            		</div>
					');
				} else {
					$this->session->set_flashdata('msg', '
					<div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                		Surat gagal ditambahkan!
            		</div>
					');
				}
				redirect('surat');
			}
		}

		$data['user'] = $this->Users_model->read();
		$this->load->view('surat/form_surat', $data);
	}

	public function edit($surat, $legalisir)
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
		$data['error'] = '';
		if ($this->input->post('submit')) {
			if ($this->Surat_model->validation()) {
				$file = $this->Surat_model->read_by($legalisir);
				if (!empty($_FILES['file_surat']['name'])) {
					$newPdfFile = $this->upload();
					if (!$newPdfFile) {
						$data['error'] = $this->upload->display_errors();
						$this->load->view('users_surat/settings', $data);
						return;
					}
				} else {
					$newPdfFile = $file->file_surat;
				}

				$this->Surat_model->update($surat, $legalisir, $newPdfFile);
				if ($this->db->affected_rows() == 0) {
					$this->session->set_flashdata('msg', '
					<div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                		Surat berhasil diubah!
            		</div>
					');
				} else {
					$this->session->set_flashdata('msg', '
					<div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                		Surat gagal diubah!
            		</div>
					');
				}
				if ($file->status_surat == "Ditolak") {
					redirect('surat/rejected');
				} else {
					redirect('surat');
				}
			}
		}

		$data['title'] = 'Ubah Data Surat';
		$data['user'] = $this->Users_model->read();
		$data['surat'] = $this->Surat_model->read_by($legalisir);
		$this->load->view('surat/form_surat', $data);
	}

	public function delete($surat, $pengesahan)
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
		$this->Surat_model->delete($surat, $pengesahan);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '
			<div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Surat berhasil dihapus!
            </div>
			');
		} else {
			$this->session->set_flashdata('msg', '
			<div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                Surat gagal dihapus!
            </div>
			');
		}
		redirect('surat');
	}

	public function resubmit($surat, $legalisir)
	{
		if (!$this->session->userdata('email')) redirect('auth/login');
		if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
		$this->Surat_model->resubmit($surat, $legalisir);
		$this->session->set_flashdata('msg', '
		<div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            Surat diajukan lagi!
        </div>
		');
		redirect('surat');
		$data['title'] = 'Ubah Data Surat';
	}

	private function generateRandomString($length = 10)
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function upload()
	{
		$config['upload_path']		= './assets/pdf/';
		$config['allowed_types'] 	= 'pdf';
		$config['max_size']     	= '2000';
		$config['max_width'] 		= '1024';
		$config['max_height'] 		= '768';

		$this->load->library('upload', $config);
		// return $this->upload->do_upload('file_surat');

		if ($this->upload->do_upload('file_surat')) {
			// Jika upload berhasil, ambil data file yang diunggah
			$upload_data = $this->upload->data();
			$pdfFileName = $upload_data['file_name']; // Nama file yang diunggah

			// Rename nama file
			$extension = pathinfo($pdfFileName, PATHINFO_EXTENSION);
			$baseName = pathinfo($pdfFileName, PATHINFO_FILENAME);
			$fixPdfFileName = $baseName . "_" . $this->generateRandomString() . "." . $extension;

			// Path file sebelum rename
			$oldFilePath = $config['upload_path'] . $pdfFileName;

			// Path file setelah rename
			$newFilePath = $config['upload_path'] . $fixPdfFileName;

			// Lakukan proses rename
			if (rename($oldFilePath, $newFilePath)) {
				// Jika rename berhasil, kembalikan nama file yang baru
				return $fixPdfFileName;
			} else {
				// Jika rename gagal, tampilkan pesan error atau lakukan penanganan kesalahan lainnya
				$this->upload->set_error('Failed to rename uploaded file.');
				return false;
			}
		} else {
			// Jika upload gagal, kembalikan false
			return false;
		}
	}
}
