<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		// $this->is_logged_in();
	}

	// function is_logged_in(){
	// 	$is_logged_in = $this->session->userdata('is_logged_in');

	// 	if(isset($is_logged_in) || $is_logged_in = true){
	// 		redirect(base_url().'edit');
	// 	}
	// }

// REGISTER USER *********************************************************************************
	public function register()
	{	
		$this->load->view('login/header.php');
		$this->load->view('login/main_register');
		$this->load->view('login/footer.php');
	}

	public function register_user(){
		$this->form_validation->set_rules('username', 'Email Address', 'trim|required|min_length[3]|max_length[50]|valid_email|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[18]|matches[conf_password]');
		$this->form_validation->set_rules('conf_password', 'Confirmed Password', 'trim|required|min_length[6]|max_length[18]');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('login/header.php');
			$this->load->view('login/main_register');
			$this->load->view('login/footer.php');
		}else{
			$this->load->model('model_user');

			$result = $this->model_user->insert_user();

			if ($result){
				$this->load->view('login/header.php');
				$this->load->view('login/register_success', array('username' => $result));
				$this->load->view('login/footer.php');
			}else{
				echo 'There seems to be a problem with the website. Please contact admin@greatsite.apartments and let them know. Thanks!';
			}
		}
	}


// LOGIN USER *********************************************************************************
	public function login_user(){
		$this->form_validation->set_rules('username', 'Email Address', 'trim|required|min_length[3]|max_length[50]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[18]');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('login/header.php');
			$this->load->view('login/main_login.php');
			$this->load->view('login/footer.php');
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password = hash('sha256', $password.SALT);

			$this->load->model('model_user');
			$user_data = $this->model_user->verify_user($username, $password);
			if($user_data == false){
				$data['no_user'] = 'Oops, '.$username.', there is a problem with the email address or password.';
				$this->load->view('login/header.php');
				$this->load->view('login/main_login.php', $data);
				$this->load->view('login/footer.php');
			}else{
				$user_id = $user_data[0]['ID'];

				$this->load->model('model_user');
				$apt_data = $this->model_user->get_apt_data_for_session($user_id);

				date_default_timezone_set('America/Chicago');
				$time = date("Y-m-d H:i:s");

				$host= gethostname();
				$ip = gethostbyname($host);

				$saved_session_data = array(
						'user_id' => $user_id,
						'login_time' => $time,
						'ip_address' => $ip,
					);
				$this->db->insert('session_data', $saved_session_data);

				$old_session_data = $this->model_user->previous_user_logins($user_id);
				$number_of_logins = count($old_session_data);


				$session_data = array(
					'is_logged_in' => true,
					'user_id' => $user_id,
					'username' => $user_data[0]['username'],
					'login_count' => $number_of_logins,
					'last_login' => $user_data[0]['last_login'],
					'current_login' => $saved_session_data['login_time'],
					'current_ip' => $saved_session_data['ip_address'],
					'role' => $user_data[0]['role'],
					'apt_id' => $apt_data[0]['ID'],
					'apt_name' => $apt_data[0]['property_name'],
				);

				$this->session->set_userdata($session_data);

				$new_data = array('last_login' => $time, 'login_count' => $number_of_logins);
				$this->db->where('ID', $user_id);
				$this->db->update('users', $new_data);

				redirect('edit');
			}

		}
	}


// LOGOUT USER *********************************************************************************
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url()."login/login_user");
	}



// PASSWORD RESET *********************************************************************************
	function reset_password(){
		$this->load->view('login/header.php');
		$this->load->view('login/reset_password.php');
		$this->load->view('login/footer.php');
	}

	function reset_this_password(){
		$username = $this->input->post('username');
		$this->load->model('model_user');
		$reset = $this->model_user->do_reset_this_password($username);
		if($reset){
			redirect(base_url()."login/login_user");
		}else{
			echo "We couldn't find a user with that username.<br>";
			echo "<a href='".base_url()."login/reset_password'>Try Again</a>";

		}
	}

}





















