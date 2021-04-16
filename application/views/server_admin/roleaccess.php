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

                    <?= $this->session->flashdata('message'); ?>

                    <h5>Role <?= $role['role']; ?></h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Access</th>

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
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>"
                                            data-menu="<?= $m['id']; ?>">

                                    </div>
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