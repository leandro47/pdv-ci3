<?php
defined('BASEPATH') or exit('URL inválida.');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('name')) {
            redirect('User');
        }

        $this->data['page'] = 'Inicio';
        $this->data['user'] = $this->session->name;
        // $this->load->model('User_Model', 'user');
    }

    public function index()
    { 
        $this->load->view('application/home', $this->data);
    }
    
}
