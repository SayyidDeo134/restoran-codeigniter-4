<?php echo $this->extend('template/front-layout') ?>
<?php echo $this->section('content') ?>

<?php $whosLogin = session()->get('pelanggan') ?>

<h2> Selamat Datang Di Website Kami </h2>
<p>
    <?php echo !empty($whosLogin) ? 'Halo ' . $whosLogin['pelanggan'] . ', ' : '' ?> 
    Silahkan pilih pesanan anda
</p>

<?php echo session()->getFlashdata('pesan') ?>

<div class="row">
    <?php foreach($menu as $key) : ?>
        <?php foreach($kategori as $tag) : ?>
            <?php if($key['idkategori'] == $tag['idkategori']) : ?>
            <div class="col-md-4 my-3">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url('uploads/menu/' . $key['gambar']) ?>" style="height:180px" alt="Card image cap">
                    <div class="card-body">
                        <span style="font-size: 14px; display: block" > <?php echo $key['menu'] ?> </span>
                        <small class="text-muted" > <?php echo $tag['kategori'] ?> | Rp. <?php echo number_format($key['harga'], 0, ',', '.') ?> </small>
                        <div class="d-flex flex-row-reverse mt-3" >
                            <a href="<?php echo base_url('tambah-keranjang/' . $key['idmenu']) ?>" class="btn btn-primary btn-sm"> Tambah ke keranjang </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<?= $pager->links('page', 'bootstrap') ?>

<?php echo $this->endSection() ?>