<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengesahan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('usertype') != 'Manager') redirect('welcome');
        $this->load->model('Pengesahan_model');
        $this->load->library('form_validation');
        $this->load->library('Ciqrcode');
    }

    public function index()
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $nama = $this->session->userdata('namalengkap');
        $data['validations'] = $this->Pengesahan_model->read_request($nama);
        $this->load->view('pengesahan/pengesahan_list', $data);
    }

    public function surat_legalisir($kunci)
    {
        $kode = site_url('pengesahan/detail/' . $kunci);
        //render  qr code dengan format gambar PNG
        QRcode::png(
            $kode,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size  = 10,
            $margin = 2
        );
    }

    public function detail_qrcode($key)
    {
        $data['validation'] = $this->Pengesahan_model->read_by($key);
        $this->load->view('pengesahan/lihat_surat', $data);
    }

    public function detail_surat($id)
    {
        $data['validation'] = $this->Pengesahan_model->read_by_id($id);
        $this->load->view('surat/detail_surat', $data);
    }

    // public function add()
    // {

    //     if ($this->input->post('submit')) {
    //         if ($this->Users_model->validation()) {
    //             $this->Users_model->create();
    //             if ($this->db->affected_rows() > 0) {
    //                 $this->session->set_flashdata('msg', '<p style ="color:green"> User Successfully Added ! </p>');
    //             } else {
    //                 $this->session->set_flashdata('msg', '<p style ="color:red"> User Failed Added ! </p>');
    //             }
    //             redirect('users');
    //         }
    //     }
    //     $this->load->view('users_surat/user_form');
    // }

    public function check($surat)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->Pengesahan_model->check($surat);
    }

    public function approve_check($pengesahan)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->Pengesahan_model->approve_check($pengesahan);
        $this->session->set_flashdata('msg', '<p style ="color:green">Anda menyetujui suratnya</p>');
        redirect('pengesahan');

        // $data['validation'] = $this->Users_model->read_by($id);
    }

    public function reject_check($surat, $pengesahan)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->Pengesahan_model->reject_check($surat, $pengesahan);
        $this->session->set_flashdata('msg', '<p style ="color:red">Anda menolak suratnya</p>');
        redirect('pengesahan');
    }

    public function check_signed($surat)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->Pengesahan_model->check_signed($surat);
    }

    public function approve_signed($surat, $pengesahan)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $tanggal_diperiksa = $this->Pengesahan_model->read_by_id($pengesahan);

        var_dump($tanggal_diperiksa);
        $this->Pengesahan_model->approve_signed($surat, $pengesahan, $tanggal_diperiksa->tanggal_diperiksa);
        $this->session->set_flashdata('msg', '<p style ="color:green">Anda menyetujui suratnya</p>');
        redirect('pengesahan');

        // $data['validation'] = $this->Users_model->read_by($id);
    }

    public function reject_signed($surat, $pengesahan)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->Pengesahan_model->reject_signed($surat, $pengesahan);
        $this->session->set_flashdata('msg', '<p style ="color:red">Anda menolak suratnya</p>');
        redirect('pengesahan');
    }

    public function check_signed_both($surat, $pengesahan)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->Pengesahan_model->check_signed_both($surat, $pengesahan);
    }

    public function delete($id)
    {
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->Users_model->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', '<p style ="color:green">User Successfully Deleted !</p>');
        } else {
            $this->session->set_flashdata('msg', '<p style ="color:red">User Delete Failed !</p>');
        }
        redirect('users');
    }
}
