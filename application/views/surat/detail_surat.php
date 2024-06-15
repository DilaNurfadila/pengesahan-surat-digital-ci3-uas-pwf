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

            <?php
            $tanggal_surat_trimmed = substr($validation->tanggal_surat, 0, 19);
            $formatted_tanggal_surat = date('d-m-Y H:i:s', strtotime($tanggal_surat_trimmed));

            $tanggal_agenda_trimmed = substr($validation->tanggal_agenda, 0, 19);
            $formatted_tanggal_agenda = date('d-m-Y H:i:s', strtotime($tanggal_agenda_trimmed));

            $formatted_tanggal_dibuat = date('d-m-Y H:i:s', strtotime($validation->tanggal_dibuat));

            if ($validation->tanggal_diperiksa == NULL) {
                $formatted_tanggal_diperiksa = "Belum diperiksa";
            } else {
                $formatted_tanggal_diperiksa = date('d-m-Y H:i:s', strtotime($validation->tanggal_diperiksa));
            }

            if ($validation->tanggal_ditandatangan == NULL) {
                $formatted_tanggal_ditandatangan = "Belum ditandatangan";
            } else {
                $formatted_tanggal_ditandatangan = date('d-m-Y H:i:s', strtotime($validation->tanggal_ditandatangan));
            }
            ?>

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Informasi Surat
                    </h2>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <?= $this->session->flashdata('msg') ?>
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"">
                                        <td colspan=" 2" class="px-4 py-3 text-center"><strong>Tentang Surat</strong></td>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Judul Surat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->judul_surat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Jenis Surat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->jenis_surat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tanggal Surat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $formatted_tanggal_surat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Status Surat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->status_surat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Nomor Agenda</td>
                                        <?php if ($validation->nomor_agenda == NULL) { ?>
                                            <td class="px-4 py-3 text-sm dark:text-gray-400">Surat belum disetujui oleh penandatangan</td>
                                        <?php } else { ?>
                                            <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nomor_agenda ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tanggal Agenda</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $formatted_tanggal_agenda ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tujuan Surat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->tujuan_surat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400" style="border-bottom-width: 5px;">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Perihal Surat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->perihal_surat ?></td>
                                    </tr>
                                </tbody>

                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"">
                                        <td colspan=" 2" class="px-4 py-3 text-center"><strong>Tentang Pengesahan</strong></td>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Nama Pembuat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nama_pembuat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Nama Pemeriksa</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nama_pemeriksa ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Nama Penandatangan</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nama_penandatangan ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tanggal Dibuat</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $formatted_tanggal_dibuat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tanggal Diperiksa</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $formatted_tanggal_diperiksa ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tanggal Ditandatangan</td>
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $formatted_tanggal_ditandatangan ?></td>
                                    </tr>
                                </tbody>

                            </table>
                            <br>
                        </div>
                        <?php if ($this->session->has_userdata('email')) { ?>
                            <?php if ($validation->status_surat == "Disetujui") { ?>
                                <a href="<?= site_url('surat/approved') ?>"><button class="mt-5 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 ml-1">Back</button></a>
                            <?php } else if ($validation->status_surat == "Ditolak") { ?>
                                <a href="<?= site_url('surat/rejected') ?>"><button class="mt-5 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 ml-1">Back</button></a>
                            <?php } else if (($validation->nama_pemeriksa == $this->session->userdata('namalengkap') || $validation->nama_penandatangan == $this->session->userdata('namalengkap')) && ($validation->status_surat == 'Menunggu' || $validation->status_surat == 'Diproses')) { ?>
                                <a href="<?= site_url('pengesahan') ?>"><button class="mt-5 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 ml-1">Back</button></a>
                            <?php } else { ?>
                                <a href="<?= site_url('surat') ?>"><button class="mt-5 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 ml-1">Back</button></a>
                            <?php } ?>
                        <?php } else { ?>
                            <a href="<?= site_url('surat/approved') ?>"><button class="mt-5 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 ml-1">Back</button></a>
                        <?php } ?>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>