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

		$result = $this->db->query($sql);

		if ($this->db->affected_rows() === 1){

			$this->load->library('email');
			$this->email->from('miles@bayrummedia.com', 'Greatsite Admin');
			$this->email->to('miles@bayrummedia.com');
			$this->email->subject('GREATSITE.APARTMENTS: New User Created');
			$this->email->message('New User: '.$username.'.  Created At: '.$date);

			$this->email->send();

			return $username;
		}else{
			$this->load->library('email');
			$this->email->from('miles@bayrummedia.com', 'Greatsite Admin');
			$this->email->to('miles@bayrummedia.com');
			$this->email->subject('GREATSITE.APARTMENTS: Problem Inserting User Into Database');

			if (isset($username)){
				$this->email->message('Unable to register and insert user: '.$username);
			}else{
				$this->email->message('Unable to register and insert a user');
			}
			$this->email->send();
			return false;
		}

	}
}