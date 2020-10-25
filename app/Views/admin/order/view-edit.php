<?php echo $this->extend('template/admin-layout') ?>
<?php echo $this->section('content') ?>

<h3>PEMBAYARAN</h3>

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

<form action="<?php echo base_url('admin/order/proses-bayar') ?>" method="post" class="my-3">
    <div class="form-group">
        <label for="">TOTAL BAYAR</label>
        <input type="text" value="Rp. <?php echo number_format($order['total'], 0, ',', '.') ?>" class="form-control" readonly>
        <input type="hidden" name="total-bayar" value="<?php echo $order['total'] ?>" class="form-control">
        <input type="hidden" name="idorder" value="<?php echo $order['idorder'] ?>">
    </div>
    <div class="form-group">
        <label for="">JUMLAH BAYAR</label>
        <input type="number" name="jumlah-bayar" class="form-control">
    </div>
    <div class="form-group">
        <a href="<?php echo base_url('admin/order') ?>" class="btn btn-sm btn-danger">KEMBALI</a>
        <input type="submit" value="BAYAR" name="ubah" class="btn btn-sm btn-success">
    </div>
</form>

<h4>Rincian Pembelian</h4>

<table class="table table-bordered" style="font-size: 12px">
    <thead>
        <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach($orderdetail as $key): ?>
            <tr>
                <td> <?php echo $no++ ?> </td>
                <td> <?php echo $key['menu'] ?> </td>
                <td> Rp. <?php echo number_format($key['harga'], 0, ',', '.') ?> </td>
                <td> <?php echo $key['jumlah'] ?> </td>
                <?php $total = $key['harga'] * $key['jumlah'] ?>
                <td> <?php echo $total ?> </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->endSection() ?>