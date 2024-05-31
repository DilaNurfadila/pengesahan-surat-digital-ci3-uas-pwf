<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_model extends CI_Model
{

	//fungsi untuk validasi data
	public function validation()
	{
		$this->load->library('form_validation');

		// $this->form_validation->set_rules('id_user', 'Id User' . 'required | numeric');
		$this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required');
		$this->form_validation->set_rules('judul_surat', 'Judul Surat', 'required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat' . 'required | numeric');
		$this->form_validation->set_rules('nomor_agenda', 'Nomor Agenda' . 'required | numeric');
		$this->form_validation->set_rules('tanggal_agenda', 'Tanggal Agenda' . 'required | numeric');
		// $this->form_validation->set_rules('file_surat', 'File Surat', 'required');
		$this->form_validation->set_rules('tujuan_surat', 'Tujuan Surat', 'required');
		$this->form_validation->set_rules('perihal_surat', 'Perihal Surat', 'required');

		if ($this->form_validation->run())
			return TRUE;
		else
			return FALSE;
	}

	// fungsi untuk menyimpan data cats di tabel cats
	public function create($fileData)
	{
		$data_surat = array(
			'id_user' => $this->session->userdata('iduser'),
			'jenis_surat' => $this->input->post('jenis_surat'),
			'judul_surat' => $this->input->post('judul_surat'),
			'file_surat' => $fileData['file_name'], // Store uploaded file name
			'tanggal_surat' => $this->input->post('tanggal_surat'),
			'nomor_agenda' => $this->input->post('nomor_agenda'),
			'tanggal_agenda' => $this->input->post('tanggal_agenda'),
			'tujuan_surat' => $this->input->post('tujuan_surat'),
			'perihal_surat' => $this->input->post('perihal_surat'),
		);

		$this->db->insert('surat', $data_surat);

		$data_pengesahan = array(
			'id_surat' => $this->db->insert_id(),
			'nama_pembuat' => $this->session->userdata('namalengkap'),
			'nama_pemeriksa' => $this->input->post('nama_pemeriksa'),
			'nama_penandatangan' => $this->input->post('nama_penandatangan'),
		);

		$this->db->insert('pengesahan', $data_pengesahan);
	}

	// fungsi untuk menampilkan semua data cats
	public function read($limit, $start)
	{
		// $this->db->where('sold_031', 0); //untuk sortir data yang akan ditampilkan jika belum sold
		// $this->db->distinct();
		// $this->db->select('pengesahan.*, surat.judul_surat, surat.status_surat, surat.id_surat, user.nama_lengkap');
		$this->db->limit($limit, $start);
		$this->db->join('surat', 'surat.id_surat = pengesahan.id_surat');
		$this->db->join('user', 'user.id_user = surat.id_user');
		$this->db->group_by('pengesahan.id_legalisir');
		$this->db->where('status_surat !=', 'Disetujui');
		$query = $this->db->get('pengesahan');
		return $query->result();

		// var_dump($query->result());
		return $query->result();
	}

	// fungsi untuk menampilkan data cats sesuai id
	public function read_by($id)
	{
		$this->db->join('surat', 'pengesahan.id_surat = surat.id_surat');
		$this->db->join('user', 'surat.id_user = user.id_user');
		$this->db->where('id_legalisir', $id);
		$query = $this->db->get('pengesahan');
		return $query->row();
	}

	public function read_by_approved()
	{
		$this->db->join('surat', 'pengesahan.id_surat = surat.id_surat');
		$this->db->join('user', 'surat.id_user = user.id_user');
		$this->db->where('status_surat', 'Disetujui');
		$query = $this->db->get('pengesahan');
		return $query->result();
	}

	// fungsi untuk edit data cats sesuai id
	public function update($id_surat, $id_legalisir, $fileData)
	{
		$data_surat = array(
			'jenis_surat' => $this->input->post('jenis_surat'),
			'judul_surat' => $this->input->post('judul_surat'),
			'file_surat' => $fileData, // Store uploaded file name
			'tanggal_surat' => $this->input->post('tanggal_surat'),
			'nomor_agenda' => $this->input->post('nomor_agenda'),
			'tanggal_agenda' => $this->input->post('tanggal_agenda'),
			'tujuan_surat' => $this->input->post('tujuan_surat'),
			'perihal_surat' => $this->input->post('perihal_surat'),
		);

		$data_pengesahan = array(
			'nama_pemeriksa' => $this->input->post('nama_pemeriksa'),
			'nama_penandatangan' => $this->input->post('nama_penandatangan'),
		);
		$this->db->where('id_surat', $id_surat);
		$this->db->update('surat', $data_surat);
		$this->db->where('id_legalisir', $id_legalisir);
		$this->db->update('pengesahan', $data_pengesahan);
	}

	public function delete($id_surat, $id_pengesahan)
	{
		$this->db->where('id_surat', $id_surat);
		$query = $this->db->get('surat');

		$this->db->where('id_surat', $id_surat);
		$this->db->delete('surat');
		$this->db->where('id_legalisir', $id_pengesahan);
		$this->db->delete('pengesahan');
		unlink('./assets/pdf/' . $query->row()->file_surat);
	}
}
