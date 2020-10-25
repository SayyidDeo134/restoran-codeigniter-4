<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>

<?php 

if (isset($_GET['page_page'])) {
    $page = $_GET['page_page'];
    $jumlah = 3;
    $no = ($page * $jumlah) - $jumlah + 1;
}else{
    $no = 1;
}

?>

<h3>ORDER</h3>
<?php $whosLogin = session()->get('administrator') ?>

<?php echo session()->getFlashdata('pesan') ?>

<table class="table table-bordered" style="font-size: 12px">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Order</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($order as $key): ?>
            <tr>
                <td> <?php echo $no++ ?> </td>
                <td> <?php echo $key['idorder'] ?> </td>
                <td> <?php echo $key['pelanggan'] ?> </td>
                <td> <?php echo $key['tglorder'] ?> </td>
                <td> Rp. <?php echo number_format($key['total'], 0, ',', '.') ?> </td>
                <td> Rp. <?php echo number_format($key['bayar'], 0, ',', '.') ?> </td>
                <td> Rp. <?php echo number_format($key['kembali'], 0, ',', '.') ?> </td>
                <td class="text-center" > 
                    <?php if($key['status'] == 1) : ?>
                        <button class="btn btn-sm btn-success">LUNAS</button>
                    <?php else: ?>
                        <a href="<?php echo base_url('admin/order/bayar/' . $key['idorder']) ?>" class="btn btn-sm btn-danger">BELUM LUNAS</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $pager->links('page', 'bootstrap') ?>

<?php echo $this->endSection() ?>