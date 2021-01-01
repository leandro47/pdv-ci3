<?php
defined('BASEPATH') or exit('URL inválida.');

class DashBoardStock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Stock_Model', 'stock');
        $this->load->model('User_Model', 'user');

        $this->data['page'] = 'DashBoard | Estoque';
        $this->data['user'] = $this->session->name;

        if (!$this->session->has_userdata('name'))
            redirect('User');

        $idModule = 4;
        if (!$this->user->getPermission($this->session->id, $idModule)) {

            $this->data['page'] = 'home';
            $this->data['message'] = 'Ops! Você não tem permissão para acessar esse módulo';
            $this->data['statusMessage'] = 'warning';

            $this->load->view('application/home', $this->data);
        }
    }

    public function index()
    {
        $this->load->view('application/dashBoardStock', $this->data);
    }

    public function getAll()
    {
        $response = [
            'saidasHoje' => $this->stock->getSaidas([date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')]),
            'saidasMes' => $this->stock->getSaidas([date('Y-m-1 00:00:00'), date('Y-m-t 23:59:59')]),
            'saidasAno' => $this->stock->getSaidas([date('Y-01-1 00:00:00'), date('Y-12-t 23:59:59')]),
            'saidasTotal' => $this->stock->getSaidas([date('2020-01-1 00:00:00'), date('2050-12-t 23:59:59')]),
            'graficoTotal' => $this->stock->chartsTotalGeral([date('2020-01-1 00:00:00'), date('2050-12-t 23:59:59')]),
            'graficoSaidaMensal' => iterarArrayMensal($this->stock->movimentacaoAgrupadoMes()),
            'graficoSaidaDiaria' => iterarArrayDiaria($this->stock->movimentacaoAgrupadoDia([date('Y-m-1 00:00:00'), date('Y-m-t 23:59:59')]))
        ];
        response($response);
    }
}
