<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Legalitas Surat</title>
</head>

<body>
    <?php include 'template/siderbar.php'; ?>

    <?php include 'template/navbar.php'; ?>

    <?php if ($this->session->userdata('email')) {
        $user = $this->session->userdata('namalengkap');
    } else {
        $user = 'guest';
    } ?>

    <h1>Selamat datang <?= $user ?></h1>
    <h1>4</h1>
    <h5>Cara</h5>
    </div>
    <h3>untuk meminta surat di approve & di legalisir</h3>
    </div>
    <p>Ada 4 cara dan syarat untuk surat dan dokumen di legalisir dan di approv oleh pihak website.</p>
    <p>Login terlebih dahulu</p>
    <p>Upload dokumen dan di pastikan pdf</p>
    <p>Menunggu proses approvement</p>
    <p>Mengunduh dokumen</p>
    <a href="#">Read More</a>
    <div>
        <div>
            <h5>Clients</h5>
            <h2>1234</h2>
        </div>
        <p>Ada banyak data pegawai yang meminta legalisir surat.</p>
        <div>
            <h5>Dokumen Approvement</h5>
            <h2>500</h2>
        </div>
        <p>Data dokumen yang telah di legalisir dan disetujui.</p>
    </div>
</body>

</html>