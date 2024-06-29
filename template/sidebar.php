<?php
// Home Page
$homePage = current_url() == base_url('index.php');
$is_homePage_a = $homePage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_homePage_span = $homePage ? $span_active_state : '';

// Users List
$usersPage = $this->uri->uri_string() == 'users';
$is_usersPage_a = $usersPage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_usersPage_span = $usersPage ? $span_active_state : '';

// Documents List
$documentsPage = $this->uri->uri_string() == 'surat';
$is_documentsPage_a = $documentsPage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_documentsPage_span = $documentsPage ? $span_active_state : '';

// Validations List
$validationsPage = $this->uri->uri_string() == 'pengesahan';
$is_validationsPage_a = $validationsPage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_validationsPage_span = $validationsPage ? $span_active_state : '';

// Approves List
$approvesPage = $this->uri->uri_string() == 'surat/approved';
$is_approvesPage_a = $approvesPage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_approvesPage_span = $approvesPage ? $span_active_state : '';

// Checks List
$checksPage = $this->uri->uri_string() == 'surat/checked';
$is_checksPage_a = $checksPage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_checksPage_span = $checksPage ? $span_active_state : '';

// Rejects List
$rejectsPage = $this->uri->uri_string() == 'surat/rejected';
$is_rejectsPage_a = $rejectsPage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_rejectsPage_span = $rejectsPage ? $span_active_state : '';

