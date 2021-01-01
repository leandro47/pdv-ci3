<?php
defined('BASEPATH') or exit('URL inválida.');

class Stock extends CI_Controller
{
    // ==================================================
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Stock_Model', 'stock');
        $this->load->model('User_Model', 'user');

        $this->data['page'] = 'Estoque';
        $this->data['user'] = $this->session->name;

        if (!$this->session->has_userdata('name'))
            redirect('User');

        $idModule = 1;
        if (!$this->user->getPermission($this->session->id, $idModule)) {

            $this->data['page'] = 'home';
            $this->data['message'] = 'Ops! Você não tem permissão para acessar esse módulo';
            $this->data['statusMessage'] = 'warning';

            $this->load->view('application/home', $this->data);
        }

        $this->data['page'] = 'Estoque';
        $this->data['user'] = $this->session->name;
    }
    // ==================================================

    public function index()
    {
        $this->load->view('application/stock', $this->data);
    }
    // ==================================================

    public function show()
    {
        $result = $this->stock->getAll();
        response($result);
    }
    // ==================================================

    public function insertProduct()
    {
        /**
         * Verifica se ja existe um registo com o mesmo codigo de barra na tabela
         */
        if (!$this->stock->getProduct(formatCodeBar($this->input->post("insert_codeBar", true)))) {

            $result = $this->stock->insertProduct($this->input->post("insert_marca", true), $this->input->post("insert_model", true), $this->input->post("insert_number", true), formatCodeBar($this->input->post("insert_codeBar", true)));

            $arrMovements = [
                'id_product' => $result,
                'id_user' => $this->session->id,
                'type' => 'E'
            ];

            if ($this->stock->insertMovements($arrMovements)) {
                response([
                    'code' => 200,
                    'message' => 'Produto inserido com sucesso!'
                ]);
            } else {
                response([
                    'code' => 500,
                    'message' => 'Aconteceu um erro ao salvar o produto, atualize a pagina e tente novamente!'
                ]);
            }
        }
        response([
            'code' => 300,
            'message' => 'Já existe um produto com esse mesmo codigo de barra'
        ]);
    }
    // ==================================================

    public function updateProduct()
    {
        if ($this->input->post()) {
            if ($this->stock->updateProduct($this->input->post("idUpdate", true), $this->input->post("update_marca", true), $this->input->post("update_model", true), $this->input->post("update_number", true))) {
                response([
                    'code' => 200,
                    'message' => 'Produto atualizado com sucesso!'
                ]);
            } else {
                response([
                    'code' => 500,
                    'message' => 'Aconteceu um erro ao atualizar o produto, atualize a pagina e tente novamente!'
                ]);
            }
        }
    }
    // ==================================================

    public function deleteProduct()
    {
        if ($this->input->post()) {
            if ($this->stock->deleteProduct($this->input->post('idDelete', true))) {

                response([
                    'code' => 200,
                    'message' => 'Excluido com sucesso!'
                ]);
            } else {
                response([
                    'code' => 500,
                    'message' => 'Aconteceu um erro ao excluir, atualize a janela e tente novamente!'
                ]);
            }
        }
    }
}
