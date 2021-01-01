<?php
defined('BASEPATH') or exit('URL inválida.');
?>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar menu-diagonal accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('welcome') ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('assets/img/logo/logo.png') ?>">
                </div>
                <div class="mx-3 text-white">Help Sales</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link menu-link" href="<?= site_url('welcome') ?>">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Módulos
            </div>
            <li class="nav-item">
                <a class="nav-link menu-link" href="<?= site_url('stock') ?>">
                    <i class="fas fa-boxes"></i>
                    <span>Estoque</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="<?= site_url('sale') ?>">
                    <i class="fas fa-store"></i>
                    <span>Realizar Venda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="<?= site_url('movements') ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Movimentações</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Informação
            </div>
            <li class="nav-item">
                <a class="nav-link menu-link" href="<?= site_url('dashboardstock') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>DashBoard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand menu-vertical topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/boy.png') ?>" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small menu-link"><?= $user ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelLogout">Ops!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Deseja realmente sair?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Não</button>
                                <a href="<?= site_url('user/logout') ?>" class="btn button">Sim</a>
                            </div>
                        </div>
                    </div>
                </div>