<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sayyid Deo Amirul Mukmin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <meta name="description" content="Aplikasi restauran sederhana, dimana memudahkan pembeli dan pihak restauran untuk berkomunikasi">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/public/images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/dashlite.css?ver=1.9.2">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url() ?>/public/assets/css/theme.css?ver=1.9.2">
</head>
<body>
    <?php $whosLogin = session()->get('administrator'); $level = $whosLogin['level']; ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Header -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="<?php echo base_url('admin') ?>">ADMIN | RESTORAN</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto ">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('admin/user/ubah-password') ?>" > <?php echo $whosLogin['username'] . ' | ' . $whosLogin['level'] ?> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('admin/logout') ?>">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-3">
                <!-- Menu -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin') ?>">DASHBOARD</a>
                    </li>
                    <?php if($level == 'Administrator') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/kategori') ?>">KATEGORI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/menu') ?>">MENU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/pelanggan') ?>">PELANGGAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/order') ?>">ORDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/orderdetail') ?>">ORDER DETAIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/user') ?>">USER</a>
                    </li>
                    <?php endif; ?>
                    <?php if($level == 'Kasir') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/order') ?>">ORDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/orderdetail') ?>">ORDER DETAIL</a>
                    </li>
                    <?php endif; ?>
                    <?php if($level == 'Koki') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/orderdetail') ?>">ORDER DETAIL</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-9">
                <!-- Content -->
                <?php $this->renderSection('content') ?>
            </div>
        </div>
        <div class="row">
            <div class="col text-center ">
                <!-- Footer -->
                <p> RESTAURAN &copy; sayyiddeo.real@gmail.com, 2020 </p>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>/public/assets/js/bundle.js?ver=1.9.2"></script>
    <script src="<?php echo base_url() ?>/public/assets/js/scripts.js?ver=1.9.2"></script>
</body>
</html>