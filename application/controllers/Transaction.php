<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function Monthly(){
		$user_id 	= $this->session->userdata('user_data')->id;
		$data['year'] = $year = $this->input->get('year') ?: date('Y');
		$data['month'] = $month = $this->input->get('month') ?: date('m');
		$date = date("Y-m-d", strtotime($year.'-'.$month.'-01'));
		$data['show_date'] = date('F d,Y', strtotime($date));
		
		$where = array('user_id'=>$user_id, 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)));
		$order = "`date` DESC";
		$field = "DISTINCT(bank)";
		$bank_list = $this->api_model->GetData('wallet', $field, $where, '', 'date', '', '');

		for ($i=0; $i < count($bank_list); $i++) {
			$cdwhere = array('user_id'=>$user_id, 'MONTH(`date`)'=>date('m', strtotime($date)), 'bank'=>$bank_list[$i]->bank);
			$cdamount = $this->api_model->SelectField('wallet', $cdwhere, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$bank_list[$i]->balance = $cdamount->total_credit - $cdamount->total_debit;
			$bank_list[$i]->transation_list = $this->api_model->GetData('wallet', '', $cdwhere, '', $order, '', '');
		}
		$data['bank_list'] = $bank_list;
		$this->load->view('Header');
		$this->load->view('Month-Wallet', $data);
		$this->load->view('Footer');
	}

	public function Annualy(){
		$user_id 	= $this->session->userdata('user_data')->id;
		$data['year'] = $year = $this->input->get('year') ?: date('Y');
		$data['month'] = $month = $this->input->get('month') ?: date('m');
		$date = date("Y-m-d", strtotime($year.'-'.$month.'-01'));
		$data['show_date'] = date('F d,Y', strtotime($date));

		$where = array('user_id'=>$user_id, 'YEAR(`date`)'=>date('Y', strtotime($date)));
		$order = "`date` DESC";
		$field = "DISTINCT(bank)";
		$bank_list = $this->api_model->GetData('wallet', $field, $where, '', 'date', '', '');

		for ($i=0; $i < count($bank_list); $i++) {
			$cdwhere = array('user_id'=>$user_id, 'YEAR(`date`)'=>date('Y', strtotime($date)), 'bank'=>$bank_list[$i]->bank);
			$cdamount = $this->api_model->SelectField('wallet', $cdwhere, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$bank_list[$i]->balance = $cdamount->total_credit - $cdamount->total_debit;
			$bank_list[$i]->transation_list = $this->api_model->GetData('wallet', '', $cdwhere, '', $order, '', '');
		}
		$data['bank_list'] = $bank_list;

		$this->load->view('Header');
		$this->load->view('Month-Wallet', $data);
		$this->load->view('Footer');
	}

	public function AccountBalance(){
		$user_id 	= $this->session->userdata('user_data')->id;
		$data['year'] = $year = $this->input->get('year') ?: date('Y');
		$data['month'] = $month = $this->input->get('month') ?: date('m');
		$date = date("Y-m-d", strtotime($year.'-'.$month.'-01'));
		$data['show_date'] = date('F d,Y', strtotime($date));
		
		$where = array('user_id'=>$user_id);
		$order = "`date` DESC";
		$field = "DISTINCT(bank)";
		$bank_list = $this->api_model->GetData('wallet', $field, $where, '', 'date', '', '');

		for ($i=0; $i < count($bank_list); $i++) {
			$cdwhere = array('user_id'=>$user_id, 'bank'=>$bank_list[$i]->bank);
			$cdamount = $this->api_model->SelectField('wallet', $cdwhere, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$bank_list[$i]->balance = $cdamount->total_credit - $cdamount->total_debit;
			$bank_list[$i]->transation_list = $this->api_model->GetData('wallet', '', $cdwhere, '', $order, '', '');
		}
		$data['bank_list'] = $bank_list;
		$this->load->view('Header');
		$this->load->view('Account-Balance', $data);
		$this->load->view('Footer');
	}
}
