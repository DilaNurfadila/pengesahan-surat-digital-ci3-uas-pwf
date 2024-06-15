<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <?php include 'template/head.php' ?>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php include 'template/sidebar.php'; ?>
        <div class="flex flex-col flex-1 w-full">
            <?php include 'template/navbar.php'; ?>
            <main class="h-full overflow-y-auto">
                <?php
                $id_surat = '';
                $id_user = '';
                $jenis_surat = '';
                $judul_surat = '';
                $file_surat = '';
                $tanggal_surat = '';
                $nomor_agenda = '';
                $tanggal_agenda = '';
                $tujuan_surat = '';
                $perihal_surat = '';
                $nama_pemeriksa = '';
                $nama_penandatangan = '';

                // var_dump($user);
                if (isset($surat)) {
                    $id_surat = $surat->id_surat;
                    $id_user = $surat->id_user;
                    $jenis_surat = $surat->jenis_surat;
                    $judul_surat = $surat->judul_surat;
                    $file_surat = $surat->file_surat;
                    $tanggal_surat = $surat->tanggal_surat;
                    $nomor_agenda = $surat->nomor_agenda;
                    $tanggal_agenda = $surat->tanggal_agenda;
                    $tujuan_surat = $surat->tujuan_surat;
                    $perihal_surat = $surat->perihal_surat;
                    $nama_pemeriksa = $surat->nama_pemeriksa;
                    $nama_penandatangan = $surat->nama_penandatangan;
                }

                if (!empty($tanggal_surat)) {
                    $tanggal_surat_trimmed = substr($tanggal_surat, 0, 19);
                    $formatted_tanggal_surat = date('Y-m-d\TH:i', strtotime($tanggal_surat_trimmed));
                } else {
                    $formatted_tanggal_surat = '';
                }

                if (!empty($tanggal_surat)) {
                    $tanggal_agenda_trimmed = substr($tanggal_agenda, 0, 19);
                    $formatted_tanggal_agenda = date('Y-m-d\TH:i', strtotime($tanggal_agenda_trimmed));
                } else {
                    $formatted_tanggal_agenda = '';
                }
                // var_dump($surat);
                // var_dump($user)
                // foreach ($user as $data1) {
                //     var_dump($data1->user_role);
                //     var_dump($data1->user_role != "Superadmin" && $data1->id_user != $this->session->userdata('iduser'));
                // }
                ?>
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Surat's Form
                    </h2>
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div style="color:red;"><?= validation_errors() ?></div>
                        <div style="color:red;"><?= $error ?></div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Judul Surat</span>
                                <input type="text" name="judul_surat" value="<?= set_value('judul_surat', $judul_surat) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Surat Proposal" autocomplete="off" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Jenis Surat</span>
                                <input type="text" name="jenis_surat" value="<?= set_value('jenis_surat', $jenis_surat) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Proposal" autocomplete="off" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tanggal Surat</span>
                                <input type="datetime-local" name="tanggal_surat" value="<?= set_value('tanggal_surat', $formatted_tanggal_surat) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tanggal Agenda</span>
                                <input type="datetime-local" name="tanggal_agenda" value="<?= set_value('tanggal_agenda', $formatted_tanggal_agenda) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Tujuan Surat</span>
                                <input type="text" name="tujuan_surat" value="<?= set_value('tujuan_surat', $tujuan_surat) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Pengajuan Proposal" autocomplete="off" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Perihal Surat</span>
                                <input type="text" name="perihal_surat" value="<?= set_value('perihal_surat', $perihal_surat) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Perihal Proposal" autocomplete="off" required />
                            </label><br>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Pemeriksa
                                </span>
                                <select name="nama_pemeriksa" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required>
                                    <option disabled selected>Pilih Pemeriksa</option>
                                    <?php foreach ($user as $data) { ?>
                                        <?php if ($data->user_role == "Penandatangan") { ?>
                                            <option value="<?= $data->nama_lengkap ?>" <?= set_select('nama_pemeriksa', $data->nama_lengkap, $nama_pemeriksa == $data->nama_lengkap) ?>><?= $data->nama_lengkap ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </label><br>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Penandatangan
                                </span>
                                <select name="nama_penandatangan" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" required>
                                    <option disabled selected>Pilih Penandatangan</option>
                                    <?php foreach ($user as $data) { ?>
                                        <?php if ($data->user_role == "Penandatangan") { ?>
                                            <option value="<?= $data->nama_lengkap ?>" <?= set_select('nama_penandatangan', $data->nama_lengkap, $nama_penandatangan == $data->nama_lengkap) ?>><?= $data->nama_lengkap ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">File Surat</span>
                                <input type="file" name="file_surat" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                <input type="hidden" name="file_surat" value="<?= $file_surat ?>" />
                            </label><br>
                            <label class="block mt-4 text-sm">
                                <div class="relative text-gray-500 focus-within:text-purple-600 flex items-center">
                                    <input type="submit" value="SAVE" name="submit" style="display:inline-block; cursor:pointer;" class="block w-full mt-1 mr-2 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input">
                                </div>
                            </label>
                        </form>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>