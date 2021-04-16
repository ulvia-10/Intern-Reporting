<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Setting Menu</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="" class="btn btn-primary btn-small mb-3" data-toggle="modal" data-target="#newMenuModal">
                        <i class="fas fa-plus"></i>&nbsp;Add new menu </a>
                    <?= form_error(
                        'menu',
                        '<div class="alert alert-danger" role="alert"> (Menu Tidak Bisa Di Tambahkan) / ',
                        '</div>'
                    ); ?>

                    <?= $this->session->flashdata('message'); ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <?= $m['menu']; ?>
                                </td>
                                <td>
                                    <a href="" class="badge badge-danger">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End tabel -->
        </div>
    </div>
    <!-- End form tabel -->

</div>
</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('Setting') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="formGroupExampleInput" id="menu" name="menu"
                            placeholder="Menu Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">add</button>
                </div>
            </form>
        </div>
    </div>
</div>