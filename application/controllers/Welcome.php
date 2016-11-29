<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

<<<<<<< HEAD
//GIT TEST 2++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//GIT TEST 3******************************************************************************
=======
//GIT TEST++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



//GIT TEST 4 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
>>>>>>> 81adbe933869128012fe861f8ef4c90d1e38fe5e
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
}
