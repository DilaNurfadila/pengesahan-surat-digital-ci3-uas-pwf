<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<head>
    <title>Document</title>
</head>
<body>
    <br>
    <?= $this->session->flashdata('msg') ?>
    <a href="<?= site_url('users/add')?>">TAMBAH USER</a>
    <!-- <a href="<?= site_url('users031/add') ?>" class="button-link">Add new user</a> -->
    <hr>
    <div class="cat-list">
        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Posisi</th>
                <th>Role</th>
                <th colspan="2">Action</th>
            </tr>
            <?php $i = 1;
            foreach ($users as $user) { ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <!-- <td></td> -->
                    <td><?= $user->nama_lengkap ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->alamat ?></td>
                    <td><?= $user->no_hp ?></td>
                    <td><?= $user->posisi ?></td>
                    <td><?= $user->user_role ?></td>
                    <td><a href="<?= site_url('users/edit/' . $user->id_user) ?>">EDIT</a></td>
                    <td><a href="<?= site_url('users/delete/'. $user->id_user)?>" onclick="return confirm('Are you sure ?')">DELETE</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <a href="<?= base_url() ?>" class="button-link">
        HOME
    </a>
</body>