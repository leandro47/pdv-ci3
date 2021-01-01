<?php
defined('BASEPATH') or exit('URL inválida.');

class Sale extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Sale_Model', 'sale');
        $this->load->model('User_Model', 'user');
        $this->load->model('Stock_Model', 'stock');

        $this->data['page'] = 'Realizar Venda';
        $this->data['user'] = $this->session->name;

        if (!$this->session->has_userdata('name')) {
            redirect('User');
        }

        $idModule = 2;
        if (!$this->user->getPermission($this->session->id, $idModule)) {

            $this->data['page'] = 'home';
            $this->data['message'] = 'Ops! Você não tem permissão para acessar esse módulo';
            $this->data['statusMessage'] = 'warning';

            $this->load->view('application/home', $this->data);
        }
    }

    // ==================================================
    public function index()
    {
        $this->load->view('application/sale', $this->data);
    }

    // ==================================================
    public function movement()
    {
        if ($this->input->post()) {

            if ($this->input->post('idProduct', true) != '0') {
                $arrMovements = [
                    'id_product' => $this->input->post('idProduct', true),
                    'id_user' => $this->session->id,
                    'type' => 'S'
                ];
                //Update table of stocks
                if ($this->stock->updateStatus($this->input->post('idProduct', true)) && $this->stock->InsertMovements($arrMovements)) {


                    $this->data['message'] = 'Venda realizada com sucesso';
                    $this->data['statusMessage'] = 'success';

                    $this->load->view('application/sale', $this->data);
                } else {

                    $this->data['message'] = 'Algo deu errado, nenhum registro foi alterado';
                    $this->data['statusMessage'] = 'danger';

                    $this->load->view('application/sale', $this->data);
                }
            } else {
                
                $this->data['message'] = 'Ops! Primeiro me diga qual produto deseja movimentar';
                $this->data['statusMessage'] = 'warning';

                $this->load->view('application/sale', $this->data);
            }
        }
    }

    // ==================================================
    public function getProduct()
    {
        if ($this->input->post()) {

            $result = $this->stock->getProduct(formatCodeBar($this->input->post('text_codeBar', true)));

            if ($result) {

                $this->data['idProduto'] = $result->id;
                $this->data['marca'] = $result->brand;
                $this->data['modelo'] = $result->model;
                $this->data['numero'] = $result->number;
            } else {
                $this->data['message'] = 'Produto não encontrado!';
                $this->data['statusMessage'] = 'danger';
            }

            $this->load->view('application/sale', $this->data);
        }
    }
}
