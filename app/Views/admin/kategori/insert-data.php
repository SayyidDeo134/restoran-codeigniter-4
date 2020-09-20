<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>

<h3>TAMBAH KATEGORI</h3>

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

<form action="<?php echo base_url('admin/kategori/aksi') ?>" method="post" class="my-3">
    <div class="form-group">
        <label for="">Nama Kategori</label>
        <input type="text" name="kategori" placeholder="Input nama kategori" class="form-control">
    </div>
    <div class="form-group">
        <a href="<?php echo base_url('admin/kategori') ?>" class="btn btn-sm btn-danger">KEMBALI</a>
        <input type="submit" value="TAMBAH" name="add" class="btn btn-sm btn-success">
    </div>
</form>

<?php echo $this->endSection() ?>