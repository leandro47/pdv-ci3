<?php
defined('BASEPATH') or exit('URL inválida.');
?>
<?php $this->load->view('includes/head') ?>
<?php $this->load->view('includes/menu') ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Estoque</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard Estoque</li>
        </ol>
    </div>

    <div class="container-fluid">

        <!-- Inicio dos cards  -->
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 ">
                <div class="card bg-light mb-3 border-left border-dark" style="max-width: 100%;">
                    <div class="card-header">Saídas Hoje</div>
                    <div class="card-body">
                        <h5 class="h3" id="saidasHoje">0</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card bg-light mb-3 border-left border-dark" style="max-width: 100%;">
                    <div class="card-header">Saídas Mês</div>
                    <div class="card-body">
                        <h5 class="h3" id="saidasMes">0</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card bg-light mb-3 border-left border-dark" style="max-width: 100%;">
                    <div class="card-header">Saídas Ano</div>
                    <div class="card-body">
                        <h5 class="h3" id="saidasAno">0</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card bg-light mb-3 border-left border-dark" style="max-width: 100%;">
                    <div class="card-header">Saídas Total</div>
                    <div class="card-body">
                        <h5 class="h3" id="saidasTotal">0</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- inicio dos graficos  -->
        <div class="row">

            <!-- Grafico total geral  -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Total Geral</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartTotal"></canvas>
                        </div>
                        <hr>
                        Representa o total de movimentações no seu estoque
                    </div>
                </div>
            </div>

            <!-- grafico movimentacoes mensal  -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Total por mês</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartTotalMensal"></canvas>
                        </div>
                        <hr>
                        Representa o total de movimentações no seu estoque por mês
                    </div>
                </div>
            </div>

            <!-- grafico movimentacoes diaria  -->
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">Total por dia</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="chartTotaldiaria"></canvas>
                        </div>
                        <hr>
                        Representa o total de movimentações no seu estoque por dia
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!---Container Fluid-->

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/scripts') ?>
</body>
<script>
    getAll();

    function getAll() {
        $.ajax({
                url: `${BASE_URL}DashBoardStock/getAll`,
                type: 'GET',
                dataType: "json",
                cache: false,
                beforeSend: function() {

                    $("#saidasHoje").html("Buscando...");
                    $("#saidasMes").html("Buscando...");
                    $("#saidasAno").html("Buscando...");
                    $("#saidasTotal").html("Buscando...");
                }
            })
            .done(function(data) {

                // Exibi os cards
                $("#saidasHoje").html(data['saidasHoje']['total']);
                $("#saidasMes").html(data['saidasMes']['total']);
                $("#saidasAno").html(data['saidasAno']['total']);
                $("#saidasTotal").html(data['saidasTotal']['total']);

                //Exibi os graficos 
                chartTotalGeral([data['graficoTotal'][1]['total'], data['graficoTotal'][0]['total']]);
                chartMovimentacaoMensal(data['graficoSaidaMensal']['meses'], data['graficoSaidaMensal']['entrada'], data['graficoSaidaMensal']['saida']);
                chartMovimentacaoDiaria(data['graficoSaidaDiaria']['dias'], data['graficoSaidaDiaria']['entrada'], data['graficoSaidaDiaria']['saida']);

            })
            .fail(function(jqXHR, textStatus, msg) {
                console.log(msg);
            });
    }

    //Grafico de barra total geral
    function chartTotalGeral(arrData = [0, 0]) {
        var ctx = document.getElementById("chartTotal").getContext('2d');;
        var grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Entrada', 'Saída'],
                datasets: [{
                    label: 'Total',
                    data: arrData,
                    backgroundColor: ['rgb(33,62,59)', 'rgb(65,174,169)'],
                    hoverBackgroundColor: ['rgb(33,62,59, 0.5)', 'rgb(65,174,169, 0.5)'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)"
                }],

            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 15,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 8,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {}
                }
            }
        });
    }

    //Grafico movimentações por mês
    function chartMovimentacaoMensal(arrMesses = ['Vazio'], arrEntradas = [0], arrSaidas = [0]) {
        var ctx = document.getElementById("chartTotalMensal").getContext('2d');;
        var grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: arrMesses,
                datasets: [{
                        label: 'Entrada',
                        data: arrEntradas,
                        backgroundColor: 'rgb(33,62,59)',
                        hoverBackgroundColor: 'rgb(33,62,59, 0.5)',
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                    },
                    {
                        label: 'Saída',
                        data: arrSaidas,
                        backgroundColor: 'rgb(65,174,169)',
                        hoverBackgroundColor: 'rgb(65,174,169, 0.5)',
                        hoverBorderColor: "rgba(234, 236, 244, 1)"
                    }
                ],

            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 15,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 8,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {}
                }
            }
        });
    }

    //Grafico movimentações por dia
    function chartMovimentacaoDiaria(arrDias = ['Vazio'], arrEntradas = [0], arrSaidas = [0]) {
        var ctx = document.getElementById("chartTotaldiaria").getContext('2d');;
        var grafico = new Chart(ctx, {
            type: 'line',
            data: {
                labels: arrDias,
                datasets: [{
                        label: 'Entrada',
                        data: arrEntradas,
                        lineTension: 0.3,
                        backgroundColor: "rgba(33,62,59, 0.1)",
                        borderColor: "rgba(33,62,59,1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(33,62,59, 1)",
                        pointBorderColor: "rgba(33,62,59, 1)",
                        pointHoverRadius: 1,
                        pointHoverBackgroundColor: "rgba(33,62,59, 1)",
                        pointHoverBorderColor: "rgba(33,62,59, 1)",
                        pointHitRadius: 1,
                        pointBorderWidth: 0.2,
                    },
                    {
                        label: 'Saída',
                        data: arrSaidas,
                        lineTension: 0.3,
                        backgroundColor: "rgba(65,174,169, 0.1)",
                        borderColor: "rgba(65,174,169, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(65,174,169, 1)",
                        pointBorderColor: "rgba(65,174,169, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(65,174,169, 1)",
                        pointHoverBorderColor: "rgba(65,174,169, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 0.1,
                    }
                ],

            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 15,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 8,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {}
                }
            }
        });
    }
</script>

</html>