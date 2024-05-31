<a href="<?= base_url() ?>">
    Legalitas Surat
</a>
<ul>
    <li>
        <a href="<?= base_url() ?>">
            Dashboard
        </a>
    </li>
    <?php if ($this->session->userdata('role') == 'Admin') { ?>
        <li>
            <a href="<?= site_url('users') ?>">
                Daftar User
            </a>
        </li>
    <?php } ?>
    <?php if ($this->session->has_userdata('email')) { ?>
        <li>
            <a href="<?= site_url('surat') ?>">
                Daftar Surat
            </a>
        </li>
        <li>
            <a href="<?= site_url('pengesahan') ?>">
                Daftar Permintaan
            </a>
        </li>
        <li>
            Riwayat
        </li>
        <ul>
            <li><a href="<?= site_url('surat/approved') ?>">Surat disetujui</a></li>
            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                <li><a href="<?= site_url('users/nonactive_users') ?>">Pengguna tidak aktif</a></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <li><a href="<?= site_url('surat/approved') ?>">Daftar Surat</a></li>
    <?php } ?>
</ul>