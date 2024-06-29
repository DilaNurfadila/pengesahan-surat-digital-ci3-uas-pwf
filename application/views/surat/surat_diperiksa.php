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
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Daftar Surat yang Sudah Diperiksa
                    </h2>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <?= $this->session->flashdata('msg') ?>
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"">
                                        <th class=" px-4 py-3">No</th>
                                        <th class="px-4 py-3">Judul Surat</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Permintaan</th>
                                        <!-- <th class="px-4 py-3" colspan="3">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php if (!is_null($surats) && !empty($surats)) {
                                        $i = 1;
                                        foreach ($surats as $surat) {
                                            $pembuat = $surat->nama_pembuat == $this->session->userdata("namalengkap");
                                            $pemeriksa = $surat->nama_pemeriksa == $this->session->userdata("namalengkap");
                                            $penandatangan = $surat->nama_penandatangan == $this->session->userdata("namalengkap");

                                            if ($pembuat || $pemeriksa) {
                                    ?>
                                                <tr class="text-gray-700 dark:text-gray-400">
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400 text-center"><?= $i++ ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $surat->judul_surat ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400 text-center"><?= $surat->status_surat ?></td>
                                                    <?php if ($pembuat) { ?>
                                                        <td class="px-4 py-3 text-sm dark:text-gray-400">Anda sebagai pembuat</td>
                                                    <?php } else if ($pemeriksa) { ?>
                                                        <td class="px-4 py-3 text-sm dark:text-gray-400">Anda sebagai pemeriksa</td>
                                                    <?php } else if ($penandatangan) { ?>
                                                        <td class="px-4 py-3 text-sm dark:text-gray-400">Anda sebagai penandatangan</td>
                                                    <?php } ?>
                                                </tr>
                                        <?php }
                                        } ?>
                                        <!-- <tr>
                                            <td colspan="7" class="text-center text-sm dark:text-gray-400 py-3">Tidak ada surat</td>
                                        </tr> -->
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-sm dark:text-gray-400 py-3">Tidak ada surat</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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