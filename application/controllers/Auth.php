<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if ($this->input->post('login') && $this->validation('login')) {
            $login = $this->Auth_model->getuser($this->input->post('email'));
            if ($login != NULL) {
                if (password_verify($this->input->post('password'), $login->password)) {
                    $data = array(
                        'namalengkap' => $login->nama_lengkap,
                        'email' => $login->email,
                        'alamat' => $login->alamat,
                        'nohp' => $login->no_hp,
                        'posisi' => $login->posisi,
                        'role' => $login->user_role
                    );
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg1', '<p style ="color:green"> Login Successfull ! </p>');
                    }
                    $this->session->set_userdata($data);
                    redirect('welcome');
                }
            }
            $this->session->set_flashdata('msg', '<p style ="color:red"> Invalid username Or password ! </p>');
        }
        $this->load->view('auth/form_login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('welcome');
    }

    public function changepass()
    {
        if (!$this->session->userdata('email')) redirect('auth/login'); //filter LOGIN
        if ($this->input->post('change') && $this->validation('change')) {
            $change = $this->Auth_model->getuser($this->session->userdata('email'));
            if (password_verify($this->input->post('oldpassword'), $change->password_)) {
                if ($this->Auth_model->changepass())
                    $this->session->set_flashdata('msg', '<p style ="color:green"> Password Successfully Changed ! </p>');
                else
                    $this->session->set_flashdata('msg', '<p style ="color:red"> Change Password Failed ! </p>');
            } else {
                $this->session->set_flashdata('msg', '<p style ="color:red"> Wrong Old Password ! </p>');
            }
        }
        $this->load->view('auth/form_password_');
    }

    public function changephoto()
    {
        if(! $this->session->userdata('email')) redirect('auth/login'); //filter LOGIN
        $data['error'] = '';
        if($this->input->post('upload')){
            if($this->upload()){ //jika sukses upload
                $this->Auth_model->changephoto($this->upload->data('file_name')); //ubah data foto di database
                $this->session->set_userdata('photo', $this->upload->data('file_name')); //update data session
                $this->session->set_flashdata('msg', '<p style ="color:green"> Photo Successfully Changed ! </p>'); // pesan sukses
            } else $data['error'] = $this->upload->display_errors(); //jika gagal upload
        }
        $this->load->view('auth/form_photo_', $data);
    }

    public function upload()
    {
        $config['upload_path']      = './uploads/users/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;

        $this->load->library('upload', $config);
        return $this->upload->do_upload('photo');
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
