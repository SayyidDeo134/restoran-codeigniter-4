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

<h3>KATEGORI</h3>

<a href="<?php echo base_url('admin/kategori/tambah') ?>" class="btn btn-sm btn-primary my-3 "> TAMBAH DATA </a>

<?php echo session()->getFlashdata('pesan') ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($kategori as $key) : ?>
        <tr>
            <td> <?php echo $no++ ?> </td>
            <td> <?php echo $key['kategori'] ?> </td>
            <td>
                <a href="<?php echo base_url('admin/kategori/edit/' . $key['idkategori'] ) ?>" class="btn btn-sm btn-secondary"> UPDATE </a>
                <a href="<?php echo base_url('admin/kategori/hapus/' . $key['idkategori'] ) ?>" class="btn btn-sm btn-danger"> DELETE </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links('page', 'bootstrap') ?>

<?php echo $this->endSection() ?>