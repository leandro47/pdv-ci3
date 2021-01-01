<?php
defined('BASEPATH') or exit('URL inválida.');
?>
<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/menu') ?>

<!-- Container Fluid-->
<div class="container-fluid " id="container-wrapper">
    <h1>Inicio</h1>


    <div class="d-flex justify-content-center bd-highlight">
        <div class="p-2 bd-highlight">
            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-3 ">
                    <a href="<?= site_url('stock') ?>">
                        <div class="card bg-light mb-3 card-menu" style="max-width: 100%;">
                            <div class="card-body text-center">
                                <span style="font-size: 48px; color: #213e3b;">
                                    <i class="fas fa-boxes"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-3 ">
                    <a href="<?= site_url('sale') ?>">
                        <div class="card bg-light mb-3 card-menu" style="max-width: 100%;">
                            <div class="card-body text-center">
                                <span style="font-size: 48px; color: #213e3b;">
                                    <i class="fas fa-store"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-3 ">
                    <a href="<?= site_url('movements') ?>">
                        <div class="card bg-light mb-3 card-menu" style="max-width: 100%;">
                            <div class="card-body text-center">
                                <span style="font-size: 48px; color: #213e3b;">
                                    <i class="fas fa-clipboard-list"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-3 ">
                    <a href="<?= site_url('dashboardstock') ?>">
                        <div class="card bg-light mb-3 card-menu" style="max-width: 100%;">
                            <div class="card-body text-center">
                                <span style="font-size: 48px; color: #213e3b;">
                                    <i class="fas fa-tachometer-alt"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php if (isset($message)) : ?>
                <div class="col-sm-12 col-md-6 col-lg-12 ">
                    <div class="alert alert-<?= $statusMessage ?> alert-dismissible fade show text-center" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-12 text-center">
                    <img class="img-fluid" alt="Responsive image" style="padding: 50px; max-height: 60vh" src="<?= base_url('assets/img/home.svg') ?>" alt="">
                </div>
            </div>

        </div>
    </div>


</div>
<!---Container Fluid-->

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/scripts') ?>
</body>

</html>