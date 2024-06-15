<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <?php include 'template/head.php' ?>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        <div class="flex flex-col flex-1 w-full">

            <?php
            $tanggal_agenda_trimmed = substr($validation->tanggal_agenda, 0, 19);
            $formatted_tanggal_agenda = date('d-m-Y H:i:s', strtotime($tanggal_agenda_trimmed));
            ?>

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Informasi Pengesahan
                    </h2>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <?= $this->session->flashdata('msg') ?>
                            <table class="w-full whitespace-no-wrap">
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Nomor Agenda :</td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nomor_agenda ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tanggal Agenda :</td>

                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $formatted_tanggal_agenda ?></td>

                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Tujuan Surat :</td>

                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->tujuan_surat ?></td>

                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Perihal Surat :</td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->perihal_surat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Pengaju :</td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nama_pembuat ?></td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400 font-bold">Penandatangan :</td>
                                    </tr>
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nama_penandatangan ?></td>
                                    </tr>
                                </tbody>

                            </table>
                            <br>
                            <!-- <php if ($this->session->has_userdata('email')) { ?>
                                <php if ($validation->status_surat == "Disetujui") { ?>
                                    <a href="<= site_url('surat/approved') ?>"><button class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 ml-1">Back</button></a>
                                <php } else { ?>
                                    <a href="<= site_url('surat') ?>"><button class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900 ml-1">Back</button></a>
                                <php } ?>
                            <php } ?> -->
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>