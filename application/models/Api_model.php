<?php
class Api_model extends CI_Model{
    
    public function mycommonSelect($table, $where){
    	$result = $this->db->select('*')->from($table)->where($where)->order_by('id', 'desc')->get(); 
    	if($result){
    		return $result;
    	}else{
    		$result = array();
    		return $result;
    	}
    }
    
	// Get Single / Multiple Records.
	public function GetData($table,$field='',$condition='',$group='',$order='',$limit='',$result=''){
	    if($field != '')
	    $this->db->select($field);
	    if($condition != '')
	    $this->db->where($condition);
	    if($order != '')
	    $this->db->order_by($order);
	    if($limit != '')
	    $this->db->limit($limit);
	    if($group != '')
	    $this->db->group_by($group);
	  	if($result != '')
	    {
	        $return =  $this->db->get($table)->row();
	    }else{
	        $return =  $this->db->get($table)->result();
	    }
	    return $return;
	}

    // Get Multiple Records. pagination
	public function GetDataAll($table, $field='', $condition='', $group='', $order='', $limit='', $page=''){
	    if($field != '')
	    $this->db->select($field);
	    if($condition != '')
	    $this->db->where($condition);
	    if($order != '')
	    $this->db->order_by($order);
	    if($limit != '' && $page != ''){
			$page *= $limit;
			$this->db->limit($limit, $page);
		}elseif($limit != ''){
			$this->db->limit($limit);
		}
	    if($group != '')
	    $this->db->group_by($group);
		$return =  $this->db->get($table)->result();
	    return $return;
	}

	/*To Save / Update the Data*/
	public function SaveData($table,$data,$condition=''){
	    $DataArray = array();
	    $table_fields = $this->db->list_fields($table);
	    foreach($data as $field=>$value){
	        if(in_array($field,$table_fields)){
	            $DataArray[$field]= $value;
	        }
	    }
	    if($condition != ''){
	        $this->db->where($condition);
	     	$return = $this->db->update($table, $DataArray);
	    }else{
	     	$return = $this->db->insert($table, $DataArray);
	    }
	    return $return;
	}

	/*Delete any table data*/
	public function DeleteData($table,$condition='',$limit=''){
	    if($condition != '')
	    $this->db->where($condition);
	    if($limit != '')
	    $this->db->limit($limit);
	    $result = $this->db->delete($table);
	   	return $result;
      	
	}

	// Check Mobile / Email number exist or Not
	public function checkExists($table, $where){ 
		$query = $this->db->select('id')->from($table)->where($where)->get()->row_array();
		if($query){
			return 1;
		}else{
			return 0;
		}
	}

	// function to get data from the table 
	public function SelectField($table, $where, $field="*"){
		$result = $this->db->select($field)->from($table)->where($where)->get();
		return $result;
	}

	// function to update data in the table 
	public function commonUpdate($table, $where, $data){
		$this->db->where($where);
		$query = $this->db->update($table, $data);
		$query = $this->db->affected_rows();
		//print $this->db->last_query();exit;
		if($query >= 1){
			return true;
		}else{
			return false;
		}
	}

	// View Profile
	// public function getServicePartnerDetails($where)
	// {
	// 	$this->db->select("tsp.*,IF(tm.id > 0, tm.tm_company_name, 0) as mfr_name, tbm.tb_bank_name");
	//     $this->db->from("tbl_service_partner as tsp");
	//     $this->db->join('tbl_manufacturer tm','tm.id = tsp.mfr_id','left'); 
	//     $this->db->join('tbl_bank_master as tbm','tbm.id = tsp.tsp_bank_id','left');
	//     $this->db->where($where);   
	//     return $this->db->get()->row(); 
	// }
    

	// firebase cURL by aniket 15-11-2023
    public function PushNotification($deviceToken, $notification, $data=array()){
        // Replace 'YOUR_SERVER_KEY' with your Firebase Server Key
        $serverKey = 'AAAAe4RqHG8:APA91bHk-ApEMruKhELmFN6ekV53uR6Ce7sBExnQLoe9BGZQOdfYQxSzD5Q8UyB1hD1SyB_tGOZPNUgj5RU0s_ibXQssy5fUDIizmrr8GvwFxInDd6y8Tmy7lt_pSwnPYOlvrK2a_PrL';

        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $message = [
            'to' => $deviceToken,
            'notification' => $notification,
            'data' => $data,
            'priority' => 'high',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

        $response = curl_exec($ch);
		// echo json_encode($response);
        // if (curl_errno($ch)) {
            // echo 'cURL error: ' . curl_error($ch);
        // }

        curl_close($ch);

        // echo 'Notification sent successfully';
    }

	// send email function for team member by aniket  30-09-2023
	// public function teamMemberEmail($to_email, $name, $password){
	// 	$this->load->library('SendMail');
   	//  	$this->SendMail = new SendMail;

	// 	$bgpath = 'https://mistrichacha.com/tsit/assets/massets/assets/media/logos/bg_1.jpg';
				
	// 	$Data['mailoutbox_to']=$to_email;
	// 	$Data['mailoutbox_subject']="Technician Registration Successfully.";
	// 	$message = "<!DOCTYPE html>
	// 			<html><head></head><body><table width='100%' cellpadding='0' cellspacing='0' bgcolor='#f1f1f1'>
	// 						<tr> <td> <table align='center' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>  <tr> <td valign='middle' class='bg_white' style='width:100%; height: auto;'>
	// 							<img src='".$bgpath."' width='100%' />  </td> <tr>
	// 				<tr> <td bgcolor='#ffffff' style='padding: 0px 30px 40px 30px;'>
	// 						<table cellpadding='0' cellspacing='0' width='100%'>
	// 							<tr> <td> <h2>Hi! ".$name."</h2>
	// 									<center><h3>Thank you for registering.</h3></center> <p>Your account has been created successfully. </p>
	// 									<p>Your Email is : <b>".$to_email."</b></p>
	// 									<p>Your password is : <b>".$password."</b></p>
	// 									<p>To start exploring our platform and accessing your account, please download our app using the following link:<br> <a href='https://play.google.com/store/apps/details?id=com.prosolstech.mistrichacha_partner'>Lockene - FSM App</a></p> 

	// 									<p>If you have any concerns or questions, please don't hesitate to reach out to our support team at <a href='mailto:lockeneinc@gmail.com#mail'>lockeneinc@gmail.com</a>. We are here to assist you and provide any necessary clarification.</p>
	// 									<p>Thank you for your understanding.</p><b>Lockene Pvt. Ltd.</b></p>
	// 								</td>  </tr> </table> </td> </tr> <tr> <td bgcolor='#f1f1f1' style='padding: 20px 30px 20px 30px;'>
	// 						<p style='margin: 0;'>&copy; 2023 All rights reserved By <a href='https://lockene.us/'>lockene.us</a></p>
	// 						</td> </tr>  </table>  </td> </tr> </table>  </body>  </html>";
	// 	$Data['mailoutbox_body']=$message;
	// 	return $this->SendMail->Send($Data);
	// }
 
}