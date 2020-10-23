<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>

<?php 

if (isset($_GET['page_page'])) {
    $page = $_GET['page_page'];
    $jumlah = 2;
    $no = ($page * $jumlah) - $jumlah + 1;
}else{
    $no = 1;
}

?>

<h3>MENU</h3>

<?php echo session()->getFlashdata('pesan') ?>

<a href="<?php echo base_url('admin/menu/tambah') ?>" class="btn btn-sm btn-primary my-3 "> TAMBAH DATA </a>

<form action="" method="get">
    <div class="form-group">
        <select name="kategori" class="form-control">
            <?php foreach($kategori as $key): ?>
            <option value="<?php echo $key['idkategori'] ?>"><?php echo $key['kategori'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($menu as $key) : ?>
        <tr>
            <td> <?php echo $no++ ?> </td>
            <td> <?php echo $key['menu'] ?> </td>
            <td> <img src="<?php echo $key['menu'] ?>" alt="gambar"> </td>
            <td> <?php echo number_format($key['harga'], '0', ',', '.') ?> </td>
            <td>
                <a href="<?php echo base_url('admin/menu/edit/' . $key['idmenu'] ) ?>" class="btn btn-sm btn-secondary"> UPDATE </a>
                <a href="<?php echo base_url('admin/menu/hapus/' . $key['idmenu'] ) ?>" class="btn btn-sm btn-danger"> DELETE </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links('page', 'bootstrap') ?>

<?php echo $this->endSection() ?>