<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Kondisi Wilayah</h1>

        <!-- DataTales Example data kondisi wilayah -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Info Data Laporan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="cara body p-3">


                        <?php echo $this->session->flashdata('msg') ?>
                        <div class="card-body">
                            <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                            <?php endif ?>
                            <h5>Form Laporan</h5>


                            <form action="<?php echo site_url('C_report/tambah') ?>" method="POST"
                                enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="nama_lapor">Nama </label>
                                    <input type="text" class="form-control" name="nama_lapor" id="nama_lapor"
                                        placeholder="Masukkan nama Anda">
                                </div>
                                <div class="form-group">
                                    <label for="judul">Judul </label>
                                    <input type="text" class="form-control" name="judul" id="judul"
                                        placeholder="Masukkan judul laporan">
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Pilih Kategori </label>
                                    <select class="form-control" name="kategori" id="kategori">

                                        <?php if ($dataCategory->num_rows() > 0) {

                                            foreach ($dataCategory->result() as $rowCategory) {

                                                // metode menampilkan data antara result() vs result_array()
                                                // result(); // $rowCategory->id_category	
                                                // result_array(); // $rowCategory['id_category'];

                                                echo '<option value="' . $rowCategory->id_kategori . '">' . ucfirst($rowCategory->nama_kategori) . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="tgl_tragedi">Date</label>
                                            <input class="form-control" type="date" value="<?php echo date('Y-m-d') ?>"
                                                name="tgl_tragedi" id="tgl_tragedi">
                                            <small>Pilih tanggal</small>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="kecamatan">Pilih Kecamatan</label>
                                    <select class="form-control" id="kecamatan" name="kecamatan">
                                        <option>Lowokwaru</option>
                                        <option>Kedungkandang</option>
                                        <option>Blimbing</option>
                                        <option>Klojen</option>
                                        <option>Sukun</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Deskripsi Kejadian</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan"
                                        rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <div class="dropzone" id="dropzone">

                                        <input type="file" class="form-control" id="foto" name="foto_tragedi[]" required
                                            multiple>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-left:75%">
                                    <button type="submit" name="submit" class="btn btn-primary"> <i
                                            class="fa fa-plus-circle" aria-hidden="true"></i> Tambah dan Simpan
                                    </button>
                                </div>

                            </form>



                        </div>

                    </div>
                </div>






            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->