<?php
defined('BASEPATH') or exit('URL inválida.');
?>
<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/menu') ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Realizar Venda</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Realizar Venda</li>
        </ol>
    </div>

    <div class="shadow-sm p-3 pt-5 pb-5 mb-5 bg-white rounded">
        <!-- digita codigo barra  -->
        <?php echo form_open('sale/getProduct'); ?>
        <div class="row justify-content-md-center">
            <div class="col col-sm-12 col-md-12 col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-dark" id="basic-addon1">Codigo de Barra:</span>
                    </div>
                    <input type="text" name="text_codeBar" class="form-control" required placeholder="ex : 0000000000000000000001">
                </div>
            </div>
            <div class="col col-sm-12 col-md-2 col-lg-2">
                <button type="submit" class="btn button btn-block"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
        <!-- Exibi os valores na tela  -->

        <div class="row justify-content-md-center mt-4">
            <div class="col col-sm-12 col-md-12 col-lg-8">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 33%;">Marca</th>
                            <th scope="col" style="width: 33%;">Modelo</th>
                            <th scope="col" style="width: 33%;">Numeração</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if (isset($marca)) : ?>

                            <td class="h3 text-uppercase"><?= $marca ?></td>
                            <td class="h3 text-uppercase"><?= $modelo ?></td>
                            <td class="h3 text-uppercase"><?= $numero ?></td>

                            <?php else : ?>

                            <td class="h3 text-uppercase">-</td>
                            <td class="h3 text-uppercase">-</td>
                            <td class="h3 text-uppercase">-</td>

                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php echo form_open('sale/movement'); ?>
        <div class="row justify-content-md-center mt-4">
            <!-- Input que salva o valor do codigo de barra  -->
            <?php if (isset($idProduto)) : ?>

            <input type="hidden" class="form-control" id="idProduct" name="idProduct" value="<?= $idProduto ?>">

            <?php else : ?>

            <input type="hidden" class="form-control" id="idProduct" name="idProduct" value="0">

            <?php endif; ?>
            <!-- Buttons list  -->
            <div class="col col-sm-12 col-md-12 col-lg-8 text-right">
                <a class="btn btn-secondary" href="<?= site_url('sale') ?>" role="button">Cancelar</a>
                <button type="submit" class="btn btn-success btn-lg">Finalizar</button>

                <?php if (isset($message)) : ?>
                <div class="mt-5">
                    <div class="alert alert-<?= $statusMessage ?> text-center alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
            </div>


        </div>
        <?php echo form_close(); ?>

    </div>
</div>
<!---Container Fluid-->

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/scripts') ?>
</body>

</html>