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
            <h6 class="m-0 font-weight-bold text-primary">Setting Menu Role</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="" class="btn btn-primary btn-small mb-3" data-toggle="modal" data-target="#newRoleModal">
                        <i class="fas fa-plus"></i>&nbsp;Add New Role </a>
                    <?= form_error(
                        'menu',
                        '<div class="alert alert-danger" role="alert"> (Menu Role Tidak Bisa Di Tambahkan) / ',
                        '</div>'
                    ); ?>

                    <?= $this->session->flashdata('message'); ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>

                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($role as $r) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <?= $r['role']; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>"
                                        class="badge badge-warning">Access</a>
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
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add Role</h5>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="formGroupExampleInput" id="role" name="role"
                            placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">add</button>
                </div>
            </form>
        </div>
    </div>
</div>