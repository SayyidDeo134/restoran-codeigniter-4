<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>

<h3>Tambah Data</h3>

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
        <label for="">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Ketikkan nama user ..." >
    </div>
    <div class="form-group">
        <label for="">Pilih Level</label>
        <select name="level" id="level" class="form-control" >
            <option value="Kasir">Kasir</option>
            <option value="Koki">Koki</option>
        </select>
    </div>
    <div class="form-group">
        <a href="<?php echo base_url('admin/user') ?>" class="btn btn-sm btn-danger">KEMBALI</a>
        <input type="submit" value="TAMBAH" name="add" class="btn btn-sm btn-primary">
    </div>
</form>

<?php echo $this->endSection() ?>