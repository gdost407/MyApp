<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$current_date = date("Y-m-d");
		$user_id 	= $this->session->userdata('user_data')->id;

		$query = "SELECT * FROM `calendar` WHERE `user_id` IN ('$user_id', 1) AND (
			(
				(
					(
						MONTH(`date`) >= MONTH('$current_date') AND DAY(`date`) >= DAY('$current_date')
					) 
					OR
					(
						MONTH(`date`) > MONTH('$current_date')
					)
				) AND `type` IN ('Birthday', 'Anniversary', 'Event', 'ToDo')
			)
		) ORDER BY MONTH(`date`), DAY(`date`) LIMIT 7";
			  
		$result = $this->db->query($query);
		$upcoming_events = $result->result();
		$data['event_list'] = $upcoming_events;

        // ==========================================
        $current_date = date("Y-m").'-'.date('t', strtotime($current_date));
    	$query = "SELECT * FROM `calendar` WHERE `user_id` IN ('$user_id', 1) AND (
				(
					(
						(`repeat_this`='Daily')
						OR 
						(`repeat_this` = 'Monthly')
						OR 
						(`repeat_this` = 'Yearly' AND MONTH(`date`) = MONTH('$current_date'))
						OR 
						(`repeat_this`='Once' AND YEAR(`date`) = YEAR('$current_date') AND MONTH(`date`) = MONTH('$current_date'))
					) AND `type` IN ('Event', 'ToDo')
				)
				OR
				(
					(MONTH(`date`) = MONTH('$current_date')) AND `type` IN ('Birthday', 'Anniversary')
				)
			) ORDER BY MONTH(`date`), DAY(`date`) LIMIT 7";
			  
		$result = $this->db->query($query);
		$data['month_events'] = $result->result();

		// ========== credit debit calculation ============
		$month_where = array('user_id'=> $user_id, 'MONTH(date)' => date('m'));
		$year_where = array('user_id'=> $user_id, 'YEAR(date)' => date('Y'));
		$month_cq = $this->api_model->SelectField('wallet', $month_where, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit")->row();
		$data['month_credit'] = $month_cq->total_credit;
		$month_dq = $this->api_model->SelectField('wallet', $month_where, "SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
		$data['month_debit'] = $month_dq->total_debit;

		$year_cq = $this->api_model->SelectField('wallet', $year_where, "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit")->row();
		$data['year_credit'] = $year_cq->total_credit;
		$year_dq = $this->api_model->SelectField('wallet', $year_where, "SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
		$data['year_debit'] = $year_dq->total_debit;

		// ========= calendar count ===================
		$calendar_where = array('user_id'=> $user_id);
		$calendar_count = $this->api_model->SelectField('calendar', $calendar_where, "COUNT(id) AS total_count")->row();
		$data['calendar_count'] = $calendar_count->total_count;

		// ========== account balance ================
		$cdwhere = array('amount'=> "0");
		$cdamount = $this->api_model->GetData('wallet', "SUM(CASE WHEN type = 'Credit' THEN amount ELSE 0 END) AS total_credit, SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit", '', '', '', '', 1);
		$data['account_balance'] = $cdamount->total_credit - $cdamount->total_debit;

		// ========== karaz user name ===============
		$karazwhere = array('amount !=' => '');
		$data['karaz_user'] = $this->api_model->GetData('wallet', "DISTINCT(karaz_user)", '', '', '', '', '');

		// ========== perticular type ===============
		$perticular_type = $this->api_model->GetData('wallet', "DISTINCT(perticular_type)", '', '', '', '', '');
		// ========= perticular wise debit amount sum ===============
		foreach($perticular_type as $list){
			$perticular_type_where = array('user_id'=> $user_id, 'perticular_type' => $list->perticular_type);
			$perticular_type_q = $this->api_model->SelectField('wallet', $perticular_type_where, "SUM(CASE WHEN type = 'Debit' THEN amount ELSE 0 END) AS total_debit")->row();
			$list->amount = $perticular_type_q->total_debit;
			$list->rgba = rand(0, 180).", ".rand(0, 180).", ".rand(0, 180);
		}
		$data['perticular_type'] = $perticular_type;

		// bar graph data
		$month = array(date("Y-m", strtotime("-5 month")), date("Y-m-d", strtotime("-4 month")), date("Y-m-d", strtotime("-3 month")), date("Y-m-d", strtotime("-2 month")), date("Y-m-d", strtotime("-1 month")), date("Y-m-d"));
		$bargraph = array();
		$largeramount = 0;
		for($i = 0; $i < 6; $i++){
			$month_where = array('user_id'=> $user_id, 'MONTH(date)' => date('m', strtotime($month[$i])), 'YEAR(date)' => date('Y', strtotime($month[$i])));
			$month_dq = $this->api_model->SelectField('wallet', $month_where, "SUM(CASE WHEN type = 'Debit' AND perticular_type != 'Bank' THEN amount ELSE 0 END) AS total_debit")->row();
			// create new object
			$new_obj = new stdClass();
			$new_obj->month = date("F", strtotime($month[$i]));
			$new_obj->amount = $month_dq->total_debit;
			array_push($bargraph, $new_obj);
			$largeramount = ($largeramount < $month_dq->total_debit) ? $month_dq->total_debit : $largeramount;
			$data['largeramount'] = $largeramount;
		}
		$data['bargraph'] = $bargraph;

		$this->load->view('Header');	
		$this->load->view('Dashboard', $data);
		$this->load->view('Footer');
	}
}
