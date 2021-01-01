<?php
defined('BASEPATH') or exit('URL inválida.');
?>
<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/menu') ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estoque</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Estoque</li>
        </ol>
    </div>


    <div class="row">
        <div class="form-group col-lg-12">
            <button type="button" id="btnNew" class="btn button" data-toggle="modal" data-target="#modalCadastrar"> <i class="fa fa-plus"></i> Adicionar</button>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover table-condensed table-bordered table-striped table-sm" id="tableStock" width="100%">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th> Marca</th>
                            <th> Modelo </th>
                            <th> Numeração </th>
                            <th> Codigo de Barra </th>
                            <th> # </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--  modal cadastrar product -->
    <div class="modal fade" id="modalCadastrar" tabindex="-1" aria-labelledby="modalCadastrarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-barcode"></i> &nbsp; Cadastrar Produto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Inicio do formulario  -->
                    <form action="" id="saveProduct" method="POST" class="form" role="form">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="insert_marca" class="control-label"> Marca <span> <strong>*</strong></span></label>
                                    <input type="text" class="form-control" id="insert_marca" name="insert_marca" placeholder="Ex: Adidas" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="insert_model" class="control-label"> Modelo <span> <strong>*</strong></span></label>
                                    <input type="text" class="form-control" id="insert_model" name="insert_model" placeholder="Ex: Superstar" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="insert_number" class="control-label"> Número <span> <strong>*</strong></span></label>
                                    <input type="number" class="form-control" id="insert_number" name="insert_number" placeholder="Ex: 38" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="insert_codeBar" class="control-label"> Código de barra <span> <strong>*</strong></span></label>
                                    <input type="text" class="form-control" id="insert_codeBar" name="insert_codeBar" placeholder="Ex: 000000000000000001" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" id="btnSave" class="btn button"> <i class="fa fa-save"></i> Gravar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </form>
                    <!-- final formulario  -->
                </div>
            </div>
        </div>
    </div>
    <!-- final modal cadastrar  -->

    <!-- Modal atualizar product  -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-barcode"></i> &nbsp; Atualizar produto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Inicio do formulario  -->
                    <form action="" id="updateProduct" method="POST" class="form" role="form">
                        <div class="row">
                            <input type="hidden" class="form-control" id="idUpdate" name="idUpdate" value="">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="update_marca" class="control-label"> Marca <span> <strong>*</strong></span></label>
                                    <input type="text" class="form-control" id="update_marca" name="update_marca" placeholder="Ex: Adidas" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="update_model" class="control-label"> Modelo <span> <strong>*</strong></span></label>
                                    <input type="text" class="form-control" id="update_model" name="update_model" placeholder="Ex: Superstar" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="update_number" class="control-label"> Número <span> <strong>*</strong></span></label>
                                    <input type="number" class="form-control" id="update_number" name="update_number" placeholder="Ex: 38" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="update_codeBar" class="control-label"> Código de barra <span> <strong>*</strong></span></label>
                                    <input type="text" class="form-control" disabled id="update_codeBar" name="update_codeBar" placeholder="Ex: 000000000000000001" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" id="btnUpdate" class="btn button"> <i class="fa fa-save"></i> Gravar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </form>
                    <!-- final formulario  -->
                </div>
            </div>
        </div>
    </div>
    <!-- final modal de atualizar  -->

    <!-- Modal deletar product  -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-question"></i></i> &nbsp; Deletar Produto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Inicio do formulario  -->
                    <form action="" id="deleteproduct" method="POST" class="form" role="form">
                        <div class="row">
                            <input type="hidden" class="form-control" id="idDelete" name="idDelete" value="">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    Deseja realmente excluir o <b id="productBrand"></b> do modelo <b id="productModel"></b>?
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" id="btnDelete" class="btn button"> <i class="fas fa-check"></i> Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </form>
                    <!-- final formulario  -->
                </div>
            </div>
        </div>
    </div>
    <!-- Final modal deletar  -->
