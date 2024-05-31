<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'template/siderbar.php'; ?>

    <?php include 'template/navbar.php'; ?>

    <div style="color: red;"><?= validation_errors() ?></div>
    <!-- <div style="color: red"><?= $error; ?></div> -->
    <div class="form-container">
        <table border="1">
            <tr>
                <td>Foto Profil</td>
                <td>
                    <p align="center"><img src=" <?= base_url('/assets/users-img/' . $user->foto_profil) ?>" alt="Foto Profil" width="100" height="100"></p>
                </td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td><?= $user->nama_lengkap ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $user->email ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $user->alamat ?></td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td><?= $user->no_hp ?></td>
            </tr>
            <tr>
                <td>Posisi</td>
                <td><?= $user->posisi ?></td>
            </tr>
            <tr>
                <td>Role</td>
                <td><?= $user->user_role ?></td>
            </tr>
        </table>
        <br>
        <!-- <a href="<?= site_url('surat') ?>"><input type="button" value="CANCEL"></a> -->
    </div>
</body>

</html>