<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Laporan</h1>

        <!-- DataTales Example data kondisi wilayah -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Info Data Laporan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style=" text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Kecamatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style=" text-align:center;">
                            <?php $no = 1;
                            foreach ($lapor->result_array() as $lpr) { ?>
                            <tr>
                                <td> <?= $no++; ?></td>
                                <td><?= $lpr["nama_lapor"]; ?></td>
                                <td><?= $lpr["tgl_tragedi"]; ?></td>
                                <td><?= $lpr["nama_kategori"]; ?></td>
                                <td><?= $lpr["kecamatan"] ?></td>
                                </td>
                                <td>
                                    <!-- detail -->
                                    <a href="<?= base_url(); ?>Data/detail/<?= $lpr['id_lapor']; ?>"
                                        class="badge badge-primary"> <i class="fa fa-eye"
                                            aria-hidden="true"></i></a></a>
                                </td>
                                </td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->