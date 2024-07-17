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
			$cdwhere = array('user_id'=>$user_id, 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)), 'bank'=>$bank_list[$i]->bank);
			$cdamount = $this->api_model->SelectField('wallet', $cdwhere, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$bank_list[$i]->balance = $cdamount->total_credit - $cdamount->total_debit;
			$bank_list[$i]->transation_list = $this->api_model->GetData('wallet', '', $cdwhere, '', $order, '', '');
		}
		$data['bank_list'] = $bank_list;

		// ========== karaz user name ===============
		$karazwhere = array('karaz_user !=' => '');
		$data['karaz_user'] = $this->api_model->GetData('wallet', "DISTINCT(karaz_user)", '', '', '', '', '');

		// ========== perticular type ===============
		$data['perticular_type'] = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", '', '', '', '', '');

		// ========== perticular wise amount ===============
		$whereperamount = array('user_id'=>$user_id, 'perticular_type !=' => 'Bank', 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)));
		$perticular_type = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", $whereperamount, '', '', '', '');
		foreach($perticular_type as $list){
			$perticular_type_where = array('user_id'=> $user_id, 'perticular_type' => $list->perticular_type, 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)));
			$perticular_type_q = $this->api_model->SelectField('wallet', $perticular_type_where, "SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$list->amount = $perticular_type_q->total_debit;
			$list->rgba = rand(0, 180).", ".rand(0, 180).", ".rand(0, 180);
		}
		$data['perticular_amount'] = $perticular_type;

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

		// ========== karaz user name ===============
		$karazwhere = array('karaz_user !=' => '');
		$data['karaz_user'] = $this->api_model->GetData('wallet', "DISTINCT(karaz_user)", '', '', '', '', '');

		// ========== perticular type ===============
		$data['perticular_type'] = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", '', '', '', '', '');

		// ========== perticular wise amount ===============
		$whereperamount = array('user_id'=>$user_id, 'perticular_type !=' => 'Bank', 'YEAR(`date`)'=>date('Y', strtotime($date)));
		$perticular_type = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", $whereperamount, '', '', '', '');
		foreach($perticular_type as $list){
			$perticular_type_where = array('user_id'=> $user_id, 'perticular_type' => $list->perticular_type, 'YEAR(`date`)'=>date('Y', strtotime($date)));
			$perticular_type_q = $this->api_model->SelectField('wallet', $perticular_type_where, "SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$list->amount = $perticular_type_q->total_debit;
			$list->rgba = rand(0, 180).", ".rand(0, 180).", ".rand(0, 180);
		}
		$data['perticular_amount'] = $perticular_type;

		$this->load->view('Header');
		$this->load->view('Month-Wallet', $data);
		$this->load->view('Footer');
	}

	public function AccountBalance(){
		$user_id 	= $this->session->userdata('user_data')->id;
		
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

		// ========== karaz user name ===============
		$karazwhere = array('karaz_user !=' => '');
		$data['karaz_user'] = $this->api_model->GetData('wallet', "DISTINCT(karaz_user)", '', '', '', '', '');

		// ========== perticular type ===============
		$data['perticular_type'] = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", '', '', '', '', '');

		$this->load->view('Header');
		$this->load->view('Account-Balance', $data);
		$this->load->view('Footer');
	}

	public function KarazHishob(){
		$query = "SELECT DISTINCT(`karaz_user`) FROM `wallet` WHERE `karaz_user` !=''";
		$result = $this->db->query($query);
		$karaz_user = $result->result();

		for ($i=0; $i < count($karaz_user); $i++) {
			$cdwhere = array('karaz_user'=>$karaz_user[$i]->karaz_user);
			$order = "`date` DESC";
			$cdamount = $this->api_model->SelectField('wallet', $cdwhere, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$karaz_user[$i]->balance = $cdamount->total_debit - $cdamount->total_credit;
			$karaz_user[$i]->transation_list = $this->api_model->GetData('wallet', '', $cdwhere, '', $order, '', '');
		}
		$data['karaz_transaction'] = $karaz_user;

		$cdwhere = array('karaz_user IS NOT NULL'=> NULL);
		$cdamount = $this->api_model->SelectField('wallet', $cdwhere, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
		$data['karaz_amount'] = $cdamount->total_debit - $cdamount->total_credit;

		// ========== perticular type ===============
		$data['perticular_type'] = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", '', '', '', '', '');
		
		$this->load->view('Header');
		$this->load->view('Karaz-Hishob', $data);
		$this->load->view('Footer');
	}

	public function Perticular(){
		$user_id 	= $this->session->userdata('user_data')->id;
		$data['year'] = $year = $this->input->get('year') ?: date('Y');
		$data['month'] = $month = $this->input->get('month') ?: date('m');
		$data['type'] = $type = $this->input->get('type') ?: 'All';
		if($month == 'All'){
			$date = date("Y-m-d", strtotime($year.'-'.date('m-d')));
		}else{
			$date = date("Y-m-d", strtotime($year.'-'.$month.'-01'));
		}
		$data['show_date'] = date('F d,Y', strtotime($date));

		if($type == 'All'){
			if($month == 'All'){
				$where = array('user_id'=>$user_id, 'YEAR(`date`)'=>date('Y', strtotime($date)));
			}else{
				$where = array('user_id'=>$user_id, 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)));
			}
		}else{
			if($month == 'All'){
				$where = array('user_id'=>$user_id, 'perticular_type'=>$type, 'YEAR(`date`)'=>date('Y', strtotime($date)));
			}else{
				$where = array('user_id'=>$user_id, 'perticular_type'=>$type, 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)));
			}
		}
		
		$order = "`date` DESC";
		$field = "DISTINCT(bank)";
		$bank_list = $this->api_model->GetData('wallet', $field, $where, '', 'date', '', '');

		for ($i=0; $i < count($bank_list); $i++) {
			if($type == 'All'){
				if($month == 'All'){
					$cdwhere = array('user_id'=>$user_id, 'YEAR(`date`)'=>date('Y', strtotime($date)), 'bank'=>$bank_list[$i]->bank);
				}else{
					$cdwhere = array('user_id'=>$user_id, 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)), 'bank'=>$bank_list[$i]->bank);
				}
			}else{
				if($month == 'All'){
					$cdwhere = array('user_id'=>$user_id, 'perticular_type'=>$type, 'YEAR(`date`)'=>date('Y', strtotime($date)), 'bank'=>$bank_list[$i]->bank);
				}else{
					$cdwhere = array('user_id'=>$user_id, 'perticular_type'=>$type, 'MONTH(`date`)'=>date('m', strtotime($date)), 'YEAR(`date`)'=>date('Y', strtotime($date)), 'bank'=>$bank_list[$i]->bank);
				}
			}
			$cdamount = $this->api_model->SelectField('wallet', $cdwhere, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$bank_list[$i]->balance = $cdamount->total_credit - $cdamount->total_debit;
			$bank_list[$i]->transation_list = $this->api_model->GetData('wallet', '', $cdwhere, '', $order, '', '');
		}
		$data['bank_list'] = $bank_list;

		// ========== karaz user name ===============
		$karazwhere = array('karaz_user !=' => '');
		$data['karaz_user'] = $this->api_model->GetData('wallet', "DISTINCT(karaz_user)", '', '', '', '', '');

		// ========== perticular type ===============
		$data['perticular_type'] = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", '', '', '', '', '');

		$this->load->view('Header');
		$this->load->view('Perticular', $data);
		$this->load->view('Footer');
	}
}
