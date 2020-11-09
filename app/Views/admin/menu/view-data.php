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

if(isset($_GET['idkategori'])){
    $selected = $_GET['idkategori'];
}else{
    $selected = '';
}

?>

<h3 class="ff-base fw-medium">MENU</h3>

<?php echo session()->getFlashdata('pesan') ?>

<div class="card card-borderd">
    <div class="card-header">
        Daftar Menu
        <div class="float-right">
            <a href="<?php echo base_url('admin/menu/tambah') ?>" > TAMBAH DATA </a>
        </div>
    </div>
    <div class="card-body">

        <form action="<?php echo base_url('admin/menu') ?>" method="get">
            <div class="form-group">
            <div class="form-control-wrap">
                <select name="idkategori" onchange="this.form.submit()" class="form-select" data-ui="sm">
                    <?php foreach($kategori as $key): ?>
                    <option <?php echo $key['idkategori'] == $selected ? 'selected' : ''; ?> value="<?php echo $key['idkategori'] ?>"><?php echo $key['kategori'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
        </form>

        <table class="table table-bordered my-2">
            <thead class="thead-dark">
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
                    <td> <img src="<?php echo base_url('uploads/menu/' . $key['gambar']) ?>" style="width: 100px;" alt="gambar"> </td>
                    <td> <?php echo number_format($key['harga'], '0', ',', '.') ?> </td>
                    <td>
                        <a href="<?php echo base_url('admin/menu/edit/' . $key['idmenu'] ) ?>" class="btn btn-sm btn-secondary"> UPDATE </a>
                        <a href="<?php echo base_url('admin/menu/hapus/' . $key['idmenu'] ) ?>" class="btn btn-sm btn-danger"> DELETE </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="float-right mt-2">
            <?= $pager->links('page', 'bootstrap') ?>
        </div>
    </div>
</div>


<?php echo $this->endSection() ?>