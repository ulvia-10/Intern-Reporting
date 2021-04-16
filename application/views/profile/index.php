<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
        </div>
        <div class="card-body">

            <div class="card mb-3 col-lg-8">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/profile1/' . $adm['foto']); ?>" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $adm['nama_lengkap']; ?></h5>
                            <p class="card-text"><?= $adm['username']; ?></p>
                            <p class="card-text"><?= $adm['email']; ?></p>
                            <p class="card-text"><?= $adm['no_telp']; ?></p>
                            <p class="card-text"><small class="text-muted">Admin Since
                                    <?= date('d F Y', $adm['date_created']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->