<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h1>Daftar Surat</h1>
    <?= $this->session->flashdata('msg') ?>
    <a href="<?= site_url('surat/add') ?>">Tambah Surat Baru</a>
    <hr>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Pengirim</th>
            <th>Jenis Surat</th>
            <th>Judul Surat</th>
            <th>File Surat</th>
            <th>Tanggal Surat</th>
            <th>Status Surat</th>
            <th>Nomor Agenda</th>
            <th>Tanggal Agenda</th>
            <th>Tujuan Surat</th>
            <th>Perihal Surat</th>
            <th>Permintaan</th>
            <th colspan="2">Action</th>
        </tr>
        <?php $i = 1; foreach ($surats as $surat) { ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $surat->id_user ?></td>
                <td><?= $surat->jenis_surat ?></td>
                <td><?= $surat->judul_surat ?></td>
                <td><?= $surat->file_surat ?></td>
                <td><?= $surat->tanggal_surat ?></td>
                <td><?= $surat->status_surat?></td>
                <td><?= $surat->nomor_agenda ?></td>
                <td><?= $surat->tanggal_agenda ?></td>
                <td><?= $surat->tujuan_surat ?></td>
                <td><?= $surat->perihal_surat ?></td>
                <td><?= $surat->permintaan ?></td>
                <td><a href="<?= site_url('surat/edit/' . $surat->id_surat) ?>">EDIT</a></td>
                <td><a href="<?= site_url('surat/delete/' . $surat->id_surat) ?>" onclick="return confirm('Are you sure ?')">DELETE</a></td>
            </tr>
        <?php } ?>
    </table>
    <a href="<?= base_url() ?>">
        <h4>HOME</h4>
    </a>
</body>
</html>