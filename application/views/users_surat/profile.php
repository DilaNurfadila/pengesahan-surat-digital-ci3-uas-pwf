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
            <main class="h-full pb-16 overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Profile
                    </h2>
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Informasi</th>
                                            <th class="px-4 py-3">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">Nama</td>
                                            <td class="px-4 py-3 text-sm">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                        <img class="object-cover w-full h-full rounded-full" src="<?= base_url('/assets/users-img/' . $user->foto_profil) ?>" alt="" loading="lazy" />
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold"><?= $user->nama_lengkap ?></p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                                            <?= $user->posisi ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">Email</td>
                                            <td class="px-4 py-3 text-sm"><?= $user->email ?></td>
                                        </tr>
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">Alamat</td>
                                            <td class="px-4 py-3 text-sm"><?= $user->alamat ?></td>
                                        </tr>
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">Nomor Telepon</td>
                                            <td class="px-4 py-3 text-sm"><?= $user->no_hp ?></td>
                                        </tr>
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">Role</td>
                                            <td class="px-4 py-3 text-sm"><?= $user->user_role ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>