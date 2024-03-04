<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function view(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$user_id 	= $this->session->userdata('user_data')->id;
		$new_timestamp = mktime(0, 0, 0, $month, 1, $year);
  		$date = getdate($new_timestamp);

		// get heading
		$pm = $month - 1; $nm = $month + 1;
		if($pm == 0){ $pm = 12; $py = $year - 1; }else{ $py = $year; }
		if($nm == 13){ $nm = 1; $ny = $year + 1; }else{ $ny = $year; }
		$array['hfour'] = date("F Y", $new_timestamp).'
					<span style="float: right;">
						<button class="btn btn-sm btn-outline-purple py-1" onclick="get_calender(&#39;'.$pm.'&#39;, &#39;'.$py.'&#39;)"><<</button>
						<button class="btn btn-sm btn-outline-purple py-1" onclick="get_calender(&#39;'.$nm.'&#39;, &#39;'.$ny.'&#39;)">>></button>
					</span>';
		$mday = $date['mday']; $mon = $date['mon']; $wday = $date['wday']; $month = $date['month']; $year = $date['year'];

		// get calendar
		$dayCount = $wday;
		$day = $mday;
		
		while($day > 0) {
		$days[$day--] = $dayCount--;
		if($dayCount < 0)
			$dayCount = 6;
		}
		
		$dayCount = $wday;
		$day = $mday;
		
		if(checkdate($mon,31,$year))
		$lastDay = 31;
		elseif(checkdate($mon,30,$year))
		$lastDay = 30;
		elseif(checkdate($mon,29,$year))
		$lastDay = 29;
		elseif(checkdate($mon,28,$year))
		$lastDay = 28;

		// =========================================
		// get timeline
		$current_date = $year."-".sprintf('%02d', $mon)."-".$lastDay;;
    	$query = "SELECT * FROM `calendar` WHERE `user_id`='$user_id' AND
			(
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
			) ORDER BY MONTH(`date`), DAY(`date`)";
			  
		$result = $this->db->query($query);
		$upcoming_events = $result->result();
		$array['timeline'] = '';
		foreach($upcoming_events as $list){
			if($list->type == 'Birthday')
				$bg = 'bg-green';
			if($list->type == 'Anniversary')
				$bg = 'bg-purple';
			if($list->type == 'Event')
				$bg = 'bg-blue';
			if($list->type == 'ToDo')
				$bg = 'bg-yellow';
			
			$array['timeline'] .= '<div class="timeline-item" id="cardbox'.$list->id.'">
					<div class="timeline-item-marker">
						<div class="timeline-item-marker-text" id="carddm'.$list->id.'">'.date('d M', strtotime($list->date)).'</div>
						<div class="timeline-item-marker-indicator '.$bg.'"></div>
					</div>
					<div class="timeline-item-content">
						'.$list->type.'!
						<a class="fw-bold text-dark" id="cardtitle'.$list->id.'" onclick="get_event('.$list->id.')">'.$list->title.'</a>
						<span id="carddescription'.$list->id.'">'.$list->description.'</span>.
					</div>
				</div>';
		}
		if(empty($upcoming_events)){
			$array['timeline'] = '<center>
					<img src="https://media.istockphoto.com/id/1304870386/vector/planning-schedule-business-event-and-calendar-concept-people-with-schedule-pen-and-notes.jpg?s=612x612&w=0&k=20&c=KFN0SB9IB6bShsNHJLH69t2biCZ3BYYDn-O69KvKdNc=" style="max-width: 200px;">
				</center>';
			$upcoming_events = array();
		}
		// =========================================
		
		while($day <= $lastDay) {
		$days[$day++] = $dayCount++;
		if($dayCount > 6)
			$dayCount = 0;
		}	
		
		$startDay = 0;
		$d = $days[1];
		
		$array['tbody'] = '<tr class="text-center">';
		while($startDay < $d) {
			$array['tbody'] .='<td></td>';
			$startDay++;
		}
		
		for ($d=1;$d<=$lastDay;$d++) {
			if(strlen($d)==1)
				$d="0".$d;
			$current_date = $year."-".sprintf('%02d', $mon)."-".$d;
			if($current_date == date("Y-m-d")){
				$array['tbody'] .= '<td class="py-2 text-danger fw-bold">
										<span style="cursor: pointer;" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-title="'.date('F d,Y', strtotime($current_date)).'" data-bs-html="true" 
										data-bs-content="<ul><li><a href=&quot;view?m=Event&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Event</a></li><li><a href=&quot;view?m=ToDo&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>ToDo</a></li><li><a href=&quot;view?m=Birthday&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Birthday</a></li><li><a href=&quot;view?m=Anniversary&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Anniversary</a></li><li><a href=&quot;view?m=Credit&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Credit</a></li><li><a href=&quot;view?m=Debit&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Debit</a></li></ul>" aria-describedby="popover211727">'.$d.'</span>
									</td>';
			}else{
				$textcolor = 'text-black';
				foreach ($upcoming_events as $event) {
					if (date('d', strtotime($event->date)) == $d) {
						if($event->type == 'Birthday')
							$textcolor = 'text-green fw-bold text-decoration-underline';
						if($event->type == 'Anniversary')
							$textcolor = 'text-purple fw-bold text-decoration-underline';
						if($event->type == 'Event')
							$textcolor = 'text-blue fw-bold text-decoration-underline';
						if($event->type == 'ToDo')
							$textcolor = 'text-yellow fw-bold text-decoration-underline';
						break; // No need to continue looping if an event is found for this date
					}
				}
				$array['tbody'] .= '<td class="py-2 '.$textcolor.'">
										<span style="cursor: pointer;" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-title="'.date('F d,Y', strtotime($current_date)).'" data-bs-html="true" 
										data-bs-content="<ul><li><a href=&quot;view?m=Event&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Event</a></li><li><a href=&quot;view?m=ToDo&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>ToDo</a></li><li><a href=&quot;view?m=Birthday&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Birthday</a></li><li><a href=&quot;view?m=Anniversary&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Anniversary</a></li><li><a href=&quot;view?m=Credit&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Credit</a></li><li><a href=&quot;view?m=Debit&amp;d='.$current_date.'&quot; class=&quot;eventLink nav-link&quot;>Debit</a></li></ul>" aria-describedby="popover211727">'.$d.'</span>
									</td>';
			}
			
			$startDay++;
			if($startDay > 6 && $d < $lastDay){
				$startDay = 0;
				$array['tbody'] .= '</tr>
					<tr class="text-center">';
			}
		}
		$array['tbody'] .= "</tr>";

		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function List(){
		$user_id 	= $this->session->userdata('user_data')->id;
		$where = array('user_id'=>$user_id);
		$order = "MONTH(`date`), DAY(`date`)";
		$data['calendar_list'] = $this->api_model->GetData('calendar', '', $where, '', $order, '', '');
		$this->load->view('Header');
		$this->load->view('Calendar-List', $data);
		$this->load->view('Footer');
	}
}
