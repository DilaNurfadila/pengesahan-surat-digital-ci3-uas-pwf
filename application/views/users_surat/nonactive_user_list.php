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
                        Daftar Pengguna Tidak Aktif
                    </h2>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <?= $this->session->flashdata('msg') ?>
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" style="text-align: center;">
                                        <th class="px-4 py-3">No</th>
                                        <th class="px-4 py-3">Nama Lengkap</th>
                                        <th class="px-4 py-3">Email</th>
                                        <th class="px-4 py-3">Alamat</th>
                                        <th class="px-4 py-3">No HP</th>
                                        <th class="px-4 py-3">Foto</th>
                                        <th class="px-4 py-3">Posisi</th>
                                        <th class="px-4 py-3">Role</th>
                                        <th class="px-4 py-3" colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php if (!is_null($users) && !empty($users)) {
                                        $i = 1;
                                        foreach ($users as $user) {
                                            if ($user->id_user != $this->session->userdata('iduser')) { ?>
                                                <tr class="text-gray-700 dark:text-gray-400">
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400 text-center"><?= $i++ ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $user->nama_lengkap ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $user->email ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $user->alamat ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $user->no_hp ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400">
                                                        <p align="center"><img src="<?= base_url('/assets/users-img/' . $user->foto_profil) ?>" alt="Foto profil" width="50" height="50"></p>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $user->posisi ?></td>
                                                    <td class="px-4 py-3 text-sm dark:text-gray-400"><?= $user->user_role ?></td>
                                                    <?php if ($user->status == '0') { ?>
                                                        <td class="px-4 py-3 text-sm dark:text-gray-400 text-center"><a href="<?= site_url('users/active/' . $user->id_user) ?>" onclick="return confirm('Are you sure ?')">AKTIFKAN</a></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td colspan="10" align="center" class="px-4 py-3 text-sm dark:text-gray-400">Tidak ada pengguna</td>
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