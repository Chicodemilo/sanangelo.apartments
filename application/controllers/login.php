<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

			echo $username.'<br>'.$password;
		}
	}

}