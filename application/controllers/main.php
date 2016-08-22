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

		$main_page_data['apt_count'] = count($main_page_data['all_apartments']);

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

	public function find_apts(){
		if(count($_GET) > 0){
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

			$main_page_data['all_apartments'] = $this->apartment_model->get_these_apts($_GET);
			$main_page_data['bedroom'] = $_GET['bedroom'];
			$main_page_data['bathroom'] = $_GET['bathroom'];
			$main_page_data['min_rent'] = $_GET['min-rent'];
			$main_page_data['max_rent'] = $_GET['max-rent'];
			if(isset($_GET['pets'])){
				$main_page_data['pets'] = $_GET['pets'];
			}
			if(isset($_GET['pool'])){
				$main_page_data['pool'] = $_GET['pool'];
			}
			if(isset($_GET['gated'])){
				$main_page_data['gated'] = $_GET['gated'];
			}
			if(isset($_GET['fitness'])){
				$main_page_data['fitness'] = $_GET['fitness'];
			}
			if(isset($_GET['wd'])){
				$main_page_data['wd'] = $_GET['wd'];
			}
			if(isset($_GET['clubhouse'])){
				$main_page_data['clubhouse'] = $_GET['clubhouse'];
			}
			if(isset($_GET['furnished'])){
				$main_page_data['furnished'] = $_GET['furnished'];
			}
			if(isset($_GET['seniors'])){
				$main_page_data['seniors'] = $_GET['seniors'];
			}
			if(isset($_GET['covered'])){
				$main_page_data['covered'] = $_GET['covered'];
			}
			if(isset($_GET['laundry'])){
				$main_page_data['laundry'] = $_GET['laundry'];
			}

			$i =0;
			if($main_page_data['all_apartments'] != ''){
				foreach ($main_page_data['all_apartments'] as $key => $value) {
				$i = ++$i;
				}
			}

			$this->load->view('apartments/main_page_header');
			$this->load->view('apartments/main_page_navbar', $top_of_nav);
			if($i > 0){

				$main_page_data['apt_count'] = $i;
				$this->load->view('apartments/main_body', $main_page_data);
				
			}else{
				$this->load->view('apartments/no_results');
			}
			
			$this->load->view('apartments/main_page_footer');
		}else{
			redirect('');
		}

		

	}

	public function add_amenities(){
		if(isset($_POST['apt_id'])){
			$apt_id = $_POST['apt_id'];
		}else{
			$apt_id = 0;
		}
		$this->load->view('admin/add_apt_amen');
		if($apt_id !=0){
			$this->load->model('admin_model');
			$make_amen = $this->admin_model->make_amen($apt_id);
		}
	}
}
