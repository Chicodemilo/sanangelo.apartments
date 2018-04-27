<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Texas extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	
	public function index()
	{	 		
		
		date_default_timezone_set("America/Chicago");
		$day = date('D');
		$date = date('d');
		$hour = date('H');
		$day_of_year = date('z');

		$today = date('Y-m-d');


		//**************** GATHERING FRONT PAGE DATA *********************
		$this->db->where('update_date', $today);
		$updated = $this->db->get('site_updates')->result_array();

		if(count($updated) < 1){
			$this->load->model('admin_model');
            $this->admin_model->top_three_check_dates_and_change();
            $this->admin_model->sto_check_dates_and_change();
            $this->admin_model->level_check_dates_and_change();

			$data['update_date'] = $today;
			$data['done'] = 'Y';

			$this->db->insert('site_updates', $data);
		}

		$signed_up = $this->session->userdata('entered_email');
		if($signed_up == 'Y'){
			$signed_up = 'Y';
		}else{
			$signed_up = 'N';
		}
		$this->load->model('apartment_model');
		$top_of_nav = $this->apartment_model->get_top_of_nav();

		$top_of_nav['viewed'] = $this->apartment_model->get_views();

		$main_page_data['market_data'] = $this->apartment_model->get_market_data();

		$main_page_data['open_takeover_apt'] = $this->apartment_model->get_open_takeover_apt();
		$main_page_data['open_basic_apt'] = $this->apartment_model->get_open_basic_apt();

		if($main_page_data['open_takeover_apt'] != ''){
			$top_of_nav['background_data'] = $this->apartment_model->get_takeover_bg_info();
		}else{
			$top_of_nav['background_data'] = 'N';
		}

		
		$main_page_data['open_free_apt'] = $this->apartment_model->get_open_free_apt();


		$main_page_data['special_takeover'] = $this->apartment_model->get_special_takeover();
		if(!$main_page_data['special_takeover']){
			$main_page_data['special_takeover'] = false;
		}
		
		$main_page_data['special_basic'] = false;
		$main_page_data['special_free'] = false;

		$main_page_data['special_basic'] = $this->apartment_model->get_special_basic();

		if(!$main_page_data['special_basic']){
			$main_page_data['special_basic'] = false;
		}

		$main_page_data['special_free'] = $this->apartment_model->get_special_free();
		if(!$main_page_data['special_free']){
			$main_page_data['special_free'] = false;
		}

		$main_page_data['all_apartments'] = $this->apartment_model->get_all_apartments();

		$main_page_data['apt_count'] = count($main_page_data['all_apartments']);



		//**************** BLOG CREATION *********************
		if($day === 'Mon'){
			$exists = $this->apartment_model->does_blog_exsist('SPOT');
			if($exists == 'N'){
				$spot_blog = $this->apartment_model->make_spot_blog();
				$this->db->insert('blog', $spot_blog);
			}
		}

		if($day === 'Thu'){
			$exists = $this->apartment_model->does_blog_exsist('SPEC');
			if($exists == 'N'){
				$data['special_takeover'] = $this->apartment_model->get_special_takeover();
				$data['special_basic'] = $this->apartment_model->get_special_basic();
				$data['special_free'] = $this->apartment_model->get_special_free();
				$spot_blog = $this->apartment_model->make_spec_blog($data);
				$this->db->insert('blog', $spot_blog);
			}
		}

		if($date == '25'){
			//Watchout testing this one!! it emails to users
			$exists = $this->apartment_model->does_blog_exsist('PRIC');
			if($exists == 'N'){
				$spot_pric = $this->apartment_model->make_pric_blog();
				$this->db->insert('blog', $spot_pric);
				$this->apartment_model->send_pric_blog();
			}
		}

		if($date == '5' || $date == '13'){
			$exists = $this->apartment_model->does_blog_exsist('AMEN');
			
			if($exists == 'N'){
				$key = true;

				while($key){
					if($this->apartment_model->make_amen_blog() == 'N'){
						$key = true;
					}else{
						$spot_amen = $this->apartment_model->make_amen_blog();
						$this->db->insert('blog', $spot_amen);
						$key = false;
						break;
					}
				}
			}
		}

		//**************** REMINDERS TO ADVERTISERS *********************
		$this->db->where('update_date', $today);
		$insert_updates = $this->db->get('reminders')->result_array();

		if(count($insert_updates) < 1){

			$nuke_old = $this->db->get('reminders')->result_array();
			foreach ($nuke_old as $key => $value) {
				$this->db->where('id', $value['id']);
				$this->db->delete('reminders');
			}

			$reminder_data = array(
				0 => array(
				'update_date' => $today,
				'update_type' => 'login_remind',
				'update_done' => 'N',
				),
				1 => array(
				'update_date' => $today,
				'update_type' => 'expire_ads',
				'update_done' => 'N',
				),
				2 => array(
				'update_date' => $today,
				'update_type' => 'sto_avail',
				'update_done' => 'N',
				),
				3 => array(
				'update_date' => $today,
				'update_type' => 'page_count',
				'update_done' => 'N',
				),
				4 => array(
				'update_date' => $today,
				'update_type' => 'no_banner',
				'update_done' => 'N',
				),
				5 => array(
				'update_date' => $today,
				'update_type' => 'consider_prem',
				'update_done' => 'N',
				),
				6 => array(
				'update_date' => $today,
				'update_type' => 'fp_remind',
				'update_done' => 'N',
				),
				7 => array(
				'update_date' => $today,
				'update_type' => 'page_count_year',
				'update_done' => 'N',
				)
			);

			foreach($reminder_data as $key => $value){
				$this->db->insert('reminders', $value);
			}
		}


		if($date === '7'  && $hour > 8 && $hour < 14){
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'login_remind');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_login_remind();
			}
		}

		// if($date === '21'  && $hour > 8 && $hour < 14){
		// 	$this->db->where('update_date', $today);
		// 	$this->db->where('update_type', 'login_remind');
		// 	$sent = $this->db->get('reminders')->result_array();

		// 	if($sent[0]['update_done'] == 'N'){
		// 		$change_status['update_done'] = 'Y';
		// 		$this->db->where('id', $sent[0]['id']);
		// 		$this->db->update('reminders', $change_status);
		// 		$this->apartment_model->email_login_remind();
		// 	}
		// }

		if($date === '17'  && $hour > 8 && $hour < 14){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'fp_remind');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_no_models();
			}
		}

		if($hour > 8 && $hour < 18){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'no_banner');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				// echo "here<br>";
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_no_banner();
			}
		}

		if($date === '1'  && $hour > 8 && $hour < 18){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'page_count');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_page_count();
			}
		}

		if($day_of_year === '5'  && $hour > 8 && $hour < 18){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'page_count_year');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_page_count_year();
			}
		}

		if($day === 'Wed'  && $hour > 8 && $hour < 18){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'expire_ads');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_expire_prem();
				$this->apartment_model->email_expire_top3();
			}
		}

		if($date === '26'  && $hour > 8 && $hour < 18){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'sto_avail');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->sto_avail();
			}
		}

		if($day_of_year === '122'  && $hour > 8 && $hour < 19){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'consider_prem');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_consid_prem();
			}
		}

		if($day_of_year === '223'  && $hour > 8 && $hour < 19){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'consider_prem');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_consid_prem();
			}
		}

		if($day_of_year === '277'  && $hour > 8 && $hour < 19){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'consider_prem');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_consid_prem();
			}
		}

		if($day_of_year === '327'  && $hour > 8 && $hour < 19){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'consider_prem');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_consid_prem();
			}
		}

		if($day_of_year === '356'  && $hour > 8 && $hour < 19){
			$today = date('Y-m-d');
			$this->db->where('update_date', $today);
			$this->db->where('update_type', 'consider_prem');
			$sent = $this->db->get('reminders')->result_array();

			if($sent[0]['update_done'] == 'N'){
				$change_status['update_done'] = 'Y';
				$this->db->where('id', $sent[0]['id']);
				$this->db->update('reminders', $change_status);
				$this->apartment_model->email_consid_prem();
			}
		}

		$this->load->view('apartments/main_page_header');
		$this->load->view('apartments/main_page_navbar', $top_of_nav);
		$this->load->view('apartments/main_body', $main_page_data);
		$this->load->view('apartments/main_page_footer');
	}

	public function blog($offset = 0)
	{	
		
		$signed_up = $this->session->userdata('entered_email');
		if($signed_up == 'Y'){
			$signed_up = 'Y';
		}else{
			$signed_up = 'N';
		}
		$this->load->model('apartment_model');
		$top_of_nav = $this->apartment_model->get_top_of_nav();

		$top_of_nav['viewed'] = $this->apartment_model->get_views();

		$blog_page_data['market_data'] = $this->apartment_model->get_market_data();

		$blog_page_data['open_takeover_apt'] = $this->apartment_model->get_open_takeover_apt();

		if($blog_page_data['open_takeover_apt'] != ''){
			$top_of_nav['background_data'] = $this->apartment_model->get_takeover_bg_info();
		}else{
			$top_of_nav['background_data'] = 'N';
		}

		$limit = 30;
        $result = $this->apartment_model->get_all_blog($limit, $offset);
        $blog_page_data['blog_list'] = $result['rows'];
        $blog_page_data['num_results'] = $result['num_rows'];

        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = site_url("texas/blog");
        $config['total_rows'] = $blog_page_data['num_results'];
        $config['per_page'] = $limit;

        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $config['num_links'] = 200;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['first_tag_open'] = '<span class="first">';
        $config['first_tag_close'] = '</span>';
        $config['first_link'] = '';
        $config['last_tag_open'] = '<span class="last">';
        $config['last_tag_close'] = '</span>';
        $config['last_link'] = '';
        $config['prev_tag_open'] = '<span class="prev">';
        $config['prev_tag_close'] = '</span>';
        $config['prev_link'] = '';
        $config['next_tag_open'] = '<span class="next">';
        $config['next_tag_close'] = '</span>';
        $config['next_link'] = '';
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';

        $this->pagination->initialize($config);
        $blog_page_data['pagination'] = $this->pagination->create_links();

		$this->load->view('apartments/main_blog_header');
		$this->load->view('apartments/main_page_navbar', $top_of_nav);
		$this->load->view('apartments/blog_body', $blog_page_data);
		$this->load->view('apartments/main_page_footer');
	}

	public function this_blog($id = 1){
		$signed_up = $this->session->userdata('entered_email');
		if($signed_up == 'Y'){
			$signed_up = 'Y';
		}else{
			$signed_up = 'N';
		}
		$this->load->model('apartment_model');
		$top_of_nav = $this->apartment_model->get_top_of_nav();

		$top_of_nav['viewed'] = $this->apartment_model->get_views();

		$blog_page_data['market_data'] = $this->apartment_model->get_market_data();

		$blog_page_data['open_takeover_apt'] = $this->apartment_model->get_open_takeover_apt();

		if($blog_page_data['open_takeover_apt'] != ''){
			$top_of_nav['background_data'] = $this->apartment_model->get_takeover_bg_info();
		}else{
			$top_of_nav['background_data'] = 'N';
		}

		$result = $this->apartment_model->get_this_blog($id);
		$blog_page_data['blog_list'] = $result['rows'];
		$blog_header_data['blog'] = $result['rows']->result_array();


		$this->load->view('apartments/blog_header', $blog_header_data);
		$this->load->view('apartments/main_page_navbar', $top_of_nav);
		$this->load->view('apartments/blog_body_single', $blog_page_data);
		$this->load->view('apartments/main_page_footer');
	}


	public function map(){
		$this->load->model('apartment_model');

		$top_of_nav = $this->apartment_model->get_top_of_nav();

		$top_of_nav['viewed'] = $this->apartment_model->get_views();

		$map_page_data['all_apartments'] = $this->apartment_model->get_all_apartments();

		$map_page_data['apt_count'] = count($map_page_data['all_apartments']);

		$this->load->view('apartments/map_header');
		$this->load->view('apartments/map_navbar', $top_of_nav);
		$this->load->view('apartments/map_body', $map_page_data);
		$this->load->view('apartments/main_page_footer');

	}


	public function apartment($apt_name, $apt_id){
		$this->load->model('apartment_model');
		$this->apartment_model->add_views($apt_id);
		$top_of_nav['viewed'] = $this->apartment_model->get_views();

		$main_data = $this->apartment_model->get_apt_main_data($apt_id);
		if(!$main_data){
			redirect('');
		}else{
			$header_data['property_name'] = $main_data[0]['property_name'];
			$header_data['property_slogan'] = $main_data[0]['property_slogan'];
			$header_data['apt_id'] = $main_data[0]['ID'];

			$top_of_nav['special'] = $this->apartment_model->get_special_info($apt_id);

			$free = $this->apartment_model->get_sales_level($apt_id);

			$main_page_data['market_data'] = $this->apartment_model->get_market_data();

			$main_page_data['open_takeover_apt'] = $this->apartment_model->get_open_takeover_apt();
			$main_page_data['property_phone'] = $main_data[0]['property_phone'];
			$main_page_data['property_search_name'] = $main_data[0]['property_search_name'];
			$main_page_data['property_address'] = $main_data[0]['property_address'];
			$main_page_data['property_city'] = $main_data[0]['property_city'];
			$main_page_data['property_state'] = $main_data[0]['property_state'];
			$main_page_data['property_zip'] = $main_data[0]['property_zip'];
			$main_page_data['property_description'] = $main_data[0]['property_description'];
			$main_page_data['property_website'] = $main_data[0]['property_website'];
			$main_page_data['property_management_name'] = $main_data[0]['property_management_name'];
			$main_page_data['property_management_url'] = $main_data[0]['property_management_url'];

			$main_page_data['free'] = $free;

			$main_page_data['floorplans'] = $this->apartment_model->get_floorplans($apt_id);

			$main_page_data['amenities'] = $this->apartment_model->get_amenities($apt_id);

			$main_page_data['hours'] = $this->apartment_model->get_hours($apt_id);

			$main_page_data['logo'] = $this->apartment_model->get_logo($apt_id);

			$main_page_data['pets'] = $this->apartment_model->get_pet_policy($apt_id);

			$main_page_data['management_logo'] = $this->apartment_model->get_managment_logo($apt_id);


			if($main_page_data['property_description'] == ''){
				$main_page_data['property_description'] = 'N';
			}
			
			if($main_page_data['open_takeover_apt'] != '' && $free == 'Y'){
				$top_of_nav['background_data'] = $this->apartment_model->get_takeover_bg_info();
			}else{
				$top_of_nav['background_data'] = 'N';
			}

			$cover_pic = $this->apartment_model->get_cover_picture($apt_id);
			$top_of_nav['pic_id'] = $cover_pic['pic_id'];
			$top_of_nav['pic_name'] = $cover_pic['pic_name'];
			$top_of_nav['apt_id'] = $apt_id;

			$pictures = $this->apartment_model->get_pics($apt_id);
			if($pictures != false){
				$main_page_data['pictures'] = $pictures;
			}else{
				$main_page_data['pictures'][0]['id'] = $cover_pic['pic_id'];
				$main_page_data['pictures'][0]['name'] = $cover_pic['pic_name'];
			}

			$this->load->view('apartments/apt_page_header', $header_data);
			$this->load->view('apartments/apt_page_navbar', $top_of_nav);
			$this->load->view('apartments/apt_body', $main_page_data);
			$this->load->view('apartments/apt_page_footer');
		}
	}


	public function contact(){
		$this->load->model('apartment_model');

		date_default_timezone_set('US/Central');
		$honey_pot = $_POST['name'];
	    $data['email'] =  $_POST['email'];
		$data['message'] =  $_POST['message'];
		$data['apt_id'] =  $_POST['apt_id'];
		$data['first_name'] = $_POST['first_name'];
		$data['time'] = date('Y-m-d h:i:s');

		if($honey_pot == ''){
			$this->db->insert('contact', $data);

			$data['free'] = $this->apartment_model->get_sales_level($_POST['apt_id']);
			
			$this->apartment_model->send_contact_email($data);

			return true;
		}else{
			return false;
		}
	}


	public function find_apts(){
		if(count($_GET) > 0){
			$this->load->model('apartment_model');
			$top_of_nav = $this->apartment_model->get_top_of_nav();

			$top_of_nav['viewed'] = $this->apartment_model->get_views();

			$main_page_data['market_data'] = $this->apartment_model->get_market_data();

			$main_page_data['open_takeover_apt'] = $this->apartment_model->get_open_takeover_apt();
			$main_page_data['open_basic_apt'] = $this->apartment_model->get_open_basic_apt();

			if($main_page_data['open_takeover_apt'] != ''){
				$top_of_nav['background_data'] = $this->apartment_model->get_takeover_bg_info();
			}else{
				$top_of_nav['background_data'] = 'N';
			}

			
			$main_page_data['open_free_apt'] = $this->apartment_model->get_open_free_apt();


			$main_page_data['special_takeover'] = $this->apartment_model->get_special_takeover();
			if(!$main_page_data['special_takeover']){
				$main_page_data['special_takeover'] = false;
			}
			
			$main_page_data['special_basic'] = false;
			$main_page_data['special_free'] = false;

			$main_page_data['special_basic'] = $this->apartment_model->get_special_basic();

			if(!$main_page_data['special_basic']){
				$main_page_data['special_basic'] = false;
			}

			$main_page_data['special_free'] = $this->apartment_model->get_special_free();
			if(!$main_page_data['special_free']){
				$main_page_data['special_free'] = false;
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



	public function find_apts_map(){
		if(count($_GET) > 0){
			$this->load->model('apartment_model');
			$top_of_nav = $this->apartment_model->get_top_of_nav();

			$top_of_nav['viewed'] = $this->apartment_model->get_views();

			$main_page_data['market_data'] = $this->apartment_model->get_market_data();

			$main_page_data['open_takeover_apt'] = $this->apartment_model->get_open_takeover_apt();
			$main_page_data['open_basic_apt'] = $this->apartment_model->get_open_basic_apt();

			if($main_page_data['open_takeover_apt'] != ''){
				$top_of_nav['background_data'] = $this->apartment_model->get_takeover_bg_info();
				$top_of_nav['background_data']['takeover_top'] = '';
			}else{
				$top_of_nav['background_data'] = 'N';
			}

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

			$this->load->view('apartments/map_header');
			$this->load->view('apartments/map_navbar', $top_of_nav);
			if($i > 0){

				$main_page_data['apt_count'] = $i;
				$this->load->view('apartments/map_body', $main_page_data);
				
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


	public function sign_up(){
		$data = $_POST;
		$honey_pot = $_POST['name'];

		if($honey_pot == ''){
			$enter = $this->db->insert('sign_up', $data);
			$session_data['entered_email'] = 'Y';
			$this->session->set_userdata($session_data);
			if($enter){
				redirect(base_url().'');
			}
		}else{
			$session_data['entered_email'] = 'Y';
			$this->session->set_userdata($session_data);
			redirect(base_url().'');
		}
		
	}


	public function no_sign_up(){
		
		$session_data['entered_email'] = 'Y';
		$this->session->set_userdata($session_data);
		redirect(base_url().'');
	}
}