</div>
<!---Container Fluid-->

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/scripts') ?>
</body>
<script>
    $(document).ready(() => {
        requestProducts()
    })

    const strPad = (input, padString = "0") => {
        return ("0000000000000" + input).slice(13)
    }

    // Salva products no banco 
    $(document).ready(function() {
        $('#saveProduct').submit(function() {
            var dados = $(this).serialize();
            $.ajax({
                type: "POST",
                url: `${BASE_URL}stock/insertProduct`,
                data: dados,
                success: function(data) {

                    if (data.code === 200) {

                        $('#modalCadastrar').modal('hide');
                        $('#insert_marca').val('');
                        $('#insert_model').val('');
                        $('#insert_number').val('');
                        $('#insert_codeBar').val('');

                        toastr["success"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        requestProducts();

                    } else if (data.code === 500) {

                        toastr["error"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        requestProducts();


                    } else if (data.code === 300) {

                        toastr["warning"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    } else {
                        toastr["error"]("Verifique o console para mais detalhes", "Aconteceu um erro desconhecido! ")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        console.log(data);
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
            return false;
        });
    });

    // Edita products no banco
    const updateProduct = (id, brand, model, number, codeBar) => {

        $('#idUpdate').val(id);
        $('#update_marca').val(brand);
        $('#update_model').val(model);
        $('#update_number').val(number);
        $('#update_codeBar').val(String(codeBar).slice(2));

        $('#modalUpdate').modal('show');

        $('#updateProduct').submit(function() {
            var dados = $(this).serialize();
            $.ajax({
                type: "POST",
                url: `${BASE_URL}stock/updateProduct`,
                data: dados,
                success: function(data) {
                    if (data.code === 200) {

                        $('#modalUpdate').modal('hide');
                        
                        $('#insert_marca').val('');
                        $('#insert_model').val('');
                        $('#insert_number').val('');
                        $('#insert_codeBar').val('');

                        toastr["success"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        requestProducts();

                    } else if (data.code === 500) {

                        toastr["error"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        requestProducts();


                    } else if (data.code === 300) {

                        toastr["warning"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    } else {
                        toastr["error"]("Verifique o console para mais detalhes", "Aconteceu um erro desconhecido! ")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        console.log(data);
                    }


                },
                error: function(data) {
                    console.log(data);
                }
            });
            return false;
        });
    }

    //Deleta um produto
    const deleteproduct = (id, brand, model, number, codeBar) => {
        $('#idDelete').val(id);
        $('#productBrand').html(brand);
        $('#productModel').html(model);

        $('#modalDelete').modal('show');

        $('#deleteproduct').submit(function() {
            var dados = $(this).serialize();
            $.ajax({
                type: "POST",
                url: `${BASE_URL}stock/deleteProduct`,
                data: dados,
                success: function(data) {

                    $('#modalDelete').modal('hide');
                    if (data.code === 200) {

                        $('#modalCadastrar').modal('hide');
                        $('#insert_marca').val('');
                        $('#insert_model').val('');
                        $('#insert_number').val('');
                        $('#insert_codeBar').val('');

                        toastr["success"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        requestProducts();

                    } else if (data.code === 500) {

                        toastr["error"](data.message)

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        requestProducts();


                    } else {

                        toastr["danger"]('Aconteceu um erro desconhecido, verifique o console para mais detalhes!')

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        requestProducts();
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
            return false;
        });
    }

    // Busca no banco todas as products
    let tableStock

    function requestProducts() {
        tableStock = $(`#tableStock`).DataTable({
            sPaginationType: "full_numbers",
            destroy: true,
            responsive: false,
            ajax: {
                url: `${BASE_URL}stock/show`,
                dataType: "json",
                cache: false,
                dataSrc: (data) => {
                    return data || []
                },
                error: (e) => {
                    $("#btnNew").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
                },
                beforeSend: () => {
                    $("#btnNew").attr("disabled", true).find("i").removeClass("fa-plus").addClass("fa-spinner fa-spin")
                },
                complete: () => {
                    $("#btnNew").removeAttr("disabled").find("i").removeClass("fa-spinner fa-spin").addClass("fa-plus")
                }
            },
            order: [
                [0, 'desc']
            ],
            columns: [{
                    data: "id",
                    class: "text-right",
                },
                {
                    data: "brand",
                    class: "text-left text-uppercase",
                },
                {
                    data: "model",
                    class: "text-left text-uppercase",
                },
                {
                    data: "number",
                    class: "text-left text-uppercase",
                },
                {
                    data: "barCode",
                    class: "text-left text-uppercase",
                    render: function(data, type, row, meta) {

                        return String(data).slice(2);
                    }
                },
                {
                    orderable: false,
                    data: null,
                    defaultContent: ``,
                    render: function(data, type, row, meta) {
                        return `
						<a href="#" type="button" title="Editar" class="badge button" id="editar" style="color: #fff" onclick="updateProduct('${data.id}','${data.brand}','${data.model}','${data.number}','${data.barCode}')">EDITAR</a>
						<a href="#" type="button" title="Excluir" class="badge badge-danger" id="excluir" style="color: #fff" onclick="deleteproduct('${data.id}','${data.brand}','${data.model}','${data.number}','${data.barCode}')">EXCLUIR</a>`
                    }
                }
            ]
        })
    }
</script>

</html>