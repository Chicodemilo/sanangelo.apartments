<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function insert_user(){
		$username = $this->input->post('username');
		$email = $this->input->post('username');
		$role = 'User';
		$verified = 'N';
		$date = date('Y-m-d H:i:s');
		$get_messages = 'Y';
		$password = $this->input->post('password');

		$password = hash('sha256', $password.SALT);

		$sql = "INSERT INTO users (username, password, email, role, verified, last_login, get_messages) 
		VALUES ('".$username."',
				'".$password."',
				'".$email."',
				'".$role."',
				'".$verified."',
				'".$date."',
				'".$get_messages."')
		";

		$this->load->library('email');
		$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
		$this->email->to('miles@bayrummedia.com');
		$this->email->subject('SANANGELO.APARTMENTS: New User Created');
		$this->email->message('New User: '.$username.'.  Created At: '.$date);

		$result = $this->db->query($sql);

		if ($this->db->affected_rows() == 1){

			return $username;

		}else{
			$this->load->library('email');
			$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
			$this->email->to('miles@bayrummedia.com');
			$this->email->subject('SANANGELO.APARTMENTS: Problem Inserting User Into Database');

			if (isset($username)){
				$this->email->message('Unable to register and insert user: '.$username);
			}else{
				$this->email->message('Unable to register and insert a user');
			}
			$this->email->send();
			return false;
		}

	}

	public function verify_user($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$result = $this->db->get('users')->result_array();
		$result = $this->security->xss_clean($result);

		if($this->db->affected_rows() == 1){
			$valid = $result[0]['verified'];
			if($valid == 'Y'){
				return $result;
			}else{
				return false;
			}
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
		$this->db->where('verified', 'Y');
		$found_user = $this->db->get('users')->result_array();

		if($found_user){
			$data['password'] = hash('sha256', $temp_pw.SALT);

			$this->db->where('username', $username);
			$this->db->update('users', $data);

			$this->load->library('email');
			$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
			$this->email->to($username);
			$this->email->subject('SANANGELO.APARTMENTS: Password Reset');
			$this->email->message('Your temporary password is: '.$temp_pw.'  We recommend resetting your password once you are back in.');
			$sent = $this->email->send();

			return true;
		}else{
			return false;
		}

	}








}




























