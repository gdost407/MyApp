<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if ($this->input->cookie('user_data') !== null) {
			$user_data_cookie = $this->input->cookie('user_data');
			$cookie_data = json_decode($user_data_cookie, true);
			$user_id = isset($cookie_data['user_id']) ? $cookie_data['user_id'] : null;
			$where = array('id'=>$user_id);
			$user_data = $this->api_model->SelectField('user', $where, '*')->row();
			$this->session->set_userdata('user_data', $user_data);
            redirect('Dashboard');
		} else {
			$this->load->view('Login');
		}
	}

	public function SignIn(){
		$this->load->view('SignIn');
	}
}
