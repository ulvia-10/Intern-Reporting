<body class="bg-gradient-primary1">

    <!-- ======= Loader ======= -->
    <div class="loader-container">
        <div class="loader"></div>
    </div>

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="<?= base_url('auth/registration'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama_lengkap"
                                        name="nama_lengkap" placeholder="Full Name...."
                                        value="<?= set_value('nama_lengkap'); ?>">
                                    <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username"
                                        name="username" placeholder="Name...." value="<?= set_value('username'); ?>">
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="gridRadios1" value="L" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="gridRadios2" value="P">
                                            <label class="form-check-label" for="gridRadios2">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="no_telp"
                                        name="no_telp" placeholder="Phone Number...."
                                        value="<?= set_value('no_telp'); ?>">
                                    <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address..." value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1"
                                            name="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2"
                                            name="password2" placeholder="Repeat Password">

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>

                            <div class="text-center">
                                <p>OR</p>
                            </div>
                            <div class="text-center">
                                <a href="<?= base_url('auth'); ?>"
                                    class="btn azm-social azm-size-64 azm-circle azm-long-shadow azm-instagram"><i
                                        class="fas fa-sign-in-alt"></i></a>
                                <a href="<?= base_url('auth/forgetpassword'); ?>"
                                    class="btn azm-social azm-size-64 azm-circle azm-long-shadow azm-share"><i
                                        class="fas fa-key"></i></a>
                                <a href="<?= base_url('page'); ?>"
                                    class="btn azm-social azm-size-64 azm-circle azm-long-shadow azm-soundcloud"><i
                                        class="fas fa-home"></i></a>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>