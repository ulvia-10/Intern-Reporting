<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
        </div>
        <div class="card-body">

            <?= form_open_multipart('Profile/edit'); ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $adm['email']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Fullname</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                    value="<?= $adm['nama_lengkap']; ?>">
                <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $adm['username']; ?>">
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telp" name="no_telp" value="<?= $adm['no_telp']; ?>">
                <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

            <div class="mb-3">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile1/') . $adm['foto']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Upload</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>

            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->