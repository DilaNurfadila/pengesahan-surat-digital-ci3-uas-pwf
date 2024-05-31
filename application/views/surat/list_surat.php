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
            Daftar Surat
        </h2>
        <input type="text" id="search" placeholder="Cari judul surat"><br><br>
        <?php if ($this->session->userdata("role") == "Pembuat" || $this->session->userdata("role") == "Admin") { ?>
            <a href="<?= site_url('surat/add') ?>">Tambah</a><br>
        <?php } ?>
        <div>
            <div>
                <?= $this->session->flashdata('msg') ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Surat</th>
                            <th>QR code</th>
                            <th>Status Surat</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!is_null($surats) && !empty($surats)) {
                            $i = 1;
                            // var_dump($surats->status_surat);
                            foreach ($surats as $surat) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $surat->judul_surat ?></td>

                                    <?php if ($surat->kunci == NULL && ($surat->status_surat == "Menunggu" || $surat->status_surat == "Diproses")) { ?>
                                        <td>Surat belum disetujui oleh penandatangan</td>
                                    <?php } else if ($surat->status_surat == "Ditolak") { ?>
                                        <td>QR code tidak akan muncul jika surat ditolak</td>
                                    <?php } else if ($surat->status_surat == "Disetujui") { ?>
                                        <td align="center">
                                            <a href="<?= site_url('pengesahan/surat_legalisir/' . $surat->kunci); ?>" target="_blank">
                                                <img src="<?= site_url('pengesahan/surat_legalisir/' . $surat->kunci); ?>" alt="QR code" width="100" height="100">
                                            </a>
                                        </td>
                                    <?php } ?>
                                    <td><?= $surat->status_surat ?></td>

                                    <?php if ($surat->status_surat == 'Disetujui') { ?>
                                        <td align="center"><a href="<?= site_url('pengesahan/detail_qrcode/' . $surat->kunci) ?>">QR CODE</a></td>
                                    <?php } else { ?>
                                        <?php if ($surat->nama_pembuat == $this->session->userdata("namalengkap")) { ?>
                                            <td><a href="<?= site_url('surat/edit/' . $surat->id_surat . '/' . $surat->id_legalisir) ?>">EDIT</a></td>
                                            <td><a href="<?= site_url('surat/delete/' . $surat->id_surat . '/' . $surat->id_legalisir) ?>" onclick="return confirm('Are you sure ?')">DELETE</a></td>
                                        <?php } ?>
                                    <?php } ?>
                                    <td colspan="2" align="center"><a href="<?= site_url('pengesahan/detail_surat/' . $surat->id_legalisir) ?>">DETAIL SURAT</a></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" align="center">Tidak ada surat</td>
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
                var name = $(this).find("td:nth-child(2)").text().toLowerCase();
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
