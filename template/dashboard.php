<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <?php include "head.php" ?>
</head>

<body>
    <!-- About Start -->
    <div class="container mx-auto py-6 px-6" id="about">
        <h1 id="datang" class="text-5xl font-bold mb-4 dark:text-white">Selamat datang <?= $user ?></h1>
        <div class="container mx-auto">
            <div class="lg:flex gap-5 ">
                <div class="w-full lg:w-1/2 mb-5">
                    <div class="flex items-center mb-5">
                        <div class="flex-shrink-0 text-center mr-4">
                            <h1 class="text-9xl font-bold mb-0 dark:text-white">4</h1>
                            <h5 class="text-3xl font-medium mb-0 font-bold tracking-widest dark:text-white">Cara</h5>
                        </div>
                        <h3 class="leading-relaxed text-4xl mb-0 font-bold dark:text-white">untuk meminta surat di approve & di legalisir</h3>
                    </div>
                    <p class="mb-4 dark:text-white">Ada 4 cara untuk mendapat legalisir surat</p>
                    <p class="mb-3 flex items-center dark:text-white"><i class="far fa-check-circle text-blue-500 mr-3"></i>Login terlebih dahulu</p>
                    <p class="mb-3 flex items-center dark:text-white"><i class="far fa-check-circle text-blue-500 mr-3"></i>Upload dokumen dan di pastikan pdf</p>
                    <p class="mb-3 flex items-center dark:text-white"><i class="far fa-check-circle text-blue-500 mr-3"></i>Menunggu proses persetujuan</p>
                    <p class="mb-3 flex items-center dark:text-white"><i class="far fa-check-circle text-blue-500 mr-3"></i>Unduh atau salin QR Code ke dalam file surat</p>
                    <a class="btn bg-blue-500 text-white py-3 px-5 mt-3 inline-block rounded" href="">Read More</a>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="flex gap-3 mb-4">
                        <div class="w-1/2">
                            <img class="h-full rounded" src="<?= base_url('assets/dasbor/img/login.jpg') ?>" alt="">
                        </div>
                        <div class="w-1/2">
                            <img class="h-full rounded" src="<?= base_url('assets/dasbor/img/upload.jpg') ?>" alt="">
                        </div>
                    </div>
                    <div class="flex items-center mb-3">
                        <h5 class="border-r border-gray-400 pr-3 mr-3 mb-0 font-bold dark:text-white">Clients</h5>
                        <h2 class="text-blue-500 font-bold text-2xl mb-0" data-toggle="counter-up">1234</h2>
                    </div>
                    <p class="mb-4 dark:text-white">Ada banyak data pegawai yang meminta legalisir surat.</p>
                    <div class="flex items-center mb-3">
                        <h5 class="border-r border-gray-400 pr-3 mr-3 mb-0 font-bold dark:text-white">Dokumen Approvement</h5>
                        <h2 class="text-blue-500 font-bold text-2xl mb-0" data-toggle="counter-up">500</h2>
                    </div>
                    <p class="mb-0 dark:text-white">Data dokumen yang telah dilegalisir.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
</body>

</html>