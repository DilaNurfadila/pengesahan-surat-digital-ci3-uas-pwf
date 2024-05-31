<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Legalitas Surat</title>
</head>

<body>
    <?php include 'template/siderbar.php'; ?>

    <?php include 'template/navbar.php'; ?>

    <h2>
        Daftar User
    </h2>
    <input type="text" id="search" placeholder="Cari nama pengguna"><br><br>
    <a href="<?= site_url('users/add') ?>">Tambah</a><br>
    <div>
        <div>
            <?= $this->session->flashdata('msg') ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Foto Profil</th>
                        <th>Posisi</th>
                        <th>Role</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!is_null($users) && !empty($users)) {
                        $i = 1;
                        foreach ($users as $user) {
                            if ($user->id_user != $this->session->userdata('iduser')) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $user->nama_lengkap ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->alamat ?></td>
                                    <td><?= $user->no_hp ?></td>
                                    <td>
                                        <p align="center"><img src="<?= base_url('/assets/users-img/' . $user->foto_profil) ?>" alt="Foto profil" width="50" height="50"></p>
                                        <!-- <p><a href="<= site_url('cats032/changephoto/' . $cat->id_032) ?>">Ubah Foto</a></p> -->
                                    </td>
                                    <td><?= $user->posisi ?></td>
                                    <td><?= $user->user_role ?></td>
                                    <?php if ($user->status == '1') { ?>
                                        <td><a href="<?= site_url('users/edit/' . $user->id_user) ?>">EDIT</a></td>
                                        <td><a href="<?= site_url('users/nonactive/' . $user->id_user) ?>" onclick="return confirm('Are you sure ?')">NONAKTIFKAN</a></td>
                                    <?php } else { ?>
                                        <td><a href="<?= site_url('users/active/' . $user->id_user) ?>" onclick="return confirm('Are you sure ?')">AKTIFKAN</a></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="10" align="center">Tidak ada pengguna</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <script>
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();

            $("table tbody tr").each(function() {
                var name = $(this).find("td:nth-child(2)").text().toLowerCase();
                if (name.indexOf(value) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    </script>
</body>

</html>