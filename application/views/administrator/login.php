<!-- HK Wrapper -->
<div class="hk-wrapper">

    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 pa-0">
                    <div class="auth-form-wrap pt-xl-0 pt-70">
                        <div class="auth-form w-xl-55 w-lg-55 w-sm-75 w-100">
                            <form action="<?= base_url('Administrator'); ?>" method="POST">
                                <div class="col-12">
                                    <h1 class=" text-center mb-10 font-weight-bold text-light-70 ">Welcome Administrator</h1>
                                </div>
                                <h1 class=" text-center mb-10 font-weight-bold text-light-70 ">Portal Berita UBSI</h1>
                                <h5 class="text-center mb-30 mt-25 text-light-70 "> - WEB PROGRAMMING III - </h5>
                                <div class="w-xl-55 mx-auto">
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <div class="form-group">
                                        <input class="form-control form-control-lg" name="email" placeholder="Email" type="email">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input class=" form-control form-control-lg" placeholder="Password" name="password" type="password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button class="btn btn-info btn-block" type="submit">Login</button>
                                    <p class="font-14 text-center mt-20 font-weight-bold">2020 &copy; Portal Berita WP-3 </p>
                                    <p class="font-10 text-center mt-20 font-weight-bold">Muhammad Akbar </p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->