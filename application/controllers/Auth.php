<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        $email = $this->input->post('email');
        $user = $this->Users_model->read_by_email($email);
        // var_dump($user);
        if ($this->input->post('login') && $this->validation('login')) {
            if ($user && $user->status == '1') {
                $login = $this->Auth_model->getuser($email);
                if ($login != NULL) {
                    if ($login && password_verify($this->input->post('password'), $login->password)) {
                        $data = array(
                            'iduser' => $login->id_user,
                            'namalengkap' => $login->nama_lengkap,
                            'email' => $login->email,
                            'alamat' => $login->alamat,
                            'nohp' => $login->no_hp,
                            'posisi' => $login->posisi,
                            'role' => $login->user_role
                        );
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('msg1', '<p style ="color:green"> Login berhasil! </p>');
                        }
                        $this->session->set_userdata($data);
                        redirect('welcome');
                    } else {
                        $this->session->set_flashdata('msg', '<p style ="color:red"> Email atau password salah! </p>');
                    }
                }
            } else {
                $this->session->set_flashdata('msg', '<p style ="color:red"> Pengguna sudah tidak aktif! </p>');
            }
        }
        $this->load->view('auth/form_login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('welcome');
    }

    public function validation($type)
    {

        if ($type == 'login') {
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
        } else {
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required');
        }

        if ($this->form_validation->run())
            return TRUE;
        else
            return FALSE;
    }
}
