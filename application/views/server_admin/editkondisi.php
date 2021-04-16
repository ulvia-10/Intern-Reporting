<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">EDIT DATA </h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i>EDIT DATA LAPORAN</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">


                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                    <?php endif ?>

                    <?php echo $this->session->flashdata('flash-data') ?>
                    <form action="" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_lapor" value="<?= $lapor['id_lapor']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Lapor </label>
                            <input type="text" class="form-control" id="nama_lapor" name="nama_lapor"
                                value="<?= $lapor['nama_lapor']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul </label>

                            <input type="text" class="form-control" id="judul" name="judul"
                                value="<?php echo $lapor['judul'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_kategori">Pilih Kategori</label>
                            <select name="nama_kategori" class="form-control" id="nama_kategori">
                                <?php if ($dataCategory->num_rows() > 0) {

                                    foreach ($dataCategory->result() as $rowCategory) {

                                        $status_selected = '';
                                        if ($rowCategory->id_kategori == $lapor['id_kategori']) {

                                            $status_selected = 'selected="selected"';
                                        }

                                        echo '<option value="' . $rowCategory->id_kategori . '" ' . $status_selected . '>' . ucfirst($rowCategory->nama_kategori) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Pilih Kecamatan</label>
                            <select class="form-control" id="kecamatan" name="kecamatan">

                                <option value="Lowokwaru"
                                    <?php if ($lapor['kecamatan'] == "Lowokwaru") echo 'selected="selected"'; ?>>
                                    Lowokwaru</option>
                                <option value="Kedungkandang"
                                    <?php if ($lapor['kecamatan'] == "Kedungkandang") echo 'selected="selected"'; ?>>
                                    Kedungkandang</option>
                                <option value="Blimbing"
                                    <?php if ($lapor['kecamatan'] == "Blimbing") echo 'selected="selected"'; ?>>
                                    Blimbing</option>
                                <option value="Klojen"
                                    <?php if ($lapor['kecamatan'] == "Klojen") echo 'selected="selected"'; ?>>
                                    Klojen</option>
                                <option value="Sukun"
                                    <?php if ($lapor['kecamatan'] == "Sukun") echo 'selected="selected"'; ?>>
                                    Sukun</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status_lapor">Status</label>
                            <select class="form-control" id="status_lapor" name="status_lapor">

                                <option value="diperiksa"
                                    <?php if ($lapor['status_lapor'] == "diperiksa") echo 'selected="selected"'; ?>>
                                    diperiksa</option>
                                <option value="disetujui"
                                    <?php if ($lapor['status_lapor'] == "disetujui") echo 'selected="selected"'; ?>>
                                    disetujui</option>
                                <option value="ditolak"
                                    <?php if ($lapor['status_lapor'] == "ditolak") echo 'selected="selected"'; ?>>
                                    ditolak</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tgl_tragedi">Tanggal Tragedi</label>
                            <input type="date" class="form-control" id="tgl_tragedi" name="tgl_tragedi"
                                value="<?= date('Y-m-d', strtotime($lapor['tgl_tragedi'])); ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?= $lapor['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?= $lapor['keterangan']; ?></textarea>
                        </div>


                        <div class="row">
                            <div class="col-md-4" style="border-right: 1px solid #e0e0e0">
                                <!-- Element Files -->
                                <div class="form-group">
                                    <label for="">Tambah Gambar</label>
                                    <input type="file" name="foto_tragedi" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-8">

                                <h5>Galeri Foto</h5>

                                <table class="table" style="font-size: 12px">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama File</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php

                                    $data_foto = array();
                                    if ($lapor['foto_tragedi']) { // dia ada fotonya ?

                                        $data_foto = explode(',', $lapor['foto_tragedi']);
                                    }

                                    if (count($data_foto) > 0) {
                                        $nomor = 0;
                                        foreach ($data_foto as $foto) {

                                            $link = base_url('C_data/onRemovePhotoTragedi?id_lapor=' . $lapor['id_lapor'] . '&index=' . $nomor);
                                    ?>
                                    <tr>
                                        <td><?php echo ($nomor + 1) ?></td>
                                        <td>
                                            <a target="_blank"
                                                href="<?php echo base_url('assets/images/' . $foto) ?>"><?php echo $foto ?></a>
                                        </td>
                                        <td><a href="<?php echo $link ?>"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus foto <?php echo $foto ?>')"><i
                                                    class="fa fa-trash"></i></a></td>
                                    </tr>

                                    <?php $nomor++;
                                        }
                                    } else echo '<tr><td colspan="2" align="center">Tidak memiliki foto</td></tr>'; ?>
                                </table>
                            </div>
                        </div>


                        <button type="submit" name="edit" class="btn btn-primary float-right"> <i
                                class="fas fa-edit"></i> Edit</button>
                    </form>



                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->