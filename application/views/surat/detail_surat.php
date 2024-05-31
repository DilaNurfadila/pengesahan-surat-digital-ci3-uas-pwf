<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat</title>
</head>

<body>
    <?php include 'template/siderbar.php'; ?>

    <?php include 'template/navbar.php'; ?>

    <?php
    $tanggal_surat_trimmed = substr($validation->tanggal_surat, 0, 19);
    $formatted_tanggal_surat = date('d-m-Y H:i:s', strtotime($tanggal_surat_trimmed));

    $tanggal_agenda_trimmed = substr($validation->tanggal_agenda, 0, 19);
    $formatted_tanggal_agenda = date('d-m-Y H:i:s', strtotime($tanggal_agenda_trimmed));

    $formatted_tanggal_dibuat = date('d-m-Y H:i:s', strtotime($validation->tanggal_dibuat));

    if ($validation->tanggal_diperiksa == NULL) {
        $formatted_tanggal_diperiksa = "Belum diperiksa";
    } else {
        $formatted_tanggal_diperiksa = date('d-m-Y H:i:s', strtotime($validation->tanggal_diperiksa));
    }

    if ($validation->tanggal_ditandatangan == NULL) {
        $formatted_tanggal_ditandatangan = "Belum ditandatangan";
    } else {
        $formatted_tanggal_ditandatangan = date('d-m-Y H:i:s', strtotime($validation->tanggal_ditandatangan));
    }
    ?>

    <div style="color: red;"><?= validation_errors() ?></div>
    <!-- <div style="color: red"><?= $error; ?></div> -->
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <table border="1">
                <tr>
                    <td colspan="2" align="center"><strong>Tentang Surat</strong></td>
                </tr>
                <tr>
                    <td>Judul Surat</td>
                    <td><?= $validation->judul_surat ?></td>
                </tr>
                <tr>
                    <td>Jenis Surat</td>
                    <td><?= $validation->jenis_surat ?></td>
                </tr>
                <tr>
                    <td>Tanggal Surat</td>
                    <td><?= $formatted_tanggal_surat ?></td>
                </tr>
                <tr>
                    <td>Status Surat</td>
                    <td><?= $validation->status_surat ?></td>
                </tr>
                <tr>
                    <td>Nomor Agenda</td>
                    <td><?= $validation->nomor_agenda ?></td>
                </tr>
                <tr>
                    <td>Tanggal Agenda</td>
                    <td><?= $formatted_tanggal_agenda ?></td>
                </tr>
                <tr>
                    <td>Tujuan Surat</td>
                    <td><?= $validation->tujuan_surat ?></td>
                </tr>
                <tr>
                    <td>Perihal Surat</td>
                    <td><?= $validation->perihal_surat ?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><strong>Tentang Pengesahan</strong></td>
                </tr>
                <tr>
                    <td>Nama Pembuat</td>
                    <td><?= $validation->nama_pembuat ?></td>
                </tr>
                <tr>
                    <td>Nama Pemeriksa</td>
                    <td><?= $validation->nama_pemeriksa ?></td>
                </tr>
                <tr>
                    <td>Nama Penandatangan</td>
                    <td><?= $validation->nama_penandatangan ?></td>
                </tr>
                <tr>
                    <td>Tanggal Dibuat</td>
                    <td><?= $formatted_tanggal_dibuat ?></td>
                </tr>
                <tr>
                    <td>Tanggal Diperiksa</td>
                    <td><?= $formatted_tanggal_diperiksa ?></td>
                </tr>
                <tr>
                    <td>Tanggal Ditandatangan</td>
                    <td><?= $formatted_tanggal_ditandatangan ?></td>
                </tr>
            </table>
        </form>
        <br>
        <?php if ($this->session->has_userdata('email')) { ?>
            <?php if ($validation->status_surat == "Disetujui") { ?>
                <a href="<?= site_url('surat/approved') ?>"><input type="button" value="CANCEL"></a>
            <?php } else { ?>
                <a href="<?= site_url('surat') ?>"><input type="button" value="CANCEL"></a>
            <?php } ?>
        <?php } else { ?>
            <a href="<?= site_url('surat/approved') ?>"><input type="button" value="CANCEL"></a>
        <?php } ?>
    </div>
</body>

</html>