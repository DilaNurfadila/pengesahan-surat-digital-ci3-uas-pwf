<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <?php include 'template/head.php' ?>
</head>

<body>
    <?php if ($this->session->userdata('email')) {
        $user = $this->session->userdata('namalengkap');
    } else {
        $user = 'guest';
    } ?>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php include 'template/sidebar.php'; ?>
        <div class="flex flex-col flex-1 w-full">
            <?php include 'template/navbar.php'; ?>
            <main class="h-full overflow-y-auto">
                <?php include 'template/dashboard.php'; ?>
            </main>
        </div>
    </div>
</body>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('hidden');
    }
</script>

</html>