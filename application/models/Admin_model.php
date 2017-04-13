<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function get_old_message(){
		$old_message = $this->db->get('site_promos')->result_array();
		$data['adv_mssg_on'] = $old_message[0]['adv_mssg_on'];
		$data['adv_mssg_mssg'] = $old_message[0]['adv_mssg_mssg'];
		$data['adv_mssg_pic'] = $old_message[0]['adv_mssg_pic'];
		$data['adv_mssg_start'] = $old_message[0]['adv_mssg_start'];
		$data['adv_mssg_end'] = $old_message[0]['adv_mssg_end'];
		return $data;
	}

	public function send_save_mssg($data){
		$submit_data['adv_mssg_mssg'] = $data['adv_mssg_mssg'];
		$submit_data['adv_mssg_on'] = $data['adv_mssg_on'];
		$submit_data['adv_mssg_start'] = $data['adv_mssg_start'];
		$submit_data['adv_mssg_end'] = $data['adv_mssg_end'];

		$this->db->where('id', 1);
		$this->db->update('site_promos', $submit_data);

		if($data['email_adv'] == 'Y'){
			$text = '<h3>'.$data['adv_mssg_mssg'].'</h3>';
			$text .= '<br>'.$data['adv_mssg_email_only'];
			$subject = $data['email_subject'];
			$this->load->library('email');

			$this->db->where('verified','Y');
			$all_users = $this->db->get('users')->result_array();
			foreach ($all_users as $key => $value) {
				if($value['email'] != ''){
					$all_the_stuff = '';
					if($data['include_user'] == 'Y'){
						$user = '<br><h5>Your Username: '.$value['username'].'</h5>';
						$all_the_stuff .= $user;
					}
					if($data['include_password'] == 'Y'){
						$temp_pw = '<h5>Your Temporary Password: '.$value['temp_pw'].'<span style="font-size:.9em;color:orange;"><br>Because we emailed you this password, it is now not secure. Please use it once to login and change your password immediately.</span></h5>';
						$all_the_stuff .= $temp_pw;
					}
					if($data['include_email'] == 'Y'){
						$email = '<h5>Your Associated Email Address(es): '.$value['email'].' '.$value['email_2'].' '.$value['email_3'].' '.$value['email_4'].'</h5>';
						$all_the_stuff .= $email;
					}
					if($data['include_link'] == 'Y'){
						$this->db->where('verified_user_id', $value['ID']);
						$apt_info = $this->db->get('apartment_main')->result_array();
						if(count($apt_info) > 0){
							$link = '<h5>Here\'s Your Page: <a href="'.base_url().'/texas/apartment/'.$apt_info[0]['property_search_name'].'/'.$apt_info[0]['ID'].'">'.$apt_info[0]['property_name'].'</a></h5>';
							$all_the_stuff .= $link;
						}

						
					}
					$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
					$this->email->to($value['email']);
					$this->email->subject($subject);
					$this->email->message($text.$all_the_stuff);
					$this->email->send();
				}
				if($value['email_2'] != ''){
					$all_the_stuff = '';
					if($data['include_user'] == 'Y'){
						$user = '<br><h5>Your Username: '.$value['username'].'</h5>';
						$all_the_stuff .= $user;
					}
					if($data['include_password'] == 'Y'){
						$temp_pw = '<h5>Your Temporary Password: '.$value['temp_pw'].'<span style="font-size:.9em;color:orange;"><br>Because we emailed you this password, it is now not secure. Please use it once to login and change your password immediately.</span></h5>';
						$all_the_stuff .= $temp_pw;
					}
					if($data['include_email'] == 'Y'){
						$email = '<h5>Your Associated Email Address(es): '.$value['email'].' '.$value['email_2'].' '.$value['email_3'].' '.$value['email_4'].'</h5>';
						$all_the_stuff .= $email;
					}
					if($data['include_link'] == 'Y'){
						$this->db->where('verified_user_id', $value['ID']);
						$apt_info = $this->db->get('apartment_main')->result_array();
						if(count($apt_info) > 0){
							$link = '<h5>Here\'s Your Page: <a href="'.base_url().'texas/apartment/'.$apt_info[0]['property_search_name'].'/'.$apt_info[0]['ID'].'">'.$apt_info[0]['property_name'].'</a></h5>';
							$all_the_stuff .= $link;
						}
					}
					$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
					$this->email->to($value['email_2']);
					$this->email->subject($subject);
					$this->email->message($text.$all_the_stuff);
					$this->email->send();
				}
				if($value['email_3'] != ''){
					$all_the_stuff = '';
					if($data['include_user'] == 'Y'){
						$user = '<br><h5>Your Username: '.$value['username'].'</h5>';
						$all_the_stuff .= $user;
					}
					if($data['include_password'] == 'Y'){
						$temp_pw = '<h5>Your Temporary Password: '.$value['temp_pw'].'<span style="font-size:.9em;color:orange;"><br>Because we emailed you this password, it is now not secure. Please use it once to login and change your password immediately.</span></h5>';
						$all_the_stuff .= $temp_pw;
					}
					if($data['include_email'] == 'Y'){
						$email = '<h5>Your Associated Email Address(es): '.$value['email'].' '.$value['email_2'].' '.$value['email_3'].' '.$value['email_4'].'</h5>';
						$all_the_stuff .= $email;
					}
					if($data['include_link'] == 'Y'){
						$this->db->where('verified_user_id', $value['ID']);
						$apt_info = $this->db->get('apartment_main')->result_array();
						if(count($apt_info) > 0){
							$link = '<h5>Here\'s Your Page: <a href="'.base_url().'texas/apartment/'.$apt_info[0]['property_search_name'].'/'.$apt_info[0]['ID'].'">'.$apt_info[0]['property_name'].'</a></h5>';
							$all_the_stuff .= $link;
						}
					}
					$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
					$this->email->to($value['email_3']);
					$this->email->subject($subject);
					$this->email->message($text.$all_the_stuff);
					$this->email->send();
				}
				if($value['email_4'] != ''){
					$all_the_stuff = '';
					if($data['include_user'] == 'Y'){
						$user = '<br><h5>Your Username: '.$value['username'].'</h5>';
						$all_the_stuff .= $user;
					}
					if($data['include_password'] == 'Y'){
						$temp_pw = '<h5>Your Temporary Password: '.$value['temp_pw'].'<span style="font-size:.9em;color:orange;"><br>Because we emailed you this password, it is now not secure. Please use it once to login and change your password immediately.</span></h5>';
						$all_the_stuff .= $temp_pw;
					}
					if($data['include_email'] == 'Y'){
						$email = '<h5>Your Associated Email Address(es): '.$value['email'].' '.$value['email_2'].' '.$value['email_3'].' '.$value['email_4'].'</h5>';
						$all_the_stuff .= $email;
					}
					if($data['include_link'] == 'Y'){
						$this->db->where('verified_user_id', $value['ID']);
						$apt_info = $this->db->get('apartment_main')->result_array();
						if(count($apt_info) > 0){
							$link = '<h5>Here\'s Your Page: <a href="'.base_url().'texas/apartment/'.$apt_info[0]['property_search_name'].'/'.$apt_info[0]['ID'].'">'.$apt_info[0]['property_name'].'</a></h5>';
							$all_the_stuff .= $link;
						}
					}
					$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS Admin');
					$this->email->to($value['email_4']);
					$this->email->subject($subject);
					$this->email->message($text.$all_the_stuff);
					$this->email->send();
				}
			}

		}

	}

	public function get_open_users(){
		$this->db->where('role', 'User');
		$all_users = $this->db->get('users')->result_array();

		$all_apts = $this->db->get('apartment_main')->result_array();

		$unused_ids = [];
		$unique = 'Y';
		foreach ($all_users as $key => $value) {
			$x = 0;
			while ($x < count($all_apts)) {
				if($value['ID'] == $all_apts[$x]['verified_user_id']){
					$unique = 'N';
				}
				$x++;
			}

			if($unique == 'Y'){
				array_push($unused_ids, $value['ID']);
			}else{
				$unique = 'Y';
			}
		}
		$data = [];
		foreach ($unused_ids as $key => $value) {
			$this->db->where('ID', $value);
			$user_info = $this->db->get('users')->result_array();
			array_push($data, $user_info);

		}

		if(count($data) < 1){
			$data = 'N';
			return $data;
		}else{
			return $data;
		}
	}

	public function get_used_users(){
		$this->db->where('role', 'User');
		$this->db->order_by('username');
		$all_users = $this->db->get('users')->result_array();

		$all_apts = $this->db->get('apartment_main')->result_array();

		$unused_ids = [];
		$unique = 'N';
		foreach ($all_users as $key => $value) {
			$x = 0;
			while ($x < count($all_apts)) {
				if($value['ID'] == $all_apts[$x]['verified_user_id']){
					$unique = 'Y';
				}
				$x++;
			}

			if($unique == 'Y'){
				array_push($unused_ids, $value['ID']);
			}else{
				$unique = 'N';
			}
			$unique = 'N';
		}
		$data = [];
		foreach ($unused_ids as $key => $value) {
			$this->db->where('ID', $value);
			$user_info = $this->db->get('users')->result_array();
			array_push($data, $user_info);
		}

		if(count($data) < 1){
			$data = 'N';
			return $data;
		}else{
			return $data;
		}
	}

	public function make_amen($apt_id){
		echo $apt_id;
		$amenities = array(
				'65+ Community',
				'Accepts Credit Card Payments',
				'Accepts Electronic Payments',
				'Affordable Housing',
				'All Bills Paid',
				'Balcony',
				'Basketball Court',
				'Business Center',
				'Cable Ready',
				'Cable Included',
				'Ceiling Fan(s)',
				'Clubhouse',
				'Covered Parking',
				'Disability Access',
				'Dishwasher',
				'Dog Park',
				'Enclosed Yards',
				'Extra Storage',
				'Fireplace',
				'Fitness Center',
				'Furnished Available',
				'Garage',
				'Garden Tub',
				'Gas Range',
				'Gated Access',
				'Hardwood Flooring',
				'High Speed Internet Access',
				'Income Restrictions',
				'Internet Included',
				'Laundry Facility',
				'Microwaves',
				'Oversized Closets',
				'Pets',
				'Playground',
				'Se Habla Espanol',
				'Security Systems',
				'Seniors Community',
				'Short Term Leases Available',
				'Smoke Free',
				'Some Paid Utilities',
				'Stainless Steel Appliances',
				'Swimming Pool',
				'Tennis Court',
				'Tennis Courts',
				'Vaulted Ceilings',
				'Washer / Dryer Connections',
				'Washer / Dryer In Unit',
				'Wireless Internet Access',
				'Yards',
			);

			foreach ($amenities as $amenity) {
				$data = array('apt_id' => $apt_id, 'name' => $amenity, 'active' => 'N', 'select_units' => 'N', 'extra_fees' => 'N');
				$insert = $this->db->insert('our_amenities_list', $data); 
			}
	}

	public function get_all_current_apts(){
		// $servername = "localhost";
		// $username = "root";
		// $password = "test";
		// $dbname = "sanangelo_apartments";
		// $conn = new mysqli($servername, $username, $password, $dbname);
		// $sql = "SELECT ID, property_name, property_search_name, verified_user_id, property_phone FROM apartment_main WHERE suspend != 'Y'";
		// $result = $conn->query($sql);

		$this->db->where('suspend', 'N');
		$result = $this->db->get('apartment_main')->result_array();

		// print_r($result);

		
		return $result;
		
		// $conn->close();
	}


	public function get_all_suspended_apts(){
		// $servername = "localhost";
		// $username = "root";
		// $password = "test";
		// $dbname = "sanangelo_apartments";
		// $conn = new mysqli($servername, $username, $password, $dbname);
		// $sql = "SELECT ID, property_name, property_search_name, verified_user_id, property_phone FROM apartment_main WHERE suspend = 'Y'";
		// $result = $conn->query($sql);

		$this->db->where('suspend', 'Y');
		$result = $this->db->get('apartment_main')->result_array();
		
		return $result;
		
		// $conn->close();
	}

	public function get_prices()
	{
		$prices = $this->db->get('cost');
		return $prices;
	}

	public function get_adv_upcoming_sales($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('start_date', 'desc');
		$result = $this->db->get('upcoming_sales')->result_array();
		return $result;
	}


	public function get_adv_upcoming_sales_recent($apt_id){
		$today = date('Y-m-d');
		$month_ago = date(Y."-".m."-".d, strtotime('-1 month', strtotime($today)));
		$this->db->where('end_date >=', $month_ago);
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('start_date', 'desc');
		$result = $this->db->get('upcoming_sales')->result_array();
		return $result;
	}


	public function get_taken_sales()
	{
		date_default_timezone_set("America/Chicago");
		$today = date(Y."-".m."-".d);
		$yesterday = date(Y."-".m."-".d, strtotime('-1 day', strtotime($today)));
		$start_of_month = date('Y-m-'.'01', strtotime($today));
		$this->db->where('item', 'site_takeover');
		$this->db->where('start_date >=', $yesterday);
		$this->db->order_by('start_date', 'desc');
		$data['site_takeovers'] = $this->db->get('upcoming_sales')->result_array();

		$this->db->where('item', 'top_3');
		$this->db->where('start_date >=', $start_of_month);
		$this->db->order_by('start_date', 'desc');
		$this->db->group_by('start_date');
		$start_dates = $this->db->get('upcoming_sales')->result_array();

		$x = 1;
		foreach($start_dates as $key => $value){
			$this->db->where('start_date', $value['start_date']);
			$this->db->where('item', 'top_3');
			$data['top_3'][$x] = $this->db->get('upcoming_sales')->result_array();
			$x++;
		}
		return $data;
	}


	public function check_top_3($start_date, $apt_id)
	{
		date_default_timezone_set("America/Chicago");
		$this->db->where('start_date', $start_date);
		$this->db->where('item', 'top_3');
		$top_3s = $this->db->get('upcoming_sales')->result_array();

		if(count($top_3s) >= 3){
			return "Top 3 Is Full For This Month";
		}else{

			$this->db->where('apt_id', $apt_id);
			$this->db->where('start_date', $start_date);
			$this->db->where('item', 'top_3');
			$top_3s_apt_id = $this->db->get('upcoming_sales')->result_array();

			if(count($top_3s_apt_id) > 0){
				return "This Advertiser Already Has A Top 3 This Month";
			}else{
				return "Y";
			}
		}
	}


	public function check_sto($start_date, $apt_id)
	{
		date_default_timezone_set("America/Chicago");
		$this->db->where('start_date', $start_date);
		$this->db->where('item', 'site_takeover');
		$stos = $this->db->get('upcoming_sales')->result_array();

		if(count($stos) >= 1){
			return "Site Takeover Is Full For This Day";
		}else{
			return "Y";
		}
	}

	public function get_banner_names($apt_id){
		$this->db->where('apt_id', $apt_id);
		// $this->db->where('item', 'site_takeover');
		$data = $this->db->get('sales')->result_array();

		if(count($data) > 0){
			$banner_names['apt_id'] = $data[0]['apt_id'];
			$banner_names['count'] = count($data);
			$banner_names['left_takeover_name'] = $data[0]['left_takeover_name'];
			$banner_names['right_takeover_name'] = $data[0]['right_takeover_name'];
			$banner_names['top_takeover_name'] = $data[0]['top_takeover_name'];
			$banner_names['mobile_takeover_name'] = $data[0]['mobile_takeover_name'];

			return $banner_names;
		}else{
			$banner_names = 'N';
			return $banner_names;
		}
	}

	public function level_check_dates_and_change()
	{	
		date_default_timezone_set("America/Chicago");
		$today = date('Y-m-d');

		$this->db->where('item', 'premium_level');
		$this->db->where('start_date <=', $today);
		$this->db->where('end_date >=', $today);
		$premium_advertiers = $this->db->get('upcoming_sales')->result_array();

		$nuker_levels = array('free' => 'Y', 'basic' => 'N');
		$all_advertisers = $this->db->get('apartment_main')->result_array();

		foreach ($all_advertisers as $key => $value) {
			$this->db->where('apt_id', $value['ID']);
			$this->db->update('sales', $nuker_levels);
		}

		$un_nuke_levels = array('free' => 'N', 'basic' => 'Y');
		foreach ($premium_advertiers as $key => $value){
			$this->db->where('apt_id', $value['apt_id']);
			$this->db->update('sales', $un_nuke_levels);
		}
	}

	public function top_three_check_dates_and_change()
	{	
		date_default_timezone_set("America/Chicago");
		$today = date('Y-m-d');

		$this->db->where('item', 'top_3');
		$this->db->where('start_date <=', $today);
		$this->db->where('end_date >=', $today);
		$top_three_advertiers = $this->db->get('upcoming_sales')->result_array();

		$nuker_levels = array('main_page_top' => '');
		$all_advertisers = $this->db->get('apartment_main')->result_array();

		foreach ($all_advertisers as $key => $value) {
			$this->db->where('apt_id', $value['ID']);
			$this->db->update('sales', $nuker_levels);
		}

		$un_nuke_levels = array('main_page_top' => 'Y');
		foreach ($top_three_advertiers as $key => $value){
			$this->db->where('apt_id', $value['apt_id']);
			$this->db->update('sales', $un_nuke_levels);
		}
	}

	public function sto_check_dates_and_change()
	{	
		date_default_timezone_set("America/Chicago");
		$today = date('Y-m-d');

		$this->db->where('item', 'site_takeover');
		$this->db->where('start_date =', $today);
		$sto_advertier = $this->db->get('upcoming_sales')->result_array();

		$nuker_levels = array('takeover' => 'N');
		$all_advertisers = $this->db->get('apartment_main')->result_array();

		foreach ($all_advertisers as $key => $value) {
			$this->db->where('apt_id', $value['ID']);
			$this->db->update('sales', $nuker_levels);
		}

		$apt_id = $sto_advertier[0]['apt_id'];
		$this->db->where('apt_id', $apt_id);
		$sto_data = $this->db->get('upcoming_sales')->result_array();

		$un_nuke_levels = array(
			'takeover' => 'Y'
			);

		$this->db->where('apt_id', $sto_advertier[0]['apt_id']);
		$this->db->update('sales', $un_nuke_levels);
	}

	public function get_all_ads_by_date()
	{
		$this->db->order_by('start_date', 'desc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_date_asc()
	{
		$this->db->order_by('start_date', 'asc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_date_end_desc()
	{
		$this->db->order_by('end_date', 'desc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_date_end_asc()
	{
		$this->db->order_by('end_date', 'asc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_adv_desc()
	{
		$this->db->order_by('apt_name', 'desc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_adv_asc()
	{
		$this->db->order_by('apt_name', 'asc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_type_desc()
	{
		$this->db->order_by('item', 'desc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_type_asc()
	{
		$this->db->order_by('item', 'asc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_cost_desc()
	{
		$this->db->order_by('cost', 'desc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_all_ads_by_cost_asc()
	{
		$this->db->order_by('cost', 'asc');
		$data = $this->db->get('upcoming_sales');
		return $data;
	}

	public function get_ads_for_date_range($start_date, $end_date){

		$this->db->where('start_date >=', $start_date);
		$this->db->where('end_date <=', $end_date);
		$results_top_sto = $this->db->get('upcoming_sales')->result_array();

		$this->db->where('start_date <=', $end_date);
		$this->db->where('end_date >=', $end_date);
		$this->db->where('item', 'premium_level');
		$results_prem = $this->db->get('upcoming_sales')->result_array();

		$all_results = array();

		foreach ($results_top_sto as $key => $value) {
			$push_this = array($key = $value);
			array_push($all_results, $push_this);
		}

		foreach ($results_prem as $key => $value) {
			$push_this = array($key = $value);
			array_push($all_results, $push_this);
		}

		foreach ($all_results as $key => $value) {
			# code...
		}

		if(count($all_results) > 0){
			return $all_results;
		}else{
			$results = 'N';
			return $results;
		}
	}

	public function get_ad_info_for_inv($apt_id){
		$this->db->where('ID', $apt_id);
		$this->db->limit(1);
		$result = $this->db->get('apartment_main')->result_array();

		foreach ($result as $key => $value) {
			$data['apt_id'] = $value['ID'];
			$data['verified_user_id'] = $value['verified_user_id'];
			$data['property_name'] = $value['property_name'];
			$data['property_phone'] = $value['property_phone'];
			$data['property_address'] = $value['property_address'];
			$data['property_city'] = $value['property_city'];
			$data['property_state'] = $value['property_state'];
			$data['property_zip'] = $value['property_zip'];
		}

		$this->db->where('ID', $data['verified_user_id']);
		$this->db->limit(1);
		$user_data = $this->db->get('users')->result_array();

		foreach($user_data as $value){
			$data['apt_contact_email_1'] = $value['email'];
			$data['apt_contact_email_2'] = $value['email_2'];
			$data['apt_contact_email_3'] = $value['email_3'];
			$data['apt_contact_email_4'] = $value['email_4'];
		}
		return $data;
	}


	public function invoice_sets_created_today(){
		date_default_timezone_set("America/Chicago");
		$today = date('Y-m-d');
		$this->db->where('inv_creation_date', $today);
		$this->db->order_by('inv_sets_today', 'desc');
		$date_check = $this->db->get('invoice')->result_array();

		if(count($date_check) < 1){
			$return_count = 0;
			return $return_count;

		}else{
			$return_count = $date_check[0]['inv_sets_today'];
			return $return_count;
		}
	}

	public function here_are_todays_invoices($today){
		date_default_timezone_set("America/Chicago");
		$this->db->where('inv_creation_date', $today);
		$this->db->order_by('inv_sets_today', 'desc');
		$heres_todays = $this->db->get('invoice')->result_array();
		echo count($heres_todays);
		echo $today;

		if(count($heres_todays) < 1){
			$return_count = 0;
			return $return_count;
		}else{
			$return_count = $heres_todays[0]['inv_sets_today'];
			return $return_count;
		}
	}


	public function make_these_invoices($these_unique_ids){
			date_default_timezone_set("America/Chicago");
			$today = date('Y-m-d');
            $this->load->model('admin_model');
            $inv_count = $this->admin_model->here_are_todays_invoices($today);
            $inv_count = $inv_count+1;

            foreach ($these_unique_ids as $value){
                $this->load->model('admin_model');
                $apt_data = $this->admin_model->get_ad_info_for_inv($value);

				$this->db->order_by('inv_number', 'desc');
                $query = $this->db->get('invoice')->result_array();

                if(count($query) < 1){
                	$counter = 3000;
                }else{
                	$counter = $query[0]['inv_number'] + 1;
                }
                
                $apt_data['inv_number'] = $counter;
                date_default_timezone_set("America/Chicago");
                $apt_data['inv_creation_date'] = date('Y-m-d');
                $apt_data['inv_due_date'] = date('Y-m-'.'10');
                $apt_data['inv_status'] = 'DUE';
                $apt_data['inv_notes'] = 'Thank you for your choice to trust us with your advertising budget.<br>Please contact us with any comments or concerns.';
                $apt_data['inv_sets_today'] = $inv_count;
                
                $this->db->insert('invoice', $apt_data);
            }
	}


	public function get_this_adv_info($apt_id){
		$this->db->where('ID', $apt_id);
		$data = $this->db->get('apartment_main')->result_array();
		return $data;
	}

	public function get_master_payments($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('master_payments')->result_array();
		if(count($data) < 1){
			$no_returns = "N";
			return $no_returns;
		}else{
			return $data;
		}
	}


	public function get_inv_for_date_and_set($date, $set){
		$this->db->where('inv_creation_date', $date);
		$this->db->where('inv_sets_today', $set);
		$invoices = $this->db->get('invoice')->result_array();
		if(count($invoices) < 1){
			$no_inv = 'N';
			return($no_inv);
		}else{
			return($invoices);
		}
	}


	public function get_past_due_invoices(){
		$this->db->where('inv_status', 'PAST DUE');
		$this->db->order_by('property_name', 'desc');
		$past_due_inv = $this->db->get('invoice')->result_array();

		if(count($past_due_inv) < 1){
			$no_pd = 'N';
			return($no_pd);
		}else{
			return($past_due_inv);
		}
	}

	public function get_due_and_past_due_inv(){
		$this->db->where('inv_status', 'PAST DUE');
		$this->db->or_where('inv_status', 'DUE');
		$this->db->order_by('property_name', 'asc');
		$past_due_inv = $this->db->get('invoice')->result_array();

		if(count($past_due_inv) < 1){
			$no_pd = 'N';
			return($no_pd);
		}else{
			return($past_due_inv);
		}
	}

	public function get_adv_inv($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('inv_creation_date', 'desc');
		$adv_inv = $this->db->get('invoice')->result_array();

		if(count($adv_inv) < 1){
			$no_pd = 'N';
			return($no_pd);
		}else{
			return($adv_inv);
		}
	}


	public function get_dates_inv($start_date, $end_date){
		$this->db->where('inv_creation_date >=', $start_date);
		$this->db->where('inv_creation_date <=', $end_date);
		$this->db->order_by('property_name', 'asc');
		$adv_inv = $this->db->get('invoice')->result_array();

		if(count($adv_inv) < 1){
			$no_pd = 'N';
			return($no_pd);
		}else{
			return($adv_inv);
		}
	}


	public function make_past_dues($date){
		date_default_timezone_set("America/Chicago");
		$end_of_last_month = date(Y."-".m."-".t, strtotime('-1 month', strtotime($date)));
		$this->db->where('inv_due_date <=', $end_of_last_month);
		$past_dues = $this->db->get('invoice')->result_array();
		foreach ($past_dues as $key => $value) {
			if($value['invoice_balance'] > 0){
				$late['inv_status'] = 'PAST DUE';
				$late['inv_notes'] = 'THIS INVOICE IS CURRENTLY LISTED AS PAST DUE.<br>PLEASE MAKE ARRANGEMENTS TO PAY YOUR BALANCE.';
				$this->db->where('inv_number', $value['inv_number']);
				$this->db->update('invoice', $late);
			}
		}
	}


	public function get_this_inv($inv_num){
		$this->db->where('inv_number', $inv_num);
		$this_inv = $this->db->get('invoice')->result_array();

		if(count($this_inv) < 1){
			$no_inv = 'N';
			return($no_inv);
		}else{
			return($this_inv);
		}
	}


	public function send_current_set($creation_date, $set){
		$this->load->library('email');
		$this->load->model('admin_model');
		$current_set = $this->admin_model->get_inv_for_date_and_set($creation_date, $set);
		if($current_set != 'N'){
			foreach ($current_set as $key => $value) {
				for ($i=1; $i < 5; $i++) { 
					if($value['apt_contact_email_'.$i] != ''){
						$subject = 'INVOICE FROM SANANGELO.APARTMENTS '.$value['inv_creation_date'];
						$message = '
							<body style="font-family:arial">
							<h3>SANANGELO.APARTMENTS<br>INVOICE</h3>
							<h4>DATE: '.$value['inv_creation_date'].'</h4>
							<h4>INVOICE NUMBER: '.$value['inv_number'].'</h4>
							<h4>INVOICE STATUS: '.$value['inv_status'].'</h4>
							<h4>DUE DATE: '.$value['inv_due_date'].'</h4>
							<span style="font-weight:bolder">BILL TO:</span><br>'.
							$value['property_name'].'<br>'.
							$value['property_address'].'<br>'.
							$value['property_city'].', '.$value['property_state'].' '.$value['property_zip'].'
							<br>
							'.$value['apt_contact_email_1'].' '.$value['apt_contact_email_2'].' '.$value['apt_contact_email_3'].' '.$value['apt_contact_email_4'].'
							<br>
							'.$value['property_phone'].'
							<hr style="height:3px; border:none; color:#000; background-color:#4286f4;">
							<span style="font-size:.9em; color:#000; font-family:arial;">'.$value['inv_notes'].'</span><br>
							<br>
						';

						$this_sub_total = 0;
						for ($x=1; $x < 14; $x++) { 
							if($value['item_'.$x] == '' || $value['item_'.$x] == NULL || $value['item_'.$x] == 'NULL' || $value['item_'.$x] == ' '){
								$text = '';
							}else{
								$this_sub_total = $this_sub_total + $value['cost_'.$x];
								$text = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEM ".$x.":&nbsp;".$value['item_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start Date:&nbsp;".$value['start_date_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date:&nbsp;".$value['end_date_'.$x];

								if($value['deduction_'.$x] === '0' || $value['deduction_'.$x] === 0){
									$text_c = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_c;
								}else{
									$text_b = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Base Cost:&nbsp;$".$value['base_cost_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deduction:&nbsp;-$".$value['deduction_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_b;
								}
							}
							$message .= $text;
						}
						$sub_total = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEMS SUB TOTAL: $".$this_sub_total."</span><br><br>";
						$message .= $sub_total;

						for ($q=1; $q < 14; $q++) { 
							if($value['payment_'.$q] == '' || $value['payment_'.$q] == NULL || $value['payment_'.$q] == 'NULL' || $value['payment_'.$q] == ' ' || $value['payment_'.$q] == '0' || $value['payment_'.$q] == 0){
								$text_d = '';
							}else{
								$text_d = "<span style='font-size:.8em; color:#30540d; font-family:arial;'>&bull;&nbsp;PAYMENT ".$i.":&nbsp;".$value['payment_'.$q.'_type']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;".$value['payment_'.$q.'_date']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								if($value['payment_'.$q.'_check_num'] == '' || $value['payment_'.$q.'_check_num'] == NULL || $value['payment_'.$q.'_check_num'] == 'NULL' || $value['payment_'.$q.'_check_num'] == ' ' || $value['payment_'.$i.'_check_num'] == '0' || $value['payment_'.$i.'_check_num'] == 0){
									$text_f = "Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d.= $text_f;
								}else{
									$text_f = "Check Number:&nbsp;".$value['payment_'.$q.'_check_num']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d .= $text_f;
								}
							}
							$message .= $text_d;
						}

						$message_foot = 
						'<h3>AMOUNT CURRENTLY DUE: $'.$value['invoice_balance'].'</h3>
						<hr style="height:3px; border:none; color:#000; background-color:#4286f4;">
						Please Send Payment To:<br>
						Bay Rum Media<br>
						PO Box 2584<br>
						San Angelo, TX<br>
						76902
						<hr style="height:3px; border:none; color:#000; background-color:#4286f4;">
						<br><br><br><br>
						</body>';

						$message .= $message_foot;

						$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS BILLING');
						$this->email->to($value['apt_contact_email_'.$i]);
						$this->email->subject($subject);
						$this->email->message($message);
						$this->email->send();
						// echo $message;
					}
				}
			}
			$return_data['current_set_sent'] = 'Y';	
			return($return_data);
		}else{
			$return_data['current_set_sent'] = 'N';	
			return($return_data);
		}
	}

	public function send_past_due(){
		$this->load->library('email');
		$this->load->model('admin_model');
		$current_set = $this->admin_model->get_past_due_invoices();
		if($current_set != 'N'){
			foreach ($current_set as $key => $value) {
				date_default_timezone_set("America/Chicago");
				$today = date('Y-m-d');
				
				$end_due_month = date(Y."-".m."-".t, strtotime($value['inv_creation_date']));

				$days_late = round(abs(strtotime($today)-strtotime($end_due_month))/86400);

				for ($i=1; $i < 5; $i++) { 
					if($value['apt_contact_email_'.$i] != ''){
						$subject = 'PAST DUE INVOICE FROM SANANGELO.APARTMENTS';
						$message = '
							<body style="font-family:arial">
							<h3>SANANGELO.APARTMENTS<br><span style="color:red">PAST DUE INVOICE</span></h3>
							<h4>DATE: '.$value['inv_creation_date'].'</h4>
							<h4>INVOICE NUMBER: '.$value['inv_number'].'</h4>
							<h4>INVOICE STATUS: '.$value['inv_status'].'</h4>
							<h4>DUE DATE: '.$value['inv_due_date'].'</h4>
							<h4 style="color:orange">This Invoice Is '.$days_late.' Days Past Due</h4>
							<span style="font-weight:bolder">BILL TO:</span><br>'.
							$value['property_name'].'<br>'.
							$value['property_address'].'<br>'.
							$value['property_city'].', '.$value['property_state'].' '.$value['property_zip'].'
							<br>
							'.$value['apt_contact_email_1'].' '.$value['apt_contact_email_2'].' '.$value['apt_contact_email_3'].' '.$value['apt_contact_email_4'].'
							<br>
							'.$value['property_phone'].'
							<hr style="height:3px; border:none; color:#000; background-color:red;">
							<span style="font-size:.9em; color:#000; font-family:arial;">'.$value['inv_notes'].'</span><br>
							<br>
						';

						$this_sub_total = 0;
						for ($x=1; $x < 14; $x++) { 
							if($value['item_'.$x] == '' || $value['item_'.$x] == NULL || $value['item_'.$x] == 'NULL' || $value['item_'.$x] == ' '){
								$text = '';
							}else{
								$this_sub_total = $this_sub_total + $value['cost_'.$x];
								$text = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEM ".$x.":&nbsp;".$value['item_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start Date:&nbsp;".$value['start_date_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date:&nbsp;".$value['end_date_'.$x];

								if($value['deduction_'.$x] === '0' || $value['deduction_'.$x] === 0){
									$text_c = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_c;
								}else{
									$text_b = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Base Cost:&nbsp;$".$value['base_cost_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deduction:&nbsp;-$".$value['deduction_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_b;
								}
							}
							$message .= $text;
						}
						$sub_total = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEMS SUB TOTAL: $".$this_sub_total."</span><br><br>";
						$message .= $sub_total;

						for ($q=1; $q < 14; $q++) { 
							if($value['payment_'.$q] == '' || $value['payment_'.$q] == NULL || $value['payment_'.$q] == 'NULL' || $value['payment_'.$q] == ' ' || $value['payment_'.$q] == '0' || $value['payment_'.$q] == 0){
								$text_d = '';
							}else{
								$text_d = "<span style='font-size:.8em; color:#30540d; font-family:arial;'>&bull;&nbsp;PAYMENT ".$i.":&nbsp;".$value['payment_'.$q.'_type']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;".$value['payment_'.$q.'_date']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								if($value['payment_'.$q.'_check_num'] == '' || $value['payment_'.$q.'_check_num'] == NULL || $value['payment_'.$q.'_check_num'] == 'NULL' || $value['payment_'.$q.'_check_num'] == ' ' || $value['payment_'.$i.'_check_num'] == '0' || $value['payment_'.$i.'_check_num'] == 0){
									$text_f = "Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d.= $text_f;
								}else{
									$text_f = "Check Number:&nbsp;".$value['payment_'.$q.'_check_num']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d .= $text_f;
								}
							}
							$message .= $text_d;
						}

						$message_foot = 
						'<h3>AMOUNT CURRENTLY DUE: $'.$value['invoice_balance'].'</h3>
						<hr style="height:3px; border:none; color:#000; background-color:red;">
						Please Send Payment To:<br>
						Bay Rum Media<br>
						PO Box 2584<br>
						San Angelo, TX<br>
						76902
						<hr style="height:3px; border:none; color:#000; background-color:red;">
						<br><br><br><br>
						</body>';

						$message .= $message_foot;

						$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS BILLING');
						$this->email->to($value['apt_contact_email_'.$i]);
						$this->email->subject($subject);
						$this->email->message($message);
						$this->email->send();
						// echo $message;
					}
				}
			}
			$return_data['current_set_sent'] = 'Y';	
			return($return_data);
		}else{
			$return_data['current_set_sent'] = 'N';	
			return($return_data);
		}
	}

	public function send_one_invoice($inv_number){
		$this->db->where('inv_number', $inv_number);
		$current_set = $this->db->get('invoice')->result_array();
		if($current_set[0]['inv_status'] == 'PAST DUE'){
			foreach ($current_set as $key => $value) {
				date_default_timezone_set("America/Chicago");
				$today = date('Y-m-d');
				
				$end_due_month = date(Y."-".m."-".t, strtotime($value['inv_creation_date']));

				$days_late = round(abs(strtotime($today)-strtotime($end_due_month))/86400);

				for ($i=1; $i < 5; $i++) { 
					if($value['apt_contact_email_'.$i] != ''){
						$subject = 'PAST DUE INVOICE FROM SANANGELO.APARTMENTS';
						$message = '
							<body style="font-family:arial">
							<h3>SANANGELO.APARTMENTS<br><span style="color:red">PAST DUE INVOICE</span></h3>
							<h4>DATE: '.$value['inv_creation_date'].'</h4>
							<h4>INVOICE NUMBER: '.$value['inv_number'].'</h4>
							<h4>INVOICE STATUS: '.$value['inv_status'].'</h4>
							<h4>DUE DATE: '.$value['inv_due_date'].'</h4>
							<h4 style="color:orange">This Invoice Is '.$days_late.' Days Past Due</h4>
							<span style="font-weight:bolder">BILL TO:</span><br>'.
							$value['property_name'].'<br>'.
							$value['property_address'].'<br>'.
							$value['property_city'].', '.$value['property_state'].' '.$value['property_zip'].'
							<br>
							'.$value['apt_contact_email_1'].' '.$value['apt_contact_email_2'].' '.$value['apt_contact_email_3'].' '.$value['apt_contact_email_4'].'
							<br>
							'.$value['property_phone'].'
							<hr style="height:3px; border:none; color:#000; background-color:red;">
							<span style="font-size:.9em; color:#000; font-family:arial;">'.$value['inv_notes'].'</span><br>
							<br>
						';

						$this_sub_total = 0;
						for ($x=1; $x < 14; $x++) { 
							if($value['item_'.$x] == '' || $value['item_'.$x] == NULL || $value['item_'.$x] == 'NULL' || $value['item_'.$x] == ' '){
								$text = '';
							}else{
								$this_sub_total = $this_sub_total + $value['cost_'.$x];
								$text = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEM ".$x.":&nbsp;".$value['item_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start Date:&nbsp;".$value['start_date_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date:&nbsp;".$value['end_date_'.$x];

								if($value['deduction_'.$x] === '0' || $value['deduction_'.$x] === 0){
									$text_c = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_c;
								}else{
									$text_b = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Base Cost:&nbsp;$".$value['base_cost_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deduction:&nbsp;-$".$value['deduction_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_b;
								}
							}
							$message .= $text;
						}
						$sub_total = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEMS SUB TOTAL: $".$this_sub_total."</span><br><br>";
						$message .= $sub_total;

						for ($q=1; $q < 14; $q++) { 
							if($value['payment_'.$q] == '' || $value['payment_'.$q] == NULL || $value['payment_'.$q] == 'NULL' || $value['payment_'.$q] == ' ' || $value['payment_'.$q] == '0' || $value['payment_'.$q] == 0){
								$text_d = '';
							}else{
								$text_d = "<span style='font-size:.8em; color:#30540d; font-family:arial;'>&bull;&nbsp;PAYMENT ".$i.":&nbsp;".$value['payment_'.$q.'_type']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;".$value['payment_'.$q.'_date']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								if($value['payment_'.$q.'_check_num'] == '' || $value['payment_'.$q.'_check_num'] == NULL || $value['payment_'.$q.'_check_num'] == 'NULL' || $value['payment_'.$q.'_check_num'] == ' ' || $value['payment_'.$i.'_check_num'] == '0' || $value['payment_'.$i.'_check_num'] == 0){
									$text_f = "Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d.= $text_f;
								}else{
									$text_f = "Check Number:&nbsp;".$value['payment_'.$q.'_check_num']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d .= $text_f;
								}
							}
							$message .= $text_d;
						}

						$message_foot = 
						'<h3>AMOUNT CURRENTLY DUE: $'.$value['invoice_balance'].'</h3>
						<hr style="height:3px; border:none; color:#000; background-color:red;">
						Please Send Payment To:<br>
						Bay Rum Media<br>
						PO Box 2584<br>
						San Angelo, TX<br>
						76902
						<hr style="height:3px; border:none; color:#000; background-color:red;">
						<br><br><br><br>
						</body>';

						$message .= $message_foot;

						$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS BILLING');
						$this->email->to($value['apt_contact_email_'.$i]);
						$this->email->subject($subject);
						$this->email->message($message);
						$this->email->send();
						// echo $message;
					}
				}
			}
			$return_data['current_set_sent'] = 'PAST DUE SENT';	
			return($return_data);
		}else{
			foreach ($current_set as $key => $value) {
				for ($i=1; $i < 5; $i++) { 
					if($value['apt_contact_email_'.$i] != ''){
						$subject = 'INVOICE FROM SANANGELO.APARTMENTS '.$value['inv_creation_date'];
						$message = '
							<body style="font-family:arial">
							<h3>SANANGELO.APARTMENTS<br>INVOICE</h3>
							<h4>DATE: '.$value['inv_creation_date'].'</h4>
							<h4>INVOICE NUMBER: '.$value['inv_number'].'</h4>
							<h4>INVOICE STATUS: '.$value['inv_status'].'</h4>
							<h4>DUE DATE: '.$value['inv_due_date'].'</h4>
							<span style="font-weight:bolder">BILL TO:</span><br>'.
							$value['property_name'].'<br>'.
							$value['property_address'].'<br>'.
							$value['property_city'].', '.$value['property_state'].' '.$value['property_zip'].'
							<br>
							'.$value['apt_contact_email_1'].' '.$value['apt_contact_email_2'].' '.$value['apt_contact_email_3'].' '.$value['apt_contact_email_4'].'
							<br>
							'.$value['property_phone'].'
							<hr style="height:3px; border:none; color:#000; background-color:#4286f4;">
							<span style="font-size:.9em; color:#000; font-family:arial;">'.$value['inv_notes'].'</span><br>
							<br>
						';

						$this_sub_total = 0;
						for ($x=1; $x < 14; $x++) { 
							if($value['item_'.$x] == '' || $value['item_'.$x] == NULL || $value['item_'.$x] == 'NULL' || $value['item_'.$x] == ' '){
								$text = '';
							}else{
								$this_sub_total = $this_sub_total + $value['cost_'.$x];
								$text = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEM ".$x.":&nbsp;".$value['item_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start Date:&nbsp;".$value['start_date_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date:&nbsp;".$value['end_date_'.$x];

								if($value['deduction_'.$x] === '0' || $value['deduction_'.$x] === 0){
									$text_c = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_c;
								}else{
									$text_b = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Base Cost:&nbsp;$".$value['base_cost_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deduction:&nbsp;-$".$value['deduction_'.$x]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Cost:&nbsp;$".$value['cost_'.$x]."</span><br>";
									$text .= $text_b;
								}
							}
							$message .= $text;
						}
						$sub_total = "<span style='font-size:.8em; color:#7a3f00; font-family:arial;'>&bull;&nbsp;ITEMS SUB TOTAL: $".$this_sub_total."</span><br><br>";
						$message .= $sub_total;

						for ($q=1; $q < 14; $q++) { 
							if($value['payment_'.$q] == '' || $value['payment_'.$q] == NULL || $value['payment_'.$q] == 'NULL' || $value['payment_'.$q] == ' ' || $value['payment_'.$q] == '0' || $value['payment_'.$q] == 0){
								$text_d = '';
							}else{
								$text_d = "<span style='font-size:.8em; color:#30540d; font-family:arial;'>&bull;&nbsp;PAYMENT ".$i.":&nbsp;".$value['payment_'.$q.'_type']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;".$value['payment_'.$q.'_date']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								if($value['payment_'.$q.'_check_num'] == '' || $value['payment_'.$q.'_check_num'] == NULL || $value['payment_'.$q.'_check_num'] == 'NULL' || $value['payment_'.$q.'_check_num'] == ' ' || $value['payment_'.$i.'_check_num'] == '0' || $value['payment_'.$i.'_check_num'] == 0){
									$text_f = "Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d.= $text_f;
								}else{
									$text_f = "Check Number:&nbsp;".$value['payment_'.$q.'_check_num']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Amount:&nbsp;$".$value['payment_'.$q]."</span><br>";
									$text_d .= $text_f;
								}
							}
							$message .= $text_d;
						}

						$message_foot = 
						'<h3>AMOUNT CURRENTLY DUE: $'.$value['invoice_balance'].'</h3>
						<hr style="height:3px; border:none; color:#000; background-color:#4286f4;">
						Please Send Payment To:<br>
						Bay Rum Media<br>
						PO Box 2584<br>
						San Angelo, TX<br>
						76902
						<hr style="height:3px; border:none; color:#000; background-color:#4286f4;">
						<br><br><br><br>
						</body>';

						$message .= $message_foot;

						$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS BILLING');
						$this->email->to($value['apt_contact_email_'.$i]);
						$this->email->subject($subject);
						$this->email->message($message);
						$this->email->send();
						// echo $message;
					}
				}
			}

			$return_data['current_set_sent'] = 'CURRENT SENT';	
			return($return_data);
		}

	}








}
?>
