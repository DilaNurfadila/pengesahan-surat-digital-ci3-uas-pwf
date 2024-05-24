<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<head>
    <title>Document</title>
</head>
<body>
    <hr>
    <?php
    $id_surat = '';
    $id_user = '';
    $jenis_surat = '';
    $judul_surat = '';
    $file_surat = '';
    $tanggal_surat = '';
    $nomor_agenda = '';
    $tanggal_agenda = '';
    $tujuan_surat = '';
    $perihal_surat = '';
    $permintaan = '';

    if (isset($surat)) {
        $id_surat = $surat->id_surat;
        $id_user = $surat->id_user;
        $jenis_surat = $surat->jenis_surat;
        $judul_surat = $surat->judul_surat;
        $file_surat = $surat->file_surat;
        $tanggal_surat = $surat->tanggal_surat;
        $nomor_agenda = $surat->nomor_agenda;
        $tanggal_agenda = $surat->tanggal_agenda;
        $tujuan_surat = $surat->tujuan_surat;
        $perihal_surat = $surat->perihal_surat;
        $permintaan = $surat->permintaan;
    }
    ?>
    <div style="color: red;"><?= validation_errors() ?></div>
    <div class="form-container">
        <form action="" method="post">
            <table>
                <tr>
                    <td>id_user</td>
                    <td><input type="text" name="id_user"></td>
                </tr>
                <!-- <tr>
                    <td>id_user</td>
                    <td>
                        <select name="id_user" required>
                            <option value="">Pilih Pengirim</option>
                            <?php foreach ($users as $user) { ?>
                                <option value="<?= $user->id_user ?>" <?= set_select('id_user', $user->id_user, $id_user == $user->id_user) ?>><?= $user->nama_lengkap?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr> -->
                <tr>
                    <td>Jenis Surat</td>
                    <td><input type="text" name="jenis_surat" value="<?= set_value('jenis_surat', $jenis_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Judul Surat</td>
                    <td><input type="text" name="judul_surat" value="<?= set_value('judul_surat', $judul_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>File Surat</td>
                    <td><input type="file" name="file_surat" value="<?= set_value('file_surat', $file_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Tanggal Surat</td>
                    <td><input type="datetime-local" name="tanggal_surat" value="<?= set_value('tanggal_surat', $tanggal_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Nomor Agenda</td>
                    <td><input type="text" name="nomor_agenda" value="<?= set_value('nomor_agenda', $nomor_agenda) ?>" required></td>
                </tr>
                <tr>
                    <td>Tanggal Agenda</td>
                    <td><input type="datetime-local" name="tanggal_agenda" value="<?= set_value('tanggal_agenda', $tanggal_agenda) ?>" required></td>
                </tr>
                <tr>
                    <td>Tujuan Surat</td>
                    <td><input type="text" name="tujuan_surat" value="<?= set_value('tujuan_surat', $tujuan_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Perihal Surat</td>
                    <td><input type="text" name="perihal_surat" value="<?= set_value('perihal_surat', $perihal_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Permintaan</td>
                    <td><textarea name="permintaan"><?= set_value('permintaan', $permintaan) ?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="SAVE" name="submit">
                        <a href="<?= site_url('surat') ?>"><input type="button" value="CANCEL"></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <hr>
</body>