<?php
defined('BASEPATH') or exit('URL inválida.');

class Stock_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->where('status', 'estoque');
        $query = $this->db->get('product');
        return $query->result_array();
    }

    public function insertProduct(string $marca, string $model, int $number, string $codeBar)
    {
        $data = array(
            'brand' => $marca,
            'model' => $model,
            'number' => $number,
            'barCode' => $codeBar,
            'status' => 'estoque'
        );
        $this->db->insert('product', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function updateProduct(int $id, string $marca, string $model, int $number)
    {
        $this->db->set('brand', $marca);
        $this->db->set('model', $model);
        $this->db->set('number', $number);

        $this->db->where('id', $id);
        $this->db->update('product');

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        return false;
    }
    public function deleteProduct(int $id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('product')) {
            return true;
        }
        return false;
    }

    public function getProduct(string $codebar)
    {
        $this->db->where('barCode', $codebar);
        $this->db->where('status', 'estoque');
        $query = $this->db->get('product');
        return $query->row();
    }

    /**
     * Quando faz uma venda deve atualizar o status do produto para vendido com a seguinte função
     */
    public function updateStatus(int $idProduct)
    {
        $this->db->set('status', 'vendido');
        $this->db->where('id', $idProduct);
        $this->db->update('product');

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        return false;
    }

    /**
     * Atualiza a tabela de movimentos de acordo com a ação do usuario
     */
    public function InsertMovements(array $arr)
    {
        $this->db->insert('movements', $arr);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Busca todos os movimentos realizados
     */
    public function getAllMovements()
    {
        $sql = "SELECT m.id, p.brand, p.model, p.number, p.barCode, us.name, m.type, DATE_FORMAT ( m.date ,'%d/%m/%Y às %H:%i') AS date
        from movements as m
        inner join product as p on m.id_product = p.id
        inner join user as us on m.id_user = us.id
        order by m.id desc
        ";

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    /**
     * busca todas as saídas no dia atual
     */
    public function getSaidas(array $periodo)
    {
        $sql = "SELECT count(id)total from movements where type = 'S' and date BETWEEN  ? and ?";
        $query = $this->db->query($sql, $periodo);
        return $query->row();
    }

    /**
     * Busca total de saidas e total de entradas
     */
    public function chartsTotalGeral(array $periodo)
    {
        $sql = "SELECT type, count(id)total from movements where date BETWEEN  ? and ? group by type";
        $query = $this->db->query($sql, $periodo);
        return $query->result_array();
    }

    /**
     * Agrupa movimentos por periodo de tempo de um mês
     */
    public function movimentacaoAgrupadoMes()
    {
        $sql = "SELECT DATE_FORMAT(`date`,'%b') AS `mes`, 
        SUM(CASE WHEN Type = 'E' THEN 1 ELSE 0 END) AS entrada, 
        SUM(CASE WHEN Type = 'S' THEN 1 ELSE 0 END) AS saida 
        FROM movements 
        GROUP BY month(date)";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Agrupa movimentos por periodo de tempo de um mês
     */
    public function movimentacaoAgrupadoDia(array $periodo)
    {
        $sql = "SELECT DATE_FORMAT(`date`,'%d') AS `dia`, 
        SUM(CASE WHEN Type = 'E' THEN 1 ELSE 0 END) AS entrada, 
        SUM(CASE WHEN Type = 'S' THEN 1 ELSE 0 END) AS saida 
        FROM movements where date between ? and ?
        GROUP BY day(date);";

        $query = $this->db->query($sql, $periodo);
        return $query->result_array();
    }
}
