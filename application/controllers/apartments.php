<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apartments extends CI_Controller {

	public function index()
	{
		$this->load->view('apartments/main_body');
	}
}
