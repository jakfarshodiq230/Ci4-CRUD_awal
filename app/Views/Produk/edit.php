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
                    <h4 class="card-title" id="basic-layout-colored-form-control">Edit Produk</h4>
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
                        <form class="form" action="/c_produk/update/<?= $komik['id']; ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id" value="<?= $komik['id']; ?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="userinput2">Nama</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" autofocus value="<?= $komik['nama_produk']; ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('nama_produk'); ?>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="userinput6">Keterangan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" value="<?= $komik['keterangan']; ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('keterangan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userinput6">Harga</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= $komik['harga']; ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('harga'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userinput6">Jumlah</label>
                                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= $komik['jumlah']; ?>">
                                    <div class="invalid-tooltip" style="color:red;">
                                        <?= $validation->getError('jumlah'); ?>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions right">
                                <a href="/c_produk" class="btn btn-warning"><i class="icon-undo"></i> Kembali</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">
                                    Update
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Edit Data</h5>
                                        </div>
                                        <div class="modal-body" style="text-align: center;">
                                            Apakah Anda ingin Mengedit Data <b><?= $komik['id']; ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary">
                                                <i class="icon-download3"></i> Simpan</button>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>/c_pengguna/get_kabupaten",
                method: "POST",
                data: {
                    id: id
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                    }
                    $('#kabupaten').html(html);

                }
            });
        });
        $('#kabupaten').change(function() {
            var id_kecamatan = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>/c_pengguna/get_kecamatan",
                method: "POST",
                data: {
                    id_kecamatan: id_kecamatan
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                    }
                    $('#kecamatan').html(html);

                }
            });
        });
        $('#kecamatan').change(function() {
            var id_kelurahan = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>/c_pengguna/get_kelurahan",
                method: "POST",
                data: {
                    id_kelurahan: id_kelurahan
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].nama + '</option>';
                    }
                    $('#kelurahan').html(html);

                }
            });
        });
    });
</script>
<?= $this->endSection('content'); ?>