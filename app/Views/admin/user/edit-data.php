<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>
<?php $whosLogin = session()->get('administrator') ?>
<h4> <span class="text-uppercase" > <?php echo $whosLogin['username'] ?>, </span> apakah anda ingin mengubah password?</h4>

<?php 
    if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'OPPS sepertinya ada kesalahan';
        echo '<ul>';
        foreach (session()->getFlashdata('pesan') as $key => $value) {
            echo '<li> ' . $value . ' </li>';
        }
        echo '</ul>';
        echo '</div>';
    }
?>

<form action="<?php echo base_url('admin/user/aksi') ?>" method="post" class="my-3">
    <div class="form-group">
        <label for="">Password lama</label>
        <input type="password" name="old-password" id="old-password" class="form-control" placeholder="Ketikkan password lama ..." >
    </div>
    <div class="form-group">
        <label for="">Password baru</label>
        <input type="password" name="new-password" id="new-password" class="form-control" placeholder="Ketikkan password baru ..." >
    </div>
    <div class="form-group">
        <label for="">Confirm password baru</label>
        <input type="password" name="konfirm" id="konfirm" class="form-control" placeholder="Konfirmasi password baru ..." >
    </div>
    <div class="form-group">
        <a href="<?php echo base_url('admin/user') ?>" class="btn btn-sm btn-danger">KEMBALI</a>
        <input type="submit" value="TAMBAH" name="ubah" class="btn btn-sm btn-primary">
    </div>
</form>

<?php echo $this->endSection() ?>