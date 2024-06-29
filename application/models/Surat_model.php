<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_model extends CI_Model
{
	//fungsi untuk validasi data
	public function validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required');
		$this->form_validation->set_rules('judul_surat', 'Judul Surat', 'required');
		$this->form_validation->set_rules('tanggal_surat', 'Tanggal Surat' . 'required | numeric');
		$this->form_validation->set_rules('nomor_agenda', 'Nomor Agenda' . 'required | numeric');
		$this->form_validation->set_rules('tanggal_agenda', 'Tanggal Agenda' . 'required | numeric');
		$this->form_validation->set_rules('tujuan_surat', 'Tujuan Surat', 'required');
		$this->form_validation->set_rules('perihal_surat', 'Perihal Surat', 'required');

		if ($this->form_validation->run())
			return TRUE;
		else
			return FALSE;
	}

	public function create($fileData)
	{
		$data_surat = array(
			'id_user' => $this->session->userdata('iduser'),
			'jenis_surat' => $this->input->post('jenis_surat'),
			'judul_surat' => $this->input->post('judul_surat'),
			'file_surat' => $fileData, // Store uploaded file name
			'tanggal_surat' => $this->input->post('tanggal_surat'),
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

	public function read($limit, $start)
	{
		$this->db->limit($limit, $start);
		$this->db->join('surat', 'surat.id_surat = pengesahan.id_surat');
		$this->db->join('user', 'user.id_user = surat.id_user');
		$this->db->group_by('pengesahan.id_legalisir');
		$this->db->where('status_surat !=', 'Ditolak');
		$this->db->where('nomor_agenda IS NULL');
		$query = $this->db->get('pengesahan');
		return $query->result();

		// var_dump($query->result());
		return $query->result();
	}

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
		// $this->db->where('nomor_agenda IS NOT NULL');
		$this->db->where('status_surat', 'Disetujui');
		$query = $this->db->get('pengesahan');
		return $query->result();
	}

	public function read_by_checked()
	{
		$this->db->join('surat', 'pengesahan.id_surat = surat.id_surat');
		$this->db->join('user', 'surat.id_user = user.id_user');
		$this->db->where('tanggal_diperiksa IS NOT NULL');
		$this->db->where('status_surat', 'Diproses');
		$query = $this->db->get('pengesahan');
		return $query->result();
	}

	public function read_by_rejected()
	{
		$this->db->join('surat', 'pengesahan.id_surat = surat.id_surat');
		$this->db->join('user', 'surat.id_user = user.id_user');
		$this->db->where('status_surat', 'Ditolak');
		$query = $this->db->get('pengesahan');
		return $query->result();
	}

	public function update($id_surat, $id_legalisir, $fileData)
	{
		$this->db->where('id_surat', $id_surat);
		$query = $this->db->get('surat');

		// var_dump($query->row()->file_surat);

		if ($fileData !== $query->row()->file_surat) {
			unlink('./assets/pdf/' . $query->row()->file_surat); // menghapus foto lama
		}

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

	public function resubmit($id_surat, $id_legalisir)
	{
		$data_surat = array(
			'status_surat' => "Menunggu",
		);

		$data_pengesahan = array(
			'tanggal_diperiksa' => NULL,
			'tanggal_ditandatangan' => NULL,
			'keterangan' => NULL,
		);
		$this->db->where('id_surat', $id_surat);
		$this->db->update('surat', $data_surat);
		$this->db->where('id_legalisir', $id_legalisir);
		$this->db->update('pengesahan', $data_pengesahan);
	}
}
