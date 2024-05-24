<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('username')) redirect('auth/login');
        // if ($this->session->userdata('usertype') != 'Manager') redirect('welcome');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['users'] = $this->Users_model->read();
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
        if ($this->input->post('submit')) {
            if ($this->Users_model->validation()) {
                $this->Users_model->update($id);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', '<p style ="color:green">User Successfully Updated !</p>');
                } else {
                    $this->session->set_flashdata('msg', '<p style ="color:red">User Update Failed !</p>');
                }
                redirect('users');
            }
        }

        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users_surat/user_form', $data);
    }

    public function delete($id)
    {
        $this->Users_model->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', '<p style ="color:green">User Successfully Deleted !</p>');
        } else {
            $this->session->set_flashdata('msg', '<p style ="color:red">User Delete Failed !</p>');
        }
        redirect('users');
    }

    public function resetpass($id)
    {
        $this->Users_model->resetpass($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', '<p style="color:green">Reset password successfully</p>');
        } else {
            $this->session->set_flashdata('msg', '<p style="color:red">Reset password failed</p>');
        }
        redirect('users');
    }
}
