<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->data['page'] = 'Login';
		$this->load->model('User_Model', 'user');
	}

	private function verificaSessao()
	{
		if ($this->session->has_userdata('name')) {
			redirect('welcome');
		}
	}

	public function index()
	{
		$this->verificaSessao();

		$this->load->view('user/login', $this->data);
	}

	public function login()
	{
		$this->verificaSessao();

		if ($this->input->post()) {

			$this->form_validation->set_rules('text_name_user', 'nome de usuário', 'required', array('required' => 'o campo %s é obrigatorio'));
			$this->form_validation->set_rules('text_password', 'senha', 'required', array('required' => 'o campo %s é obrigatorio'));

			if ($this->form_validation->run() === true) {
				$result = $this->user->getUser($this->input->post('text_name_user', true), md5($this->input->post('text_password', true)));
				if ($result) {
					// Cria a sessão do usuário
					$this->session->set_userdata(
						array(
							'id'    => $result->id,
							'name'  => $result->name,
							'login' => $result->login,
						)
					);
					redirect('welcome');
				} else {
					$this->data['statusMessage'] = 'danger';
					$this->data['message'] = 'Usuário ou senha inválidos';
					$this->load->view('user/login', $this->data);
				}
			} else {
				$this->data['statusMessage'] = 'warning';
				$this->data['message'] = 'Verifique se os campos foram preenchidos';
				$this->load->view('user/login', $this->data);
			}
		}
	}
	public function logout()
	{
		//faz o logout do usuário
		if ($this->session->has_userdata('name')) {
			//destroi os dados da sessão                
			$this->session->unset_userdata('id');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('idLocal');

			redirect('welcome');
		} else {
			redirect('welcome');
		}
	}

}
