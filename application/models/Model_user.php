<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function insert_user(){
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$role = 'User';
		$verified = 'N';
		$date = date('Y-m-d H:i:s');
		$get_messages = 'Y';
		$password = $this->input->post('password');
		$temp_pw = $this->input->post('password');

		$password = hash('sha256', $password.SALT);

		$sql = "INSERT INTO users (username, password, temp_pw, email, role, verified, last_login, get_messages) 
		VALUES ('".$username."',
				'".$password."',
				'".$temp_pw."',
				'".$email."',
				'".$role."',
				'".$verified."',
				'".$date."',
				'".$get_messages."')
		";

		$result = $this->db->query($sql);

		if ($this->db->affected_rows() == 1){

			$data = ['username' => $username, 'email' => $email, 'date' => $date];
			return $data;

		}else{

			return false;
		}

	}

	public function verify_user($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$result = $this->db->get('users')->result_array();
		$result = $this->security->xss_clean($result);

		if($this->db->affected_rows() == 1 && $result[0]['verified'] == 'Y'){
			return $result;
		}else{
			return false;
		}
	}

	public function get_apt_data_for_session($user_id){
		$this->db->where('verified_user_id', $user_id);
		$result = $this->db->get('apartment_main')->result_array();
		$result = $this->security->xss_clean($result);

		return $result;
	}

	public function previous_user_logins($user_id){
		$this->db->where('user_id', $user_id);
		$result = $this->db->get('session_data')->result_array();
		$result = $this->security->xss_clean($result);

		return $result;
	}

	public function do_reset_this_password($username){
		function RandomString($length) {
		    $keys = array_merge(range(0,9), range('a', 'z'));

		    $key = '';

		    for($i=0; $i < $length; $i++) {
		        $key .= $keys[mt_rand(0, count($keys) - 1)];
		    }
		    return $key;
		}

		$temp_pw = RandomString(8);

		$this->db->where('username', $username);
		$found_user = $this->db->get('users')->result_array();
		$email = $found_user[0]['email'];

		if($found_user){
			$data['password'] = hash('sha256', $temp_pw.SALT);
			$data['temp_pw'] = $temp_pw;

			$this->db->where('username', $username);
			$this->db->update('users', $data);

			$this->load->library('email');
			$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
			$this->email->to($email);
			$this->email->subject('SANANGELO.APARTMENTS: Password Reset');
			$this->email->message('Your Username Is: '.$username.'<br>Your new temporary password is: '.$temp_pw.'<br>We recommend resetting your password once you are back in.<br> <a href="'.base_url().'login/login_user">Login Here</a>');
			$sent = $this->email->send();

			for ($i=2; $i <= 4; $i++){
				if($found_user[0]['email_'.$i] != ''){
					$this->load->library('email');
					$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
					$this->email->to($found_user[0]['email_'.$i]);
					$this->email->subject('SANANGELO.APARTMENTS: Password Reset');
					$this->email->message('Your Username Is: '.$username.'<br>Your new temporary password is: '.$temp_pw.'<br>We recommend resetting your password once you are back in.<br> <a href="'.base_url().'login/login_user">Login Here</a>');
					$sent = $this->email->send();
				}
				
			}


			return true;
		}else{
			return false;
		}

	}








}




























