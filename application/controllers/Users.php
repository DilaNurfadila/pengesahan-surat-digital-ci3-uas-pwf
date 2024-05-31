<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) redirect('auth/login');
        // if ($this->session->userdata('usertype') != 'Manager') redirect('welcome');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['users'] = $this->Users_model->read();
        $this->load->view('users_surat/user_list', $data);
    }

    public function detail_user($id)
    {
        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users_surat/profile', $data);
    }

    public function nonactive_users()
    {
        $data['users'] = $this->Users_model->read_nonactive_users();
        $this->load->view('users_surat/user_list', $data);
    }

    public function add()
    {

        if ($this->input->post('submit')) {
            if ($this->Users_model->validation()) {
                $this->Users_model->create();
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', '<p style ="color:green"> User Successfully Added ! </p>');
                } else {
                    $this->session->set_flashdata('msg', '<p style ="color:red"> User Failed Added ! </p>');
                }
                redirect('users');
            }
        }
        $this->load->view('users_surat/user_form');
    }

    public function edit($id)
    {
        // if (!$this->session->userdata('email')) redirect('auth/login');

        $data['error'] = '';
        if ($this->input->post('submit')) {
            if ($this->Users_model->validation()) {
                $fileFoto = $this->Users_model->read_by($id);

                if (!empty($_FILES['foto_profil']['name'])) {
                    if ($this->upload()) {
                        $fileData = $this->upload->data(); // Get file upload data
                        $fotoProfil = $fileData['file_name'];
                    } else {
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('users/edit', $data);
                        return;
                    }
                } else {
                    $fotoProfil = $fileFoto->foto_profil;
                }

                // var_dump($fotoProfil);
                $this->Users_model->setting($id, $fotoProfil);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', '<p style ="color:green">Data berhasil diubah!</p>');
                } else {
                    $this->session->set_flashdata('msg', '<p style ="color:red">Data gagal diubah!</p>');
                }
                redirect('users');
            }
        }

        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users_surat/user_form', $data);
    }

    public function setting($id)
    {
        // if (!$this->session->userdata('email')) redirect('auth/login');

        $data['error'] = '';
        if ($this->input->post('submit')) {
            if ($this->Users_model->validation()) {
                $fileFoto = $this->Users_model->read_by($id);

                if (!empty($_FILES['foto_profil']['name'])) {
                    if ($this->upload()) {
                        $fileData = $this->upload->data(); // Get file upload data
                        $fotoProfil = $fileData['file_name'];
                    } else {
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('users/setting', $data);
                        return;
                    }
                } else {
                    $fotoProfil = $fileFoto->foto_profil;
                }

                $this->Users_model->setting($id, $fotoProfil);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', '<p style ="color:green">Data berhasil diubah!</p>');
                } else {
                    $this->session->set_flashdata('msg', '<p style ="color:red">Data gagal diubah!</p>');
                }
                redirect('users/setting/' . $this->session->userdata('iduser'));
            }
        }

        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users_surat/settings', $data);
    }

    public function upload()
    {
        $config['upload_path']        = './assets/users-img/';
        $config['allowed_types']     = 'jpg|png';
        $config['max_size']         = '2000';
        $config['max_width']         = '1024';
        $config['max_height']         = '768';

        $this->load->library('upload', $config);
        return $this->upload->do_upload('foto_profil');
    }

    public function nonactive($id)
    {
        $this->Users_model->nonactive($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', '<p style ="color:green">Pengguna berhasil dinonaktifkan</p>');
        } else {
            $this->session->set_flashdata('msg', '<p style ="color:red">Pengguna gagal dinonaktifkan</p>');
        }
        redirect('users');
    }

    public function active($id)
    {
        $this->Users_model->active($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', '<p style ="color:green">Pengguna berhasil diaktifkan</p>');
        } else {
            $this->session->set_flashdata('msg', '<p style ="color:red">Pengguna gagal diaktifkan</p>');
        }
        redirect('users/nonactive_users');
    }
}
