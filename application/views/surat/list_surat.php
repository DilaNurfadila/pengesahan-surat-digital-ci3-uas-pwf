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
                        Daftar Surat
                    </h2>
                    <?php if ($this->session->userdata("role") == "Pembuat") { ?>
                        <div>
                            <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='<?= site_url('surat/add') ?>'">
                                <span>Tambah</span>
                            </button>
                        </div><br>
                    <?php } ?>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <?= $this->session->flashdata('msg') ?>
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"">
                                        <th class=" px-4 py-3">No</th>
                                        <th class="px-4 py-3">Judul Surat</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3" colspan="4">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php if (!is_null($surats) && !empty($surats)) {
                                        $i = 1;
                                        foreach ($surats as $surat) {
                                            if ($this->session->userdata('email') == $surat->email) {
                                    ?>
                                                <tr class="text-gray-700 dark:text-gray-400">
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400 text-center"><?= $i++ ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $surat->judul_surat ?></td>

                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $surat->status_surat ?></td>
                                                    <?php if ($surat->status_surat == "Disetujui" && $surat->nomor_agenda == NULL) { ?>
                                                        <td colspan="3" class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/agenda_number/' . $surat->id_surat . '/' . $surat->id_legalisir) ?>">ISI NOMOR AGENDA</a></td>
                                                    <?php } else if ($surat->tanggal_diperiksa != NULL) { ?>
                                                        <td colspan="2" class="px-4 py-3 text-sm text-center dark:text-gray-400">Tidak bisa ubah dan hapus data setelah diperiksa</td>
                                                    <?php } else if ($surat->tanggal_diperiksa == NULL) { ?>
                                                        <?php if ($surat->nama_pembuat == $this->session->userdata("namalengkap")) { ?>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('surat/edit/' . $surat->id_surat . '/' . $surat->id_legalisir) ?>">EDIT</a></td>
                                                            <td class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('surat/delete/' . $surat->id_surat . '/' . $surat->id_legalisir) ?>" onclick="return confirm('Yakin ingin menghapus?')">DELETE</a></td>
                                                        <?php } ?>
                                                    <?php }  ?>
                                                    <td colspan="3" class="px-4 py-3 text-sm text-center dark:text-gray-400"><a href="<?= site_url('pengesahan/detail_surat/' . $surat->id_legalisir) ?>">DETAIL SURAT</a></td>
                                                </tr>
                                        <?php }
                                        } ?>
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