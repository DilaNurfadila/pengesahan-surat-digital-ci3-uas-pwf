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
    $nama_pemeriksa = '';
    $nama_penandatangan = '';

    // var_dump($user);
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
        $nama_pemeriksa = $surat->nama_pemeriksa;
        $nama_penandatangan = $surat->nama_penandatangan;
    }

    if (!empty($tanggal_surat)) {
        $tanggal_surat_trimmed = substr($tanggal_surat, 0, 19);
        $formatted_tanggal_surat = date('Y-m-d\TH:i', strtotime($tanggal_surat_trimmed));
    } else {
        $formatted_tanggal_surat = '';
    }

    if (!empty($tanggal_surat)) {
        $tanggal_agenda_trimmed = substr($tanggal_agenda, 0, 19);
        $formatted_tanggal_agenda = date('Y-m-d\TH:i', strtotime($tanggal_agenda_trimmed));
    } else {
        $formatted_tanggal_agenda = '';
    }

    // var_dump($surat);
    ?>
    <div style="color: red;"><?= validation_errors() ?></div>
    <!-- <div style="color: red"><= $error; ?></div> -->
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Judul Surat</td>
                    <td><input type="text" name="judul_surat" value="<?= set_value('judul_surat', $judul_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Jenis Surat</td>
                    <td><input type="text" name="jenis_surat" value="<?= set_value('jenis_surat', $jenis_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Tanggal Surat</td>
                    <td><input type="datetime-local" name="tanggal_surat" value="<?= set_value('tanggal_surat', $formatted_tanggal_surat) ?>" required></td>
                </tr>
                <tr>
                    <td>Nomor Agenda</td>
                    <td><input type="text" name="nomor_agenda" value="<?= set_value('nomor_agenda', $nomor_agenda) ?>" required></td>
                </tr>
                <tr>
                    <td>Tanggal Agenda</td>
                    <td><input type="datetime-local" name="tanggal_agenda" value="<?= set_value('tanggal_agenda', $formatted_tanggal_agenda) ?>" required></td>
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
                    <td>Pemeriksa</td>
                    <td>
                        <select name="nama_pemeriksa" required>
                            <option value="">Pilih Pemeriksa</option>
                            <?php foreach ($user as $data) { ?>
                                <?php if ($data->id_user != $this->session->userdata('iduser')) { ?>
                                    <option value="<?= $data->nama_lengkap ?>" <?= set_select('nama_pemeriksa', $data->nama_lengkap, $nama_pemeriksa == $data->nama_lengkap) ?>><?= $data->nama_lengkap ?></option>
                                    <!-- <option value="<= $data->nama_lengkap ?>" <= $nama_pemeriksa == $data->nama_lengkap ? 'selected' : '' ?>><= $data->nama_lengkap ?></option> -->
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Penandatangan</td>
                    <td>
                        <select name="nama_penandatangan" required>
                            <option value="">Pilih Penandatangan</option>
                            <?php foreach ($user as $data) { ?>
                                <?php if ($data->id_user != $this->session->userdata('iduser')) { ?>
                                    <option value="<?= $data->nama_lengkap ?>" <?= set_select('nama_penandatangan', $data->nama_lengkap, $nama_penandatangan == $data->nama_lengkap) ?>><?= $data->nama_lengkap ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>File Surat</td>
                    <td><input type="file" name="file_surat"></td>
                    <input type="hidden" value="<?= $file_surat ?>" name="file_surat">
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
</body>

</html>