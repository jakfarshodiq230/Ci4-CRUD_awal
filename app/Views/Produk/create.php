<!-- membuat layout conten harus sama dengan section pada template -->
<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">Data Pengguna</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <form class="form" action="/c_produk/save" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="id_user">ID Produk</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $kode_otomatis; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="userinput2">Nama</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" autofocus value="<?= old('nama_produk'); ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('nama_produk'); ?>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="userinput6">Keterangan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" value="<?= old('keterangan'); ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('keterangan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userinput6">Harga</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('harga'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userinput6">Jumlah</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('jumlah'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions right">
                                <a href="/c_produk" class="btn btn-warning"><i class="icon-cross2"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check2"></i> Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>