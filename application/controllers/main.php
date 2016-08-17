<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{	
		$this->load->model('apartment_model');
		$top_of_nav = $this->apartment_model->get_top_of_nav();

		$top_of_nav['viewed'] = $this->apartment_model->get_views();

		$main_page_data['market_data'] = $this->apartment_model->get_market_data();

		$main_page_data['open_takeover_apt'] = $this->apartment_model->get_open_takeover_apt();
		$main_page_data['open_basic_apt'] = $this->apartment_model->get_open_basic_apt();

		if(!$main_page_data['open_basic_apt']){
			$main_page_data['open_free_apt'] = $this->apartment_model->get_open_free_apt();
			$main_page_data['open_basic_apt'] = false;
		}

		$main_page_data['special_takeover'] = $this->apartment_model->get_special_takeover();
		if(!$main_page_data['special_takeover']){
			$main_page_data['special_takeover'] = false;
		}
		$main_page_data['special_basic'] = false;
		$main_page_data['special_free'] = false;

		$main_page_data['special_basic'] = $this->apartment_model->get_special_basic();


		if(!$main_page_data['special_basic']){
			$main_page_data['special_free'] = $this->apartment_model->get_special_free();
			if(!$main_page_data['special_free']){
				$main_page_data['special_free'] = false;
			}
			$main_page_data['special_basic'] = false;
		}

		$main_page_data['all_apartments'] = $this->apartment_model->get_all_apartments();

		$this->load->view('apartments/main_page_header');
		$this->load->view('apartments/main_page_navbar', $top_of_nav);
		$this->load->view('apartments/main_body', $main_page_data);
		$this->load->view('apartments/main_page_footer');
	}


	public function map(){
		echo "map";
		$this->load->model('apartment_model');
	}


	public function apartment($apt_name, $apt_id){
		
		$this->load->model('apartment_model');
		$this->apartment_model->add_views($apt_id);
		echo '<h2>'.$apt_name.'!!</h2>';
	}
}
