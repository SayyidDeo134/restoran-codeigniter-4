<?php echo $this->extend('template/front-layout') ?>
<?php echo $this->section('content') ?>


<h2> <?php echo !empty(session()->get('cart')) ? 'Keranjang pesanan anda' : 'Keranjang pesanan anda kosong' ?> </h2>

<?php echo session()->getFlashdata('pesan') ?>

<div class="row">
    <div class="col">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pesanan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($items as $key) : ?>
                    <tr>
                        <td> <?php echo $no++ ?> </td>
                        <td> <?php echo $key['menu'] ?> </td>
                        <td> 
                            <a href="<?php echo base_url('kurang-pesanan/' . $key['id']) ?>" class="btn btn-sm btn-danger mr-2"> Kurang </a>
                            <?php echo $key['quantity'] ?> 
                            <a href="<?php echo base_url('tambah-pesanan/' . $key['id']) ?>" class="btn btn-sm btn-success ml-2"> Tambah </a>
                        </td>
                        <td> Rp. <?php echo number_format($key['price'], 0, 'z', '.') ?> </td>
                        <?php $totalHarga = $key['price'] * $key['quantity']; ?>
                        <td> Rp. <?php echo number_format($totalHarga, 0, ',', '.') ?> </td>
                        <td> <a href="<?php echo base_url('hapus-pesanan/' . $key['id']) ?>" class="btn btn-sm btn-danger"> Hapus </a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" > Total Bayar </td>
                    <td colspan="2" > Rp. <?php echo number_format($total, 0, ',', '.') ?> </td>
                </tr>
            </tbody>
        </table>
        <div class="form-group d-flex justify-content-end ">
            <?php if(!empty(session()->get('cart'))) : ?>
                <a href="<?php echo base_url('proses-pesan') ?>" class="btn btn-sm btn-success">Pesan</a>
            <?php else: ?>
                <a href="<?php echo base_url() ?>" class="btn btn-sm btn-success">Belanja Yuk</a>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php echo $this->endSection() ?>