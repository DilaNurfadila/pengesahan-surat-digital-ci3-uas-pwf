<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengesahan_model extends CI_Model
{

    //fungsi untuk validasi data

    public function validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nohp', 'No HP', 'required');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required');
        $this->form_validation->set_rules('role', 'User Role', 'required');
        // $this->form_validation->set_rules('password_', 'Password', 'required');

        if ($this->form_validation->run())
            return TRUE;
        else
            return FALSE;
    }

    // fungsi untuk menyimpan data cats di tabel cats
    // public function create()
    // {
    //     $data = array(
    //         'nama_lengkap' => $this->input->post('namalengkap'),
    //         'email' => $this->input->post('email'),
    //         'alamat' => $this->input->post('alamat'),
    //         'no_hp' => $this->input->post('nohp'),
    //         'posisi' => $this->input->post('posisi'),
    //         'user_role' => $this->input->post('role'),
    //         'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT,)
    //     );
    //     $this->db->insert('user', $data);
    // }

    public function read_request($nama)
    {
        $this->db->group_start()
            ->where('nama_pemeriksa', $nama)
            ->or_where('nama_penandatangan', $nama)
            ->group_end();
        $this->db->join('surat', 'surat.id_surat = pengesahan.id_surat');
        $this->db->join('user', 'user.id_user = surat.id_user');
        $query = $this->db->get('pengesahan');
        return $query->result();
    }

    public function read_by($key)
    {
        $this->db->join('surat', 'pengesahan.id_surat = surat.id_surat');
        $this->db->join('user', 'surat.id_user = user.id_user');
        $this->db->where('kunci', $key);
        $query = $this->db->get('pengesahan');
        return $query->row();
    }

    public function read_by_id($id)
    {
        $this->db->join('surat', 'pengesahan.id_surat = surat.id_surat');
        $this->db->join('user', 'surat.id_user = user.id_user');
        $this->db->where('id_legalisir', $id);
        $query = $this->db->get('pengesahan');
        return $query->row();
    }

    public function check($id_surat)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data_surat = array(
            'status_surat' => 'Diproses'
        );

        $this->db->where('id_surat', $id_surat);
        $this->db->update('surat', $data_surat);

        $this->db->where('id_surat', $id_surat);
        $query = $this->db->get('surat');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $pdf_url = base_url('/assets/pdf/' . $row->file_surat);
            redirect($pdf_url);
        } else {
            // Handle the case where the file is not found
            $this->session->set_flashdata('msg', '<p style="color:red">File surat tidak ditemukan</p>');
            redirect('pengesahan');
        }
    }

    public function approve_check($id_pengesahan)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data_pengesahan = array(
            'tanggal_diperiksa' => date('Y-m-d H:i:s'),
            'tanggal_ditandatangan' => NULL
        );

        // $data_surat = array(
        //     'status_surat' => 'Diproses'
        // );

        $this->db->where('id_legalisir', $id_pengesahan);
        $this->db->update('pengesahan', $data_pengesahan);
        // $this->db->where('id_surat', $id_surat);
        // $this->db->update('surat', $data_surat);
    }

    public function reject_check($id_surat, $id_pengesahan)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data_pengesahan = array(
            'tanggal_diperiksa' => date('Y-m-d H:i:s'),
            'tanggal_ditandatangan' => NULL
        );

        $data_surat = array(
            'status_surat' => 'Ditolak'
        );

        $this->db->where('id_legalisir', $id_pengesahan);
        $this->db->update('pengesahan', $data_pengesahan);
        $this->db->where('id_surat', $id_surat);
        $this->db->update('surat', $data_surat);
    }

    public function check_signed($id_surat)
    {
        $this->db->where('id_surat', $id_surat);
        $query = $this->db->get('surat');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $pdf_url = base_url('/assets/pdf/' . $row->file_surat);
            redirect($pdf_url);
        } else {
            // Handle the case where the file is not found
            $this->session->set_flashdata('msg', '<p style="color:red">File surat tidak ditemukan</p>');
            redirect('pengesahan');
        }
    }

    public function approve_signed($id_surat, $id_pengesahan, $tanggal_diperiksa)
    {
        date_default_timezone_set('Asia/Jakarta');

        $length = 10;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $data_pengesahan = array(
            'tanggal_diperiksa' => $tanggal_diperiksa,
            'tanggal_ditandatangan' => date('Y-m-d H:i:s'),
            'kunci' => $randomString
        );

        $data_surat = array(
            'status_surat' => 'Disetujui'
        );

        $this->db->where('id_legalisir', $id_pengesahan);
        $this->db->update('pengesahan', $data_pengesahan);
        $this->db->where('id_surat', $id_surat);
        $this->db->update('surat', $data_surat);
    }

    public function reject_signed($id_surat)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data_surat = array(
            'status_surat' => 'Ditolak'
        );

        $this->db->where('id_surat', $id_surat);
        $this->db->update('surat', $data_surat);
    }

    public function check_signed_both($id_surat, $id_pengesahan)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data_pengesahan = array(
            'tanggal_diperiksa' => date('Y-m-d H:i:s'),
            'tanggal_ditandatangan' => NULL,
        );

        $data_surat = array(
            'status_surat' => 'Diproses'
        );

        $this->db->where('id_surat', $id_surat);
        $this->db->update('surat', $data_surat);
        $this->db->where('id_legalisir', $id_pengesahan);
        $this->db->update('pengesahan', $data_pengesahan);

        $this->db->where('id_surat', $id_surat);
        $query = $this->db->get('surat');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $pdf_url = base_url('/assets/pdf/' . $row->file_surat);
            redirect($pdf_url);
        } else {
            // Handle the case where the file is not found
            $this->session->set_flashdata('msg', '<p style="color:red">File surat tidak ditemukan</p>');
            redirect('pengesahan');
        }
    }

    // public function approve_check_signed($id_surat, $id_pengesahan, $tanggal_diperiksa)
    // {
    //     date_default_timezone_set('Asia/Jakarta');

    //     $length = 10;
    //     $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[random_int(0, $charactersLength - 1)];
    //     }

    //     $data_pengesahan = array(
    //         'tanggal_diperiksa' => date('Y-m-d H:i:s'),
    //         'tanggal_ditandatangan' => date('Y-m-d H:i:s'),
    //         'kunci' => $randomString
    //     );

    //     $data_surat = array(
    //         'status_surat' => 'Disetujui'
    //     );

    //     $this->db->where('id_legalisir', $id_pengesahan);
    //     $this->db->update('pengesahan', $data_pengesahan);
    //     $this->db->where('id_surat', $id_surat);
    //     $this->db->update('surat', $data_surat);
    // }

    // public function reject_check_signed($id_surat)
    // {
    //     date_default_timezone_set('Asia/Jakarta');

    //     $data_surat = array(
    //         'status_surat' => 'Ditolak'
    //     );

    //     $this->db->where('id_surat', $id_surat);
    //     $this->db->update('surat', $data_surat);
    // }

    public function delete($id_surat, $id_pengesahan)
    {
        $this->db->where('id_legalisir', $id_pengesahan);
        $this->db->delete('pengesahan');
        $this->db->where('id_surat', $id_surat);
        $this->db->delete('surat');
    }
}
