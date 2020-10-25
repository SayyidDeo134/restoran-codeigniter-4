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

<h3>PELANGGAN</h3>
<?php $whosLogin = session()->get('administrator') ?>

<?php echo session()->getFlashdata('pesan') ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Delete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pelanggan as $key): ?>
            <tr>
                <td> <?php echo $no++ ?> </td>
                <td> <?php echo $key['pelanggan'] ?> </td>
                <td> <?php echo $key['alamat'] ?> </td>
                <td> <?php echo $key['telp'] ?> </td>
                <td> <?php echo $key['email'] ?> </td>
                <td>
                    <a href="<?php echo base_url('admin/pelanggan/hapus/' . $key['idpelanggan'] . '/' . $key['aktif']) ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
                <td class="text-center" > 
                    <?php if($key['aktif'] == 1) : ?>
                        <a href="<?php echo base_url('admin/pelanggan/status/' . $key['idpelanggan'] . '/' . $key['aktif']) ?>" class="btn btn-sm btn-success">AKTIF</a>
                    <?php else: ?>
                        <a href="<?php echo base_url('admin/pelanggan/status/' . $key['idpelanggan'] . '/' . $key['aktif']) ?>" class="btn btn-sm btn-danger">TIDAK AKTIF</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links('page', 'bootstrap') ?>

<?php echo $this->endSection() ?>