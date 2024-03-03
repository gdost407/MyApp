<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function SignUp(){
		$fname 		= trim($this->input->post('fname'));
		$lname		= trim($this->input->post('lname'));
		$email		= trim($this->input->post('email'));
		$password	= trim($this->input->post('password'));
		$password2	= trim($this->input->post('password2'));
		$latitude	= trim($this->input->post('latitude'));
		$longitude	= trim($this->input->post('longitude'));

		if($password === $password2){
			$where = array('email'=>$email);
			$exist = $this->api_model->checkExists('user', $where);
			if(!$exist){
				$data = array(
					'name'		=> ucwords($fname).' '.ucwords($lname),
					'email'		=> $email,
					'password'	=> md5($password),
					'spass'		=> $password,
					'latitude'	=> $latitude,
					'longitude'	=> $longitude,
				);
				$save = $this->api_model->SaveData('user', $data);
				if($save){
					$user_data = $this->api_model->SelectField('user', $where, '*')->row();
					// Store user data in cookies
					$cookie_data = array(
						'user_id' => $user_data->id,
						'username' => $user_data->name,
						'email' => $user_data->email
					);

					$this->input->set_cookie('user_data', json_encode($cookie_data), time() + (86400 * 5)); // Cookie for 5 days
					$this->session->set_userdata('user_data', $user_data);

					$array = array(
						'status' => '1',
						'message' => 'Registration Successful'
					);
				}else{
					$array = array(
						'status' => '0',
						'message' => 'Server issue!'
					);
				}
			}else{
				$array = array(
					'status' => '0',
					'message' => 'Duplicate Email Found!'
				);
			}
		}else{
			$array = array(
				'status' => false,
				'message' => 'Confirm Password Wrong!'
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function LoginUser(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$where = array('email'=>$email);
		if ($this->api_model->checkExists('user', $where)) {
			// User authenticated, retrieve user data
			$user_data = $this->api_model->SelectField('user', $where, '*')->row();

			if(md5($password) == $user_data->password){
				// Store user data in cookies
				$cookie_data = array(
					'user_id' => $user_data->id,
					'username' => $user_data->name,
					'email' => $user_data->email
				);

				$this->input->set_cookie('user_data', json_encode($cookie_data), time() + (86400 * 5)); // Cookie for 5 days
				$this->session->set_userdata('user_data', $user_data);

				// Return success response
				$response = array(
					'status' => true,
					'message' => 'Login successful',
				);
			}else{
				$response = array(
					'status' => false,
					'message' => 'Wrong Password'
				);
			}
		} else {
			$response = array(
				'status' => false,
				'message' => 'Invalid Email'
			);
		}

		// Send JSON response
		$this->output->set_content_type('application/json')->set_output(json_encode($response));

	}

	public function Logout(){
		$this->session->sess_destroy();
		delete_cookie('user_data');
		redirect(base_url());
	}

	public function UpdateProfile(){
		$user_id 	= $this->session->userdata('user_data')->id;
		$uname 		= trim($this->input->post('uname'));
		$umobile 	= trim($this->input->post('umobile'));
		$udob 		= trim($this->input->post('udob'));
		$uaddress 	= trim($this->input->post('uaddress'));
		$ustate 	= trim($this->input->post('ustate'));
		$ucity 		= trim($this->input->post('ucity'));
		$upincode 	= trim($this->input->post('upincode'));
		$ulatitude 	= trim($this->input->post('ulatitude'));
		$ulongitude = trim($this->input->post('ulongitude'));

		$data = array(
			'name'		=> ucwords($uname),
			'mobile'	=> $umobile,
			'dob'		=> $udob,
			'address'	=> $uaddress,
			'state'		=> $ustate,
			'city'		=> $ucity,
			'pincode'	=> $upincode,
			'latitude'	=> $ulatitude,
			'longitude'	=> $ulongitude,
		);
		$where = array('id' => $user_id);
		$save = $this->api_model->SaveData('user', $data, $where);
		if($save){
			$user_data = $this->api_model->SelectField('user', $where, '*')->row();
			$this->session->set_userdata('user_data', $user_data);
			$array = array(
				'status' => '1',
				'message' => 'Information updated'
			);
		}else{
			$array = array(
				'status' => '0',
				'message' => 'Server issue'
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function UpdatePassword(){
		$user_id 	= $this->session->userdata('user_data')->id;
		$uoldpass 	= trim($this->input->post('uoldpass'));
		$unewpass 	= trim($this->input->post('unewpass'));
		$unewpass2 	= trim($this->input->post('unewpass2'));

		if($unewpass === $unewpass2){
			if($uoldpass == $this->session->userdata('user_data')->spass){
				$data = array(
					'password'	=> md5($unewpass),
					'spass'		=> $unewpass,
				);
				$where = array('id' => $user_id);
				$save = $this->api_model->SaveData('user', $data, $where);
				if($save){
					$user_data = $this->api_model->SelectField('user', $where, '*')->row();
					$this->session->set_userdata('user_data', $user_data);
					$array = array(
						'status' => '1',
						'message' => 'Information updated'
					);
				}else{
					$array = array(
						'status' => '0',
						'message' => 'Server issue'
					);
				}
			}else{
				$array = array(
					'status' => '0',
					'message' => 'Old password wrong'
				);
			}
		}else{
			$array = array(
				'status' => '0',
				'message' => 'Confirm password wrong'
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function SaveBACT(){
		$Title 		= trim($this->input->post('baTitle'));
		$Date		= trim($this->input->post('baDate'));
		$Description= trim($this->input->post('baDescription'));
		$Repeat		= trim($this->input->post('baRepeat'));
		$Type		= trim($this->input->post('baType'));
		$user_id 	= $this->session->userdata('user_data')->id;

		$where = array('title'=>$Title, 'date'=>$Date, 'type'=>$Type);
		$exist = $this->api_model->checkExists('calendar', $where);
		if(!$exist){
			$data = array(
				'user_id'		=> $user_id,
				'title'			=> $Title,
				'date'			=> $Date,
				'description'	=> $Description,
				'repeat_this'	=> $Repeat,
				'type'			=> $Type
			);
			$save = $this->api_model->SaveData('calendar', $data);
			if($save){
				$array = array(
					'status' => '1',
					'message' => $Type.' added'
				);
			}else{
				$array = array(
					'status' => '0',
					'message' => 'Server issue'
				);
			}
		}else{
			$array = array(
				'status' => '0',
				'message' => 'Already added'
			);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function GetEventDetails(){
		$id = trim($this->input->post('id'));
		$where = array('id'=>$id);
		$getdata = $this->api_model->SelectField('calendar', $where, '*')->row();
		if($getdata){
			$array = array(
				'status' => true,
				'message' => $getdata
			);
		}else{
			$array = array(
				'status' => false,
				'message' => 'Event not found'
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function UpdateBACT(){
		$id			= trim($this->input->post('baid'));
		$Title 		= trim($this->input->post('baTitle'));
		$Date		= trim($this->input->post('baDate'));
		$Description= trim($this->input->post('baDescription'));
		$Repeat		= trim($this->input->post('baRepeat'));

		$data = array(
			'title'			=> $Title,
			'date'			=> $Date,
			'description'	=> $Description,
			'repeat_this'	=> $Repeat
		);
		$where = array('id'=>$id);
		$save = $this->api_model->SaveData('calendar', $data, $where);
		if($save){
			$array = array(
				'status' => '1',
				'message' => 'Updated details',
				'data'	=> array('id'=>$id, 'title'=>$Title, 'date'=>date('d', strtotime($Date)), 'month'=>date('F', strtotime($Date)), 'description'=>$Description, )
			);
		}else{
			$array = array(
				'status' => '0',
				'message' => 'Server issue'
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function DeleteEvent(){
		$id = trim($this->input->post('id'));
		$where = array('id'=>$id);
		$getdata = $this->api_model->DeleteData('calendar', $where, '');
		if($getdata){
			$array = array(
				'status' => true,
				'message' => 'Event deleted'
			);
		}else{
			$array = array(
				'status' => false,
				'message' => 'Server issue'
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}

	public function SaveCreditDebit(){
		$Type		= trim($this->input->post('cdType'));
		$Date		= trim($this->input->post('cdDate'));
		$Bank		= trim($this->input->post('cdBank'));
		$Amount		= trim($this->input->post('cdAmount'));
		$Perticular	= trim($this->input->post('cdPerticular'));
		$user_id 	= $this->session->userdata('user_data')->id;

		$where = array('bank'=>$Bank, 'date'=>$Date, 'type'=>$Type, 'amount'=>$Amount, 'perticular'=>$Perticular);
		$exist = $this->api_model->checkExists('wallet', $where);
		if(!$exist){
			$data = array(
				'user_id'	=> $user_id,
				'bank'		=> $Bank,
				'date'		=> $Date,
				'type'		=> $Type,
				'amount'	=> $Amount,
				'perticular'=> $Perticular
			);
			$save = $this->api_model->SaveData('wallet', $data);
			if($save){
				$array = array(
					'status' => '1',
					'message' => $Type.' added'
				);
			}else{
				$array = array(
					'status' => '0',
					'message' => 'Server issue'
				);
			}
		}else{
			$array = array(
				'status' => '0',
				'message' => 'Already added'
			);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($array));
	}


}
