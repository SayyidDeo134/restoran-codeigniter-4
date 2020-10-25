<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESTAURANT</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
    <?php 
        $whosLogin = session()->get('pelanggan');   
    ?>
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
                            <?php if(!empty($whosLogin)): ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('histori-pesan') ?>" class="nav-link" >Histori pembelian</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('keranjang') ?>" class="nav-link" >Keranjang : <?php echo $quantity_total; ?></a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url() ?>" class="nav-link" > <?php echo $whosLogin['pelanggan'] ?> </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('logout-pelanggan') ?>" class="nav-link" >Logout</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('login-pelanggan') ?>" class="nav-link" >Login</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('registrasi') ?>" class="nav-link" >Registrasi</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-3">
                <!-- Menu -->
                <div class="list-group">
                    <span class="list-group-item list-group-item-action active text-center"> KATEGORI MENU </span>
                    <?php foreach($kategori as $key) : ?>
                        <a href="<?php echo base_url($key['idkategori']) ?>" class="list-group-item list-group-item-action"> <?php echo $key['kategori'] ?> </a>
                    <?php endforeach; ?>
                </div>
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