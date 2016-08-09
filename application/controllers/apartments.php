<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apartments extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{	
		$this->load->view('apartments/main_page_header');
		$this->load->view('apartments/main_page_navbar');
		$this->load->view('apartments/main_body');
		$this->load->view('apartments/main_page_footer');
	}
}
