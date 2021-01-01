<?php
defined('BASEPATH') or exit('URL inválida.');
?>
<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/menu') ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Movimentações</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Movimentações</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover table-condensed table-bordered table-striped table-sm" id="tableMovements" width="100%">
                    <thead>
                        <tr>
                            <th> Marca</th>
                            <th> Modelo</th>
                            <th> Número </th>
                            <th> Codigo Barra </th>
                            <th> Usuario </th>
                            <th> Tipo </th>
                            <th> Data </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datatable as $row) : ?>
                        <tr>
                            <td class="text-uppercase"><?= $row['brand'] ?></td>
                            <td class="text-uppercase"><?= $row['model'] ?></td>
                            <td class="text-uppercase"><?= $row['number'] ?></td>
                            <td class="text-uppercase"><?= str_replace('BR', '', $row['barCode']) ?></td>
                            <td class="text-uppercase"><?= $row['name'] ?></td>

                            <?php if($row['type'] === 'E'): ?>
                                <td class="text-uppercase text-danger"><i class="far fa-arrow-alt-circle-down"></i>  <?= "Entrada" ?> </td>
                            <?php else: ?>
                                <td class="text-uppercase text-success"><i class="far fa-arrow-alt-circle-up"></i>  <?= "Saida" ?> </td>

                            <?php endif; ?>
                            <td><?= $row['date'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!---Container Fluid-->

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/scripts') ?>
</body>
<script>
    $(document).ready(function() {
        $('#tableMovements').DataTable();
    });
</script>

</html>