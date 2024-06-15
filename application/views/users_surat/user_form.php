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
                $namalengkap = '';
                $email = '';
                $password = '';
                $alamat = '';
                $nohp = '';
                $posisi = '';
                $foto = '';
                $role = '';
                // var_dump($user);
                if (isset($user)) {
                    $id = $user->id_user;
                    $namalengkap = $user->nama_lengkap;
                    $email = $user->email;
                    $password = $user->password;
                    $alamat = $user->alamat;
                    $nohp = $user->no_hp;
                    $posisi = $user->posisi;
                    $foto = $user->foto_profil;
                    $role = $user->user_role;
                }

                $is_add_page = $this->uri->uri_string() == 'users/add';
                $password_label = $is_add_page ? 'Password' : 'Password Baru';
                $password_placeholder = $is_add_page ? '*******' : '*******';
                $password_name = $is_add_page ? 'password' : 'password_baru';
                $title_form = $is_add_page ? 'Tambah Pengguna' : 'Edit Pengguna';
                $required = $is_add_page ? 'required' : '';
                ?>
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        <?= $title_form ?>
                    </h2>
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <div style="color:red;"><?= validation_errors() ?></div>
                        <?php if (!$is_add_page) { ?>
                            <div style="color:red;"><?= $error ?></div>
                        <?php } ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php if (!$is_add_page) { ?>
                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Foto</span>
                                    <input type="file" name="foto_profil" value="<?= set_value('foto_profil', $foto) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" />
                                    <!-- <input type="hidden" name="foto_profil" value="<= $foto ?>" /> -->
                                </label><br>
                            <?php } ?>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Name</span>
                                <input type="text" name="namalengkap" value="<?= set_value('nama_lengkap', $namalengkap) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Lengkap" autocomplete="off" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input type="text" name="email" value="<?= set_value('email', $email) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="example@gmail.com" autocomplete="off" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Phone Number</span>
                                <input type="text" name="nohp" value="<?= set_value('no_hp', $nohp) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="081xxx" autocomplete="off" required />
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Posisi</span>
                                <input type="text" name="posisi" value="<?= set_value('posisi', $posisi) ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Contoh : Dosen" autocomplete="off" required />
                            </label><br>
                            <div class="mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Role
                                </span>
                                <div class="mt-2">
                                    <?php if ($this->session->userdata('role') == 'Superadmin') { ?>
                                        <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                            <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-check-input" name="role" id="admin" value="Admin" <?= set_radio('user_role', 'Admin', $role == 'Admin' ? TRUE : FALSE) ?> required />
                                            <span class="ml-2 form-check-label" for="admin">Admin</span>
                                        </label>
                                    <?php } ?>
                                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                        <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-check-input" name="role" id="pembuat" value="Pembuat" <?= set_radio('user_role', 'Pembuat', $role == 'Pembuat' ? TRUE : FALSE) ?> required />
                                        <span class="ml-2 form-check-label">Pembuat</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                        <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-check-input" name="role" id="penandatangan" value="Penandatangan" <?= set_radio('user_role', 'Penandatangan', $role == 'Penandatangan' ? TRUE : FALSE) ?> required />
                                        <span class="ml-2 form-check-label">Penandatangan</span>
                                    </label>
                                </div>
                            </div><br>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Alamat</span>
                                <textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" name="alamat" placeholder="Contoh : Bandung" required><?= $alamat ?></textarea>
                            </label><br>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400"><?= $password_label ?></span>
                                <input type="password" name="<?= $password_name ?>" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" <?= $required ?> placeholder="<?= $password_placeholder; ?>" />
                                <?php if (!$is_add_page) { ?>
                                    <input type="hidden" name="password" value="<?= $password ?>" />
                                <?php } ?>
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