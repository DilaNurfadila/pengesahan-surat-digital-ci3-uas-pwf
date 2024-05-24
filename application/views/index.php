<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <style>
        /* Styling untuk popup */
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 5px solid #888;
            width: 30%;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Legalitas</h1>
    <h4>DASHBOARD</h4>
    <hr>
    <ul>
        <li><a href="<?= site_url('') ?>">Dashboard</a></li>
        <li><a href="<?= site_url('surat') ?>">Daftar Surat</a></li>
        <li><a href="<?= site_url('users') ?>">Daftar User</a></li>
        <li>
            <?php if ($this->session->has_userdata('email')) : // Check if $login is set and true 
            ?>
                <a href="<?= site_url("auth/logout") ?>" id="logoutLink">Log Out</a>
            <?php else : ?>
                <a href="<?= site_url('auth/login') ?>">Login</a>
            <?php endif; ?>
        </li>
    </ul>
        <!-- Popup konfirmasi -->
        <div id="confirmationPopup" class="popup">
        <div class="popup-content">
            <h2>Are you sure ?</h2>
            <p>Apakah Anda yakin ingin logout ?</p>
            <button id="confirmButton">OK</button>
            <button id="cancelButton">Batal</button>
        </div>
    </div>
    <script>
        var logoutLink = document.getElementById('logoutLink');
        var confirmationPopup = document.getElementById('confirmationPopup');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        if (logoutLink) {
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah tautan dari redirect secara langsung
                confirmationPopup.style.display = 'block'; // Menampilkan popup
            });
        }

        confirmButton.addEventListener('click', function() {
            window.location.href = '<?= site_url("auth/logout") ?>'; // Redirect ke URL logout
        });

        cancelButton.addEventListener('click', function() {
            confirmationPopup.style.display = 'none'; // Menyembunyikan popup
        });

        window.addEventListener('click', function(event) {
            if (event.target == confirmationPopup) {
                confirmationPopup.style.display = 'none'; // Menyembunyikan popup jika area di luar popup diklik
            }
        });
    </script>
</body>
</html>