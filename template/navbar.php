<ul>
    <?php if ($this->session->has_userdata('email')) : // Check if $login is set and true 
    ?>
        <li class="flex">
            <a href="<?= site_url('users/detail_user/' . $this->session->userdata("iduser")) ?>">Profile</a>
        </li>
        <li class="flex">
            <a href="<?= site_url('users/setting/' . $this->session->userdata("iduser")) ?>">Settings</a>
        </li>
        <li>
            <a href="<?= site_url("auth/logout") ?>" onclick="return confirm('Are you sure ?')">Log Out</a>
        </li>
    <?php else : ?>
        <li>
            <a href="<?= site_url('auth/login') ?>">
                Log In
            </a>
        </li>
    <?php endif; ?>
</ul>