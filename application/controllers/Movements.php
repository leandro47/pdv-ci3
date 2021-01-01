<?php
defined('BASEPATH') or exit('URL inválida.');

class Movements extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Stock_Model', 'stock');
        $this->load->model('User_Model', 'user');

        $this->data['page'] = 'Movimentos';
        $this->data['user'] = $this->session->name;

        if (!$this->session->has_userdata('name'))
            redirect('User');

        $idModule = 3;
        if (!$this->user->getPermission($this->session->id, $idModule)) {

            $this->data['page'] = 'home';
            $this->data['message'] = 'Ops! Você não tem permissão para acessar esse módulo';
            $this->data['statusMessage'] = 'warning';

            $this->load->view('application/home', $this->data);
        }
    }

    public function index()
    {
        $this->data['datatable'] = $this->stock->getAllMovements();
        $this->load->view('application/movements', $this->data);
    }
}
