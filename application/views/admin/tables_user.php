<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data User</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Info Data User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style=" text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Telephon</th>
                                <th>Gender</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style=" text-align:center;">
                            <?php $no = 1;
                            foreach ($user->result_array() as $usr) { ?>
                            <tr>
                                <td> <?= $no++; ?></td>
                                <td><?= $usr["username"]; ?></td>
                                <td><?= $usr["nama_lengkap"]; ?></td>
                                <td><?= $usr["email"]; ?></td>
                                <td><?= $usr["no_telp"] ?></td>
                                <td><?= $usr["jenis_kelamin"]; ?></td>
                                <td><?= $usr["is_active"]; ?></td>
                                <td> <a href="<?= base_url(); ?>Data_admin/hapususer/<?= $usr['id_user']; ?>"
                                        class="badge badge-danger "> <i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                                <?php
                            }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->