<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) redirect('auth/login');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('role') != 'Admin') redirect('welcome');
        $data['title'] = 'Daftar Pengguna';
        $data['users'] = $this->Users_model->read();
        $this->load->view('users_surat/user_list', $data);
    }

    public function detail_user($id)
    {
        $data['title'] = 'Profil Pengguna';
        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users_surat/profile', $data);
    }

    public function nonactive_users()
    {
        if ($this->session->userdata('role') != 'Admin') redirect('welcome');
        $data['title'] = 'Pengguna Tidak Aktif';
        $data['users'] = $this->Users_model->read_nonactive_users();
        $this->load->view('users_surat/nonactive_user_list', $data);
    }

    public function add()
    {
        if ($this->session->userdata('role') != 'Admin') redirect('welcome');
        if ($this->input->post('submit')) {
            if ($this->Users_model->validation()) {
                $this->Users_model->create();
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', '
                    <div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        Pengguna baru berhasil ditambahkan!
                    </div>
                    ');
                } else {
                    $this->session->set_flashdata('msg', '
                    <div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        Pengguna baru gagal ditambahkan!
                    </div>
                    ');
                }
                redirect('users');
            }
        }

        $data['title'] = 'Tambah Pengguna';
        $this->load->view('users_surat/user_form', $data);
    }

    public function edit($id)
    {
        if ($this->session->userdata('role') != 'Admin') redirect('welcome');
        $data['error'] = '';
        if ($this->input->post('submit')) {
            if ($this->Users_model->validation()) {
                $fileFoto = $this->Users_model->read_by($id);

                if (!empty($_FILES['foto_profil']['name'])) {
                    $newFotoProfil = $this->upload();
                    if (!$newFotoProfil) {
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('users/edit', $data);
                        return;
                    }
                } else {
                    $newFotoProfil = $fileFoto->foto_profil;
                }

                $this->Users_model->update($id, $newFotoProfil);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', '
                    <div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        Data berhasil diubah!
                    </div>
                    ');
                } else {
                    $this->session->set_flashdata('msg', '
                    <div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        Data gagal diubah!
                    </div>
                    ');
                }
                redirect('users');
            }
        }

        $data['title'] = 'Ubah Data Pengguna';
        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users_surat/user_form', $data);
    }

    public function setting($id)
    {
        if ($this->session->userdata('role') != 'Pembuat' && $this->session->userdata('role') != 'Pemeriksa_Penandatangan') redirect('welcome');
        $data['error'] = '';
        $data['title'] = 'Pengaturan Akun';
        // var_dump($this->generateRandomString());
        if ($this->input->post('submit')) {
            if ($this->Users_model->validation()) {
                $fileFoto = $this->Users_model->read_by($id);

                if (!empty($_FILES['foto_profil']['name'])) {
                    $newFotoProfil = $this->upload();
                    if (!$newFotoProfil) {
                        $data['error'] = $this->upload->display_errors();
                        $this->load->view('users_surat/settings', $data);
                        return;
                    }
                } else {
                    $newFotoProfil = $fileFoto->foto_profil;
                }

                $this->Users_model->setting($id, $newFotoProfil);
                $this->session->set_userdata('fotoProfil', $newFotoProfil);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', '
                    <div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        Data berhasil diubah!
                    </div>
                    ');
                } else {
                    $this->session->set_flashdata('msg', '
                    <div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        Data gagal diubah!
                    </div>
                    ');
                }
                redirect('users/setting/' . $this->session->userdata('iduser'));
            }
        }

        $data['user'] = $this->Users_model->read_by($id);
        $this->load->view('users_surat/settings', $data);
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function upload()
    {
        $config['upload_path']        = './assets/users-img/';
        $config['allowed_types']     = 'jpg|png';
        $config['max_size']         = '2000';
        $config['max_width']         = '2000';
        $config['max_height']         = '2000';

        $this->load->library('upload', $config);
        // return $this->upload->do_upload('foto_profil');

        if ($this->upload->do_upload('foto_profil')) {
            // Jika upload berhasil, ambil data file yang diunggah
            $upload_data = $this->upload->data();
            $fotoProfilName = $upload_data['file_name']; // Nama file yang diunggah

            // Rename nama file
            $extension = pathinfo($fotoProfilName, PATHINFO_EXTENSION);
            $baseName = pathinfo($fotoProfilName, PATHINFO_FILENAME);
            $newFotoProfilName = $baseName . "_" . $this->generateRandomString() . "." . $extension;

            // Path file sebelum rename
            $oldFilePath = $config['upload_path'] . $fotoProfilName;

            // Path file setelah rename
            $newFilePath = $config['upload_path'] . $newFotoProfilName;

            // Lakukan proses rename
            if (rename($oldFilePath, $newFilePath)) {
                // Jika rename berhasil, kembalikan nama file yang baru
                return $newFotoProfilName;
            } else {
                // Jika rename gagal, tampilkan pesan error atau lakukan penanganan kesalahan lainnya
                $this->upload->set_error('Failed to rename uploaded file.');
                return false;
            }
        } else {
            // Jika upload gagal, kembalikan false
            return false;
        }
    }

    public function nonactive($id)
    {
        if ($this->session->userdata('role') != 'Admin');
        $this->Users_model->nonactive($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', '
            <div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Pengguna berhasil dinonaktifkan!
            </div>
            ');
        } else {
            $this->session->set_flashdata('msg', '
            <div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                Pengguna gagal dinonaktifkan!
            </div>
            ');
        }
        redirect('users');
    }

    public function active($id)
    {
        if ($this->session->userdata('role') != 'Admin');
        $this->Users_model->active($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('msg', '
            <div id="alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                Pengguna berhasil diaktifkan!
            </div>
            ');
        } else {
            $this->session->set_flashdata('msg', '
            <div id="alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                Pengguna gagal diaktifkan!
            </div>
            ');
        }
        redirect('users/nonactive_users');
    }
}
