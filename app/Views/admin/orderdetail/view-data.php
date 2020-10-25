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

<h3>ORDERDETAIL</h3>
<?php $whosLogin = session()->get('administrator') ?>

<?php echo session()->getFlashdata('pesan') ?>

<div class="row">
    <div class="col-6">
        <form action="<?php echo base_url('admin/orderdetail') ?>" method="post">
            <div class="form-group" ata-provide="datepicker">
                <label for="">Tanggal Mulai</label>
                <input type="date" name="tanggal-mulai" id="tanggal-mulai" class="form-control">
            </div>

            <div class="form-group" ata-provide="datepicker">
                <label for="">Tanggal Akhir</label>
                <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="CARI" class="btn btn-sm btn-primary" name="cari-tanggal">
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered" style="font-size: 12px">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($orderdetail as $key): ?>
            <tr>
                <td> <?php echo $no++ ?> </td>
                <td> <?php echo $key['tglorder'] ?> </td>
                <td> <?php echo $key['menu'] ?> </td>
                <td> Rp. <?php echo number_format($key['harga'], 0, ',', '.') ?> </td>
                <td> <?php echo $key['jumlah'] ?> </td>
                <?php $total = $key['harga'] * $key['jumlah'] ?>
                <td> <?php echo $total ?> </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $pager->links('page', 'bootstrap') ?>

<?php echo $this->endSection() ?>