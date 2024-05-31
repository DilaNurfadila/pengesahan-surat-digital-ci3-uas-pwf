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

    <div>
        <h2>
            Daftar Permintaan
        </h2>
        <input type="text" id="search" placeholder="Cari judul surat"><br><br>
        <div>
            <div>
                <?= $this->session->flashdata('msg') ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengirim</th>
                            <th>Judul Surat</th>
                            <th>Permintaan</th>
                            <th>Status</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!is_null($validations) && !empty($validations)) {
                            $i = 1;
                            foreach ($validations as $validation) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $validation->nama_lengkap ?></td>
                                    <td><?= $validation->judul_surat ?></td>
                                    <?php if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap') && $validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                        <td>Periksa dan tanda tangan</td>
                                    <?php } else if ($validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                        <td>Tanda tangan</td>
                                    <?php } else if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap')) { ?>
                                        <td>Periksa</td>
                                    <?php } ?>

                                    <?php if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap') && $validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                        <td><?= $validation->status_surat ?></td>
                                    <?php } else if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap')) { ?>
                                        <?php if ($validation->tanggal_diperiksa != NULL && $validation->status_surat == "Diproses") { ?>
                                            <td>Disetujui</td>
                                        <?php } else if ($validation->status_surat == "Ditolak") { ?>
                                            <td>Ditolak</td>
                                        <?php } else { ?>
                                            <td><?= $validation->status_surat ?></td>
                                        <?php } ?>
                                    <?php } else if ($validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                        <td><?= $validation->status_surat ?></td>
                                    <?php } ?>

                                    <?php if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap') && $validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                        <?php if ($validation->status_surat == "Ditolak" || $validation->status_surat == "Disetujui" || $validation->tanggal_diperiksa != NULL) { ?>
                                            <td colspan="3" align="center">Tidak ada aksi</td>
                                        <?php } else if ($validation->status_surat == "Menunggu" || $validation->status_surat == "Diproses") { ?>
                                            <td><a href="<?= site_url('pengesahan/check_signed_both/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" target="_blank">Lihat Surat</a></td>
                                            <td><a href="<?= site_url('pengesahan/approve_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">Setujui</a></td>
                                            <td><a href="<?= site_url('pengesahan/reject_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">Tolak</a></td>
                                        <?php } ?>
                                    <?php } else if ($validation->nama_pemeriksa == $this->session->userdata('namalengkap')) { ?>
                                        <?php if ($validation->status_surat == "Ditolak" || $validation->status_surat == "Disetujui" || $validation->tanggal_diperiksa != NULL) { ?>
                                            <td colspan="3" align="center">Tidak ada aksi</td>
                                        <?php } else if ($validation->status_surat == "Menunggu" || $validation->status_surat == "Diproses") { ?>
                                            <td><a href="<?= site_url('pengesahan/check/' . $validation->id_surat) ?>" target="_blank">Lihat Surat</a></td>
                                            <td><a href="<?= site_url('pengesahan/approve_check/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">Setujui</a></td>
                                            <td><a href="<?= site_url('pengesahan/reject_check/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">Tolak</a></td>
                                        <?php } ?>
                                    <?php } else if ($validation->nama_penandatangan == $this->session->userdata('namalengkap')) { ?>
                                        <?php if ($validation->tanggal_diperiksa == NULL) { ?>
                                            <td colspan="3" align="center">Belum diperiksa</td>
                                        <?php } else if ($validation->status_surat == "Ditolak" || $validation->status_surat == "Disetujui" || $validation->tanggal_ditandatangan != NULL) { ?>
                                            <td colspan="3" align="center">Tidak ada aksi</td>
                                        <?php } else if ($validation->status_surat == "Menunggu" || $validation->status_surat == "Diproses") { ?>
                                            <td><a href="<?= site_url('pengesahan/check_signed/' . $validation->id_surat) ?>" target="_blank">Lihat Surat</a></td>
                                            <td><a href="<?= site_url('pengesahan/approve_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">Setujui</a></td>
                                            <td><a href="<?= site_url('pengesahan/reject_signed/' . $validation->id_surat . '/' . $validation->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">Tolak</a></td>
                                        <?php } ?>
                                    <?php } ?>

                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" align="center">Tidak ada permintaan</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <script>
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();

            $("table tbody tr").each(function() {
                var name = $(this).find("td:nth-child(3)").text().toLowerCase();
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