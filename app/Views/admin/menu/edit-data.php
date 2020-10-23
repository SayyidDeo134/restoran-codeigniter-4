<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>

<h3>UPDATE MENU</h3>

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

<form action="<?php echo base_url('admin/menu/aksi') ?>" method="post" enctype="multipart/form-data" class="my-3">
    <div class="form-group">
        <select name="kategori" class="form-control">
            <?php foreach($kategori as $key): ?>
            <option <?php echo $key['idkategori'] == $menu['idkategori'] ? 'selected' : ''; ?> value="<?php echo $key['idkategori'] ?>"><?php echo $key['kategori'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Nama Menu</label>
        <input type="text" name="menu" value="<?php echo $menu['menu'] ?>" placeholder="Input nama menu" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Harga Menu</label>
        <input type="number" name="harga" value="<?php echo $menu['harga'] ?>" placeholder="Input harga menu" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Pilih file ( <small>ext. jpg, png, webp</small> ) </label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <a href="<?php echo base_url('admin/menu') ?>" class="btn btn-sm btn-danger">KEMBALI</a>
        <input type="hidden" name="gambar" value="<?php echo $menu['gambar'] ?>">
        <input type="hidden" name="idmenu" value="<?php echo $menu['idmenu'] ?>">
        <input type="submit" value="UPDATE" name="ubah" class="btn btn-sm btn-success">
    </div>
</form>

<?php echo $this->endSection() ?>