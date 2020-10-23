<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
    
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
                                <a class="nav-link" href="#">Log Out</a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/kategori') ?>">KATEGORI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('admin/menu') ?>">MENU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">PELANGGAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ORDER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ORDER DETAIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">USER</a>
                    </li>
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


    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>