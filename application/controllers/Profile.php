<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array();
		$this->load->view('Header');
		$this->load->view('Profile', $data);
		$this->load->view('Footer');
	}
}
