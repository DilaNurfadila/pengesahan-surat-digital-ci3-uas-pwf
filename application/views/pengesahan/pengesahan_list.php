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
                        Daftar Permintaan
                    </h2>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full">
                            <?= $this->session->flashdata('msg') ?>
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800 text-center">
                                        <th class="px-4 py-3">No</th>
                                        <th class="px-4 py-3">Nama Pengirim</th>
                                        <th class="px-4 py-3">Judul Surat</th>
                                        <th class="px-4 py-3">Permintaan</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3" colspan="4">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php if (!is_null($validations) && !empty($validations)) {
                                        $i = 1;
                                        foreach ($validations as $validation) { ?>
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <?php if ($validation->status_surat != "Ditolak" && $validation->status_surat != "Disetujui") { ?>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400 text-center"><?= $i++ ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->nama_lengkap ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $validation->judul_surat ?></td>
                                                    <?php if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap') && $validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                                        <td class="px-4 py-3 text-sm dark:text-gray-400">Periksa dan tanda tangan</td>
                                                    <?php } else if ($validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                                        <td class="px-4 py-3 text-sm dark:text-gray-400">Tanda tangan</td>
                                                    <?php } else if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap')) { ?>
                                                        <td class="px-4 py-3 text-sm dark:text-gray-400">Periksa</td>
                                                    <?php } ?>
                                                    <?php if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap') && $validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                                        <td><?= $validation->status_surat ?></td>
                                                    <?php } else if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap')) { ?>
                                                        <?php if ($validation->tanggal_diperiksa != NULL && $validation->status_surat == "Diproses") { ?>
                                                            <td>Disetujui</td>
                                                        <?php } else if ($validation->status_surat == "Ditolak") { ?>
                                                            <td>Ditolak</td>
                                                        <?php } else { ?>
                                                            <td><?= $validation->status_surat ?></td>
                                                        <?php } ?>
                                                    <?php } else if ($validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                                        <td><?= $validation->status_surat ?></td>
                                                    <?php } ?>

                                                    <?php if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap') && $validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                                        <?php if ($validation->status_surat == "Menunggu" || $validation->status_surat == "Diproses") { ?>
                                                            <?php if ($validation->tanggal_diperiksa == NULL) { ?>
                                                                <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/check_signed_both/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" target="_blank">LIHAT SURAT</a></td>
                                                            <?php } else { ?>
                                                                <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/check_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" target="_blank">LIHAT SURAT</a></td>
                                                            <?php } ?>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/approve_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">SETUJUI</a></td>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/reject_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">TOLAK</a></td>
                                                        <?php } ?>
                                                    <?php } else if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap')) { ?>
                                                        <?php if ($validation->status_surat == "Ditolak" || $validation->status_surat == "Disetujui" || $validation->tanggal_diperiksa != NULL) { ?>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400" colspan="3" align="center">Tidak ada aksi</td>
                                                        <?php } else if ($validation->status_surat == "Menunggu" || $validation->status_surat == "Diproses") { ?>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/check/' . $validation->id_surat) ?>" target="_blank">LIHAT SURAT</a></td>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/approve_check/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">SETUJUI</a></td>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/reject_check/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">TOLAK</a></td>
                                                        <?php } ?>
                                                    <?php } else if ($validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                                        <?php if ($validation->tanggal_diperiksa == NULL) { ?>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400" colspan="3" align="center">Belum diperiksa</td>
                                                        <?php } else if ($validation->status_surat == "Menunggu" || $validation->status_surat == "Diproses") { ?>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/check_signed/' . $validation->id_surat) ?>" target="_blank">LIHAT SURAT</a></td>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/approve_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">SETUJUI</a></td>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/reject_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">TOLAK</a></td>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <td colspan="4" class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/detail_surat/' . $validation->id_legalisir) ?>">DETAIL SURAT</a></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="6" align="center">Tidak ada permintaan</td>
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