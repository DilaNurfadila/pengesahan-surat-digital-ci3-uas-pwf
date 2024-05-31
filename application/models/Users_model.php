<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
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
        // $this->form_validation->set_rules('role', 'User Role', 'required');
        // $this->form_validation->set_rules('password_', 'Password', 'required');

        if ($this->form_validation->run())
            return TRUE;
        else
            return FALSE;
    }

    // fungsi untuk menyimpan data cats di tabel cats
    public function create()
    {
        $data = array(
            'nama_lengkap' => $this->input->post('namalengkap'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('nohp'),
            'posisi' => $this->input->post('posisi'),
            'user_role' => $this->input->post('role'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT,)
        );
        $this->db->insert('user', $data);
    }

    // fungsi untuk menampilkan semua data cats
    public function read()
    {
        $this->db->where('status', '1');
        $query = $this->db->get('user');
        return $query->result();
    }

    public function read_nonactive_users()
    {
        $this->db->where('status', '0');
        $query = $this->db->get('user');
        return $query->result();
    }

    // fungsi untuk menampilkan data cats sesuai id
    public function read_by($id)
    {
        $this->db->where('id_user', $id);
        $query = $this->db->get('user');
        return $query->row();
    }

    public function read_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        return $query->row();
    }

    // fungsi untuk edit data cats sesuai id
    public function update($id, $foto)
    {
        $this->db->where('id_user', $id);
        $query = $this->db->get('user');

        $new_password_input = $this->input->post('password_baru');
        if ($new_password_input == '') {
            $new_password = $query->row()->password;
        } else {
            $new_password = password_hash($new_password_input, PASSWORD_DEFAULT,);
        }

        if ($foto !== 'default.png') {
            unlink('./assets/users-img/' . $foto); // menghapus foto lama
        }

        $data = array(
            'nama_lengkap' => $this->input->post('namalengkap'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('nohp'),
            'foto_profil' => $foto,
            'posisi' => $this->input->post('posisi'),
            'user_role' => $this->input->post('role'),
            'password' => $new_password
            // 'password' => password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT,)
        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    // fungsi untuk delete data cats sesuai id
    public function nonactive($id)
    {
        $this->db->set('status', '0');
        $this->db->where('id_user', $id);
        $this->db->update('user');
    }

    public function active($id)
    {
        $this->db->set('status', '1');
        $this->db->where('id_user', $id);
        $this->db->update('user');
    }

    public function setting($id, $foto)
    {
        $this->db->where('id_user', $id);
        $query = $this->db->get('user');

        $new_password_input = $this->input->post('password_baru');
        if ($new_password_input == '') {
            $new_password = $query->row()->password;
        } else {
            $new_password = password_hash($new_password_input, PASSWORD_DEFAULT,);
        }

        if ($foto !== 'default.png') {
            unlink('./assets/users-img/' . $foto); // menghapus foto lama
        }

        $data = array(
            'nama_lengkap' => $this->input->post('namalengkap'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('nohp'),
            'foto_profil' => $foto,
            'posisi' => $this->input->post('posisi'),
            'password' => $new_password
        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    //fungsi untuk reset Password kembali ke default = usertype
    public function resetpass($id)
    {
        $this->db->where('id_user', $id);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            $user = $query->row();
            $new_password = password_hash($user->usertype_, PASSWORD_DEFAULT);

            $this->db->set('password', $new_password);
            $this->db->where('id_user', $id);
            $this->db->update('user');
        }
    }
}
