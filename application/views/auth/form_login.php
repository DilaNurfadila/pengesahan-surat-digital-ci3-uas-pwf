<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3 class="input-group mt-4">Hello, Again</h3>
    <p>We are happy to have you back.</p>
    <?= $this->session->flashdata('msg') ?>
    <div style="color:red;"><?= validation_errors() ?></div>

    <form action="" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email" name="email" required>
        </div>
        <div class="input-group mb-1">
            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" require>
        </div>
        <div class="input-group mb-5 d-flex justify-content-between">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="formCheck">
                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
            </div>
        </div>
        <div class="input-group mb-5">
            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit" value="LOGIN" name="login">Login</button>
        </div>
    </form>

</body>

</html>