// Nonactive Users List
$nonactiveUsersPage = $this->uri->uri_string() == 'users/nonactive_users';
$is_nonactiveUsersPage_a = $nonactiveUsersPage ? 'dark:text-gray-100 text-gray-800' : '';
$span_active_state = '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
$is_nonactiveUsersPage_span = $nonactiveUsersPage ? $span_active_state : '';
?>
<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="<?= base_url() ?>">
            Legalitas Surat
        </a>
        <ul class="mt-6">
            <?php if ($this->session->has_userdata('email')) { ?>
                <li class="relative px-6 py-3">
                    <?= $is_homePage_span ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_homePage_a ?>" href="<?= base_url() ?>">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                <?php if ($this->session->userdata('role') == 'Admin') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_usersPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_usersPage_a ?>" href="<?= site_url('users') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="ml-4">Daftar User</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Pembuat') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_documentsPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_documentsPage_a ?>" href="<?= site_url('surat') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                                </path>
                            </svg>
                            <span class="ml-4">Daftar Surat</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Pemeriksa_Penandatangan') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_validationsPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_validationsPage_a ?>" href="<?= site_url('pengesahan') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21.5 12H16c-.7 2-2 3-4 3s-3.3-1-4-3H2.5" />
                                <path d="M5.5 5.1L2 12v6c0 1.1.9 2 2 2h16a2 2 0 002-2v-6l-3.4-6.9A2 2 0 0016.8 4H7.2a2 2 0 00-1.8 1.1z" />
                            </svg>
                            <span class="ml-4">Daftar Permintaan</span>
                        </a>
                    </li>
                <?php } ?>
                <li class="relative px-6 py-3">
                    <button class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none" onclick="toggleDropdown()">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 8v4l3 3" />
                            <path d="M12 22c5.52 0 10-4.48 10-10S17.52 2 12 2 2 6.48 2 12h1.5" />
                        </svg>
                        <span class="ml-4">Riwayat</span>
                        <svg class="w-4 h-4 ml-auto" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul id="dropdown" class="hidden absolute left-0 w-full mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none dark:bg-gray-800 dark:border-gray-700">
                        <?php if ($this->session->userdata('role') != 'Admin') { ?>
                            <li class="relative px-6 py-3">
                                <?= $is_checksPage_span ?>
                                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_checksPage_a ?>" href="<?= site_url('surat/checked') ?>">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6" />
                                        <path d="M14 3v5h5" />
                                        <circle cx="16" cy="16" r="3"></circle>
                                        <path d="M21 21l-2.35-2.35M11"></path>
                                    </svg>
                                    <span class="ml-4">Surat Diperiksa</span>
                                </a>
                            </li>
                            <li class="relative px-6 py-3">
                                <?= $is_approvesPage_span ?>
                                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_approvesPage_a ?>" href="<?= site_url('surat/approved') ?>">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6" />
                                        <path d="M14 3v5h5" />
                                        <path d="M15 19l2 2l5-5" />
                                    </svg>
                                    <span class="ml-4">Surat Disetujui</span>
                                </a>
                            </li>
                            <li class="relative px-6 py-3">
                                <?= $is_rejectsPage_span ?>
                                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_rejectsPage_a ?>" href="<?= site_url('surat/rejected') ?>">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6" />
                                        <path d="M14 3v5h5" />
                                        <path d="M22 22l-6-6" />
                                        <path d="M16 22l6-6" />
                                    </svg>
                                    <span class="ml-4">Surat Ditolak</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <li class="relative px-6 py-3">
                                <?= $is_nonactiveUsersPage_span ?>
                                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_nonactiveUsersPage_a ?>" href="<?= site_url('users/nonactive_users') ?>">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="18" y1="8" x2="23" y2="13"></line>
                                        <line x1="23" y1="8" x2="18" y2="13"></line>
                                    </svg>
                                    <span class="ml-4">Pengguna Tidak Aktif</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="relative px-6 py-3">
                    <?= $is_approvesPage_span ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_approvesPage_a ?>" href="<?= site_url('surat/approved') ?>">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6" />
                            <path d="M14 3v5h5" />
                            <path d="M15 19l2 2l5-5" />
                        </svg>
                        <span class="ml-4">Daftar surat</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>
<!-- Mobile sidebar -->
<!-- Backdrop -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="<?= base_url() ?>">
            Legalitas Surat
        </a>
        <ul class="mt-6">
            <?php if ($this->session->has_userdata('email')) { ?>
                <li class="relative px-6 py-3">
                    <?= $is_homePage_span ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_homePage_a ?>" href="<?= base_url() ?>">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                <?php if ($this->session->userdata('role') == 'Admin') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_usersPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_usersPage_a ?>" href="<?= site_url('users') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="ml-4">Daftar User</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Pembuat') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_documentsPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_documentsPage_a ?>" href="<?= site_url('surat') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                                </path>
                            </svg>
                            <span class="ml-4">Daftar Surat</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Pemeriksa_Penandatangan') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_validationsPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_validationsPage_a ?>" href="<?= site_url('pengesahan') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21.5 12H16c-.7 2-2 3-4 3s-3.3-1-4-3H2.5" />
                                <path d="M5.5 5.1L2 12v6c0 1.1.9 2 2 2h16a2 2 0 002-2v-6l-3.4-6.9A2 2 0 0016.8 4H7.2a2 2 0 00-1.8 1.1z" />
                            </svg>
                            <span class="ml-4">Daftar Permintaan</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') != 'Admin') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_checksPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_checksPage_a ?>" href="<?= site_url('surat/checked') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6" />
                                <path d="M14 3v5h5" />
                                <circle cx="16" cy="16" r="3"></circle>
                                <path d="M21 21l-2.35-2.35M11"></path>
                            </svg>
                            <span class="ml-4">Surat Diperiksa</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <?= $is_approvesPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_approvesPage_a ?>" href="<?= site_url('surat/approved') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6" />
                                <path d="M14 3v5h5" />
                                <path d="M15 19l2 2l5-5" />
                            </svg>
                            <span class="ml-4">Surat Disetujui</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <?= $is_rejectsPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_rejectsPage_a ?>" href="<?= site_url('surat/rejected') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M20 11.08V8l-6-6H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h6" />
                                <path d="M14 3v5h5" />
                                <path d="M22 22l-6-6" />
                                <path d="M16 22l6-6" />
                            </svg>
                            <span class="ml-4">Surat Ditolak</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('role') == 'Admin') { ?>
                    <li class="relative px-6 py-3">
                        <?= $is_nonactiveUsersPage_span ?>
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_nonactiveUsersPage_a ?>" href="<?= site_url('users/nonactive_users') ?>">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="18" y1="8" x2="23" y2="13"></line>
                                <line x1="23" y1="8" x2="18" y2="13"></line>
                            </svg>
                            <span class="ml-4">Pengguna Tidak Aktif</span>
                        </a>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li class="relative px-6 py-3">
                    <?= $is_approvesPage_span ?>
                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 <?= $is_approvesPage_a ?>" href="<?= site_url('surat/approved') ?>">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                            <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                        </svg>
                        <span class="ml-4">Daftar Surat</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>