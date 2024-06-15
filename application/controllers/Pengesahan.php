<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengesahan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) redirect('auth/login');
        $this->load->model('Pengesahan_model');
        $this->load->library('form_validation');
        $this->load->library('Ciqrcode');
    }

    public function index()
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $nama = $this->session->userdata('namalengkap');
        $data['title'] = 'Daftar Permintaan';
        $data['validations'] = $this->Pengesahan_model->read_request($nama);
        $this->load->view('pengesahan/pengesahan_list', $data);
    }

    public function surat_legalisir($kunci)
    {
        $kode = site_url('pengesahan/detail_qrcode/' . $kunci);
        // $link = "<a href='$kode'>$kode</a>";
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
        // if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $data['validation'] = $this->Pengesahan_model->read_by($key);
        $data['title'] = 'Daftar Surat yang Disetujui';
        $this->load->view('pengesahan/lihat_surat', $data);
    }

    public function detail_surat($id)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $data['validation'] = $this->Pengesahan_model->read_by_id($id);
        $data['title'] = "Informasi Surat";
        $this->load->view('surat/detail_surat', $data);
    }

    public function check($surat)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $this->Pengesahan_model->check($surat);
    }

    public function approve_check($pengesahan)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $this->Pengesahan_model->approve_check($pengesahan);
        $this->session->set_flashdata('msg', '
        <div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            Anda menyetujui suratnya!
        </div>
        ');
        redirect('pengesahan');

        // $data['validation'] = $this->Users_model->read_by($id);
    }

    public function reject_check($surat, $pengesahan)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        if ($this->input->post('submit')) {
            $this->Pengesahan_model->reject_check($surat, $pengesahan);
            $this->session->set_flashdata('msg', '
            <div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                Anda menolak suratnya!
            </div>
            ');
            redirect('pengesahan');
        }
        $data['title'] = 'Surat ditolak';
        $data['validation'] = $this->Pengesahan_model->read_by_id($pengesahan);
        $this->load->view('pengesahan/reject_form', $data);
    }

    public function check_signed($surat)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $this->Pengesahan_model->check_signed($surat);
    }

    public function approve_signed($surat, $pengesahan)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $tanggal_diperiksa = $this->Pengesahan_model->read_by_id($pengesahan);
        if ($this->input->post('submit')) {
            $this->Pengesahan_model->approve_signed($surat, $pengesahan, $tanggal_diperiksa->tanggal_diperiksa);
            $this->session->set_flashdata('msg', '
            <div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Anda menyetujui suratnya!
            </div>
            ');
            redirect('pengesahan');
        }
        $data['title'] = 'Surat disetujui';
        $data['validation'] = $this->Pengesahan_model->read_by_id($pengesahan);
        $this->load->view('pengesahan/approve_form', $data);
    }

    public function reject_signed($surat, $pengesahan)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $tanggal_diperiksa = $this->Pengesahan_model->read_by_id($pengesahan);
        if ($this->input->post('submit')) {
            $this->Pengesahan_model->reject_signed($surat, $pengesahan, $tanggal_diperiksa->tanggal_diperiksa);
            $this->session->set_flashdata('msg', '
            <div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                Anda menolak suratnya!
            </div>
            ');
            redirect('pengesahan');
        }
        $data['title'] = 'Surat ditolak';
        $data['validation'] = $this->Pengesahan_model->read_by_id($pengesahan);
        $this->load->view('pengesahan/reject_form', $data);
    }

    public function check_signed_both($surat, $pengesahan)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Penandatangan') redirect('welcome');
        $this->Pengesahan_model->check_signed_both($surat, $pengesahan);
    }
}
