<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_model extends CI_Model
{

	//fungsi untuk validasi data
	public function validation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_user', 'Id User' . 'required | numeric');
		$this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required');
		$this->form_validation->set_rules('Judul_surat', 'Judul Surat', 'required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat' . 'required | numeric');
		$this->form_validation->set_rules('file_surat', 'File Surat', 'required');
		$this->form_validation->set_rules('file_surat', 'File Surat', 'required');
		$this->form_validation->set_rules('price_031', 'Cat price' . 'required | numeric');

		if ($this->form_validation->run())
			return TRUE;
		else
			return FALSE;
	}

	// fungsi untuk menyimpan data cats di tabel cats
	public function create()
	{
		$data = array(
			'id_user' => $this->input->post('id_user'),
			'jenis_surat' => $this->input->post('jenis_surat'),
			'judul_surat' => $this->input->post('judul_surat'),
			'tanggal_surat' => $this->input->post('tanggal_surat'),
			'nomor_agenda' => $this->input->post('nomor_agenda'),
			'tanggal_agenda' => $this->input->post('tanggal_agenda'),
			'tujuan_surat' => $this->input->post('tujuan_surat'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'permintaan' => $this->input->post('permintaan')
		);
		$this->db->insert('surat', $data);
	}

	// fungsi untuk menampilkan semua data cats
	public function read($limit, $start)
	{
		// $this->db->where('sold_031', 0); //untuk sortir data yang akan ditampilkan jika belum sold
		$this->db->limit($limit, $start);
		$query = $this->db->get('surat');
		return $query->result();
	}

	// fungsi untuk menampilkan data cats sesuai id
	public function read_by($id)
	{
		$this->db->where('id_surat', $id);
		$query = $this->db->get('surat');
		return $query->row();
	}

	// fungsi untuk edit data cats sesuai id
	public function update($id)
	{
		$data = array(
			'id_user' => $this->input->post('id_user'),
			'jenis_surat' => $this->input->post('jenis_surat'),
			'judul_surat' => $this->input->post('judul_surat'),
			'tanggal_surat' => $this->input->post('tanggal_surat'),
			'nomor_agenda' => $this->input->post('nomor_agenda'),
			'tanggal_agenda' => $this->input->post('tanggal_agenda'),
			'tujuan_surat' => $this->input->post('tujuan_surat'),
			'perihal_surat' => $this->input->post('perihal_surat'),
			'permintaan' => $this->input->post('permintaan')
		);
		$this->db->where('id_surat', $id);
		$this->db->update('surat', $data);
	}

	// fungsi untuk delete data cats sesuai id
	public function delete($id)
	{
		$this->db->where('id_surat', $id);
		$this->db->delete('surat');
	}
	
}
