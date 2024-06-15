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
            ?>

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Surat ditolak
                    </h2>
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
                    </table>

                    <div class="px-4 py-3 my-6 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div style="color:red;"><?= validation_errors() ?></div>
                        <form action="" method="post">
                            <label class="block text-sm">
                                <span class="text-gray-700 font-bold dark:text-gray-400">Mengapa ditolak?</span>
                                <textarea class="block w-full mt-5 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" name="reject_comment" placeholder="Berikan komentar tentang surat" required></textarea>
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