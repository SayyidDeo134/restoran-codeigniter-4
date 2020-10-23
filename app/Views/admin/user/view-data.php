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

<h3>USER</h3>
<?php $whosLogin = session()->get('administrator') ?>

<?php echo session()->getFlashdata('pesan') ?>

<?php if($whosLogin['level'] == 'Administrator') : ?>
<a href="<?php echo base_url('admin/user/tambah') ?>" class="btn btn-sm btn-primary my-3 "> TAMBAH DATA </a>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Status</th>
            <?php if($whosLogin['level'] == 'Administrator') : ?>
            <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($user as $key): ?>
            <tr>
                <td> <?php echo $no++ ?> </td>
                <td> <?php echo $key['user'] ?> </td>
                <td> <?php echo $key['email'] ?> </td>
                <td> <?php echo $key['level'] ?> </td>
                <td class="text-center" > 
                    <?php if($key['aktif'] == 1) : ?>
                        <?php if($whosLogin['level'] == 'Administrator') : ?>
                            <a href="<?php echo base_url('admin/user/status/' . $key['iduser'] . '/' . $key['aktif']) ?>" class="btn btn-sm btn-success">AKTIF</a>
                        <?php else: ?>
                            <span>AKTIF</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if($whosLogin['level'] == 'Administrator') : ?>
                            <a href="<?php echo base_url('admin/user/status/' . $key['iduser'] . '/' . $key['aktif']) ?>" class="btn btn-sm btn-danger">TIDAK AKTIF</a>
                        <?php else: ?>
                            <span>TIDAK AKTIF</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
                <?php if($whosLogin['level'] == 'Administrator') : ?>
                <td>
                    <a href="<?php echo base_url('admin/user/hapus/' . $key['iduser'] . '/' . $key['aktif']) ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links('page', 'bootstrap') ?>

<?php echo $this->endSection() ?>