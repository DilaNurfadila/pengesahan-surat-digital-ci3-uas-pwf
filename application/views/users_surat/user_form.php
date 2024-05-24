<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

    <hr>
    <?php
    $namalengkap = '';
    $email = '';
    $password = '';
    $alamat = '';
    $nohp = '';
    $posisi = '';
    $role = '' ;
    if (isset($user)) {
        $namalengkap = $user->nama_lengkap;
        $email = $user->email;
        $password = $user->password;
        $alamat = $user->alamat;
        $nohp = $user->no_hp;
        $posisi = $user->posisi;
        $role = $user->user_role;
    }
    ?>
    <div style="color: red;"><?= validation_errors() ?></div>
    <div class="form-container">
    <form action="" method="post">
        <table>
            <tr>
                <td>Nama Lengkap</td>
                <td><input type="text" name="namalengkap" value="<?= set_value('nama_lengkap', $namalengkap) ?>" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?= set_value('email', $email)?>" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value="<?= set_value('password', $password) ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" ><?= $alamat ?></textarea></td>
            </tr>
            <tr>
                <td>No HP</td>
                <td><input type="text" name="nohp" value="<?= set_value('no_hp', $nohp)?>" required></td>
            </tr>
            <tr>
                <td>Posisi</td>
                <td>
                    <input type="text" name="posisi" value="<?= set_value('posisi', $posisi)?>" required>
                    <!-- <input type="radio" name="posisi" value="Mahasiswa" <?= set_radio('posisi', 'Mahasiswa', $posisi == 'Mahasiswa' ? TRUE : FALSE) ?> required> Mahasiswa
                    <input type="radio" name="posisi" value="Dosen" <?= set_radio('posisi', 'Dosen', $posisi == 'Dosen' ? TRUE : FALSE) ?> required> Dosen
                    <input type="radio" name="posisi" value="Pegawai" <?= set_radio('posisi', 'Pegawai', $posisi == 'Pegawai' ? TRUE : FALSE) ?> required> Pegawai -->
                </td>
            </tr>
            <tr>
                <td>Role</td>
                <td>
                    <input type="radio" name="role" value="Pekerja" <?= set_radio('user_role', 'Pekerja', $role == 'Pekerja' ? TRUE : FALSE) ?> required> Pekerja
                    <input type="radio" name="role" value="Admin" <?= set_radio('user_role', 'Admin', $role == 'Admin' ? TRUE : FALSE) ?> required> Admin
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="SAVE" name="submit">
                    <a href="<?= site_url('users') ?>"><input type="button" value="CANCEL"></a>
                </td>
            </tr>
        </table>
    </form>
    </div>
    <hr>
</body>

</html>