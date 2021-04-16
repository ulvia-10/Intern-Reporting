<body class="bg-gradient-primary1">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-15 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">LOGIN PAGE</h1>
                                        <img src="<?= base_url('assets/img/bakesbangpol.png'); ?>"
                                            alt="gambar bakesbangpol" style="width: 27%; border-radius: 50%;" />
                                    </div><br>

                                    <?= $this->session->flashdata('message'); ?>

                                    <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email"
                                                name="email" placeholder="Enter Email Address..."
                                                value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Enter Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <p>OR</p>
                                    </div>
                                    <div class="text-center">
                                        <a href="<?= base_url('auth/registration'); ?>"
                                            class="btn azm-social azm-size-64 azm-circle azm-long-shadow  azm-google-plus"><i
                                                class="fas fa-registered"></i></a>
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

        </div>

    </div>