<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan</title>
</head>

<body>
    <?php include 'template/siderbar.php'; ?>

    <?php include 'template/navbar.php'; ?>

    <?php
    $namalengkap = '';
    $email = '';
    $password = '';
    $alamat = '';
    $nohp = '';
    $posisi = '';
    $foto = '';
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
    }
    ?>

    <h2>
        Pengaturan Akun
    </h2>
    <div>
        <div style="color: red;"><?= validation_errors() ?></div>
        <?= $this->session->flashdata('msg') ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td></td>
                    <td><input type="file" name="foto_profil" value="<?= set_value('foto_profil', $foto) ?>" /></td>
                    <input type="hidden" name="foto_profil" value="<?= $foto ?>" />
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="namalengkap" value="<?= set_value('nama_lengkap', $namalengkap) ?>" required placeholder="Nama Lengkap" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?= set_value('email', $email) ?>" required placeholder="Email" /></td>
                </tr>
                <tr>
                    <td>Nomor Hp</td>
                    <td><input type="text" name="nohp" value="<?= set_value('no_hp', $nohp) ?>" required placeholder="No HP" /></td>
                </tr>
                <tr>
                    <td>Posisi</td>
                    <td><input type="text" name="posisi" value="<?= set_value('posisi', $posisi) ?>" required placeholder="Posisi" /></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><textarea name="alamat" required><?= $alamat ?></textarea></td>
                </tr>
                <tr>
                    <td>Password Baru</td>
                    <td><input type="password" name="password_baru" placeholder="*********" /></td>
                </tr>
            </table>
            <input type="submit" value="SAVE" name="submit">
        </form>
    </div>
</body>

</html>