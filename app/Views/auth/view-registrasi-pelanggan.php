<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRASI PELANGGAN</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>/public/images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/dashlite.css?ver=1.9.2">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/theme.css?ver=1.9.2">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Header -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="<?php echo base_url() ?>">RESTORAN</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto ">
                            <li class="nav-item">
                                <a href="<?php echo base_url('login-pelanggan') ?>" class="nav-link" href="">Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-8">
                <form action="<?php echo base_url('regist-pelanggan') ?>" method="post">
                    <div class="card">
                        <div class="card-body">
                            <div class="header text-center">
                                <h3>REGISTRASI</h3>
                            </div>
                            <div class="my-3">
                                <?php echo session()->getFlashdata('pesan') ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for=""> Nama Lengkap <small> (Tidak boleh menggunakan angka dan simbol) </small> </label>
                                        <input type="text" name="pelanggan" id="pelanggan" class="form-control" placeholder="Nama lengkap anda ..." >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> Alamat </label>
                                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat anda ..." >
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Email </label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email anda ..." >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""> Nomor telepon </label>
                                        <input type="number" name="telp" id="telp" class="form-control" placeholder="Nomor telepon anda ..." >
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Password </label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password anda ...">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="DAFTAR" name="regist-pelanggan" class=" mt-2 col-12 btn btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>/public/assets/js/bundle.js?ver=1.9.2"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/scripts.js?ver=1.9.2"></script>
</body>
</html>