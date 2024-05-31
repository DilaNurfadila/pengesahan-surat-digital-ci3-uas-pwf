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
    $tanggal_agenda_trimmed = substr($validation->tanggal_agenda, 0, 19);
    $formatted_tanggal_agenda = date('d-m-Y H:i:s', strtotime($tanggal_agenda_trimmed));
    ?>
    <div style="color: red;"><?= validation_errors() ?></div>
    <!-- <div style="color: red"><?= $error; ?></div> -->
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <table border="1">
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
                    <td>Pengaju</td>
                    <td><?= $validation->nama_lengkap ?></td>
                </tr>
                <tr>
                    <td>Penanda Tangan</td>
                    <td><?= $validation->nama_penandatangan ?></td>
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