<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>

<h1 class="text-uppercase" >SELAMAT DATANG  <?php echo session()->get('administrator')['username'] ?> </h1>

<?php echo $this->endSection() ?>