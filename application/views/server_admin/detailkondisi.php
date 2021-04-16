<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Detail Laporan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Info Data Laporan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><strong><?= $lapor['nama_lapor']; ?></strong></h5>
                        </center>
                        <?php
                        $src = 'https://pertaniansehat.com/v01/wp-content/uploads/2015/08/default-placeholder.png';

                        if ($lapor['foto_tragedi']) {

                            $src = "";
                            $checkDataPhoto = explode(',', $lapor['foto_tragedi']);

                            // apakah gambar tsb lebih dari 1 ?
                            if (count($checkDataPhoto) > 1) {

                                foreach ($checkDataPhoto as $rowPhoto) {

                                    echo '<img src="' . base_url('assets/images/' . $rowPhoto) . '" style="width: 100px"> <hr>';
                                }
                            } else { // gambar hanya 1

                                echo '<img src="' . base_url('assets/images/' . $lapor['foto_tragedi']) . '" style="width: 100px">';
                            }
                        }

                        ?>


                        <p class="card-text">
                            <label for="nama_lapor"><b> Nama Lapor: </b></label>
                            <?= $lapor['nama_lapor']; ?>
                        </p>
                        <p class="card-text">
                            <label for="judul"><b> Judul: </b></label>
                            <?= $lapor['judul']; ?>
                        </p>
                        <p class="card-number">
                            <label for="nama_kategori"><b> Kategori : </b></label>
                            <?= $lapor['nama_kategori']; ?>
                        </p>
                        <p class="card-text">
                            <label for="kecamatan"><b> Kecamatan : </b></label>
                            <?= $lapor['kecamatan']; ?>
                        </p>
                        <p class="card-text">
                            <label for="tgl_tragedi"><b> Tanggal Tragedi: </b></label>

                            <?php

                            $dayOfName = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                            $requestDay = date('N', strtotime($lapor['tgl_tragedi']));
                            ?>
                            <?= @$dayOfName[$requestDay] . ' ' . date('d F Y H.i A', strtotime($lapor['tgl_tragedi'])); ?>
                        </p>
                        <p class="card-text">
                            <label for="alamat"><b> Alamat : </b></label>
                            <?= $lapor['alamat']; ?>
                        </p>
                        <p class="card-text">
                            <label for="keterangan"><b> Keterangan : </b></label>
                            <?= $lapor['keterangan']; ?>
                        </p>
                        <p class="card-text">
                            <label for="created_at"><b> tanggal update : </b></label>
                            <?= $lapor['created_at']; ?>
                        </p>

                        <a href="<?= base_url(); ?>C_data/index/" class="btn btn-primary"> Kembali</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->