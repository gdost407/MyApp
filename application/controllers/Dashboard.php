<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$current_date = date("Y-m-d");
		$user_id 	= $this->session->userdata('user_data')->id;

		$query = "SELECT * FROM `calendar` WHERE `user_id`='$user_id' AND (
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
    	$query = "SELECT * FROM `calendar` WHERE `user_id`='$user_id' AND (
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

		$this->load->view('Header');
		$this->load->view('Dashboard', $data);
		$this->load->view('Footer');
	}
}
