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
		$servername = "localhost";
		$username = "root";
		$password = "test";
		$dbname = "sanangelo_apartments";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "SELECT ID, property_name, property_search_name, verified_user_id, property_phone FROM apartment_main WHERE suspend != 'Y'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			return $result;
		}
		$conn->close();
	}


	public function get_all_suspended_apts(){
		$servername = "localhost";
		$username = "root";
		$password = "test";
		$dbname = "sanangelo_apartments";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "SELECT ID, property_name, property_search_name, verified_user_id, property_phone FROM apartment_main WHERE suspend = 'Y'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			return $result;
		}
		$conn->close();
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
			$data['apt_contact_email'] = $value['email'];
			$data['apt_contact_email_2'] = $value['email_2'];
			$data['apt_contact_email_3'] = $value['email_3'];
			$data['apt_contact_email_4'] = $value['email_4'];
		}

		return $data;
	}


	public function invoice_sets_created_today(){
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


	public function make_these_invoices($these_unique_ids){

            $this->load->model('admin_model');
            $inv_count = $this->admin_model->invoice_sets_created_today() + 1;
            
            echo $inv_count."<br>";

            foreach ($these_unique_ids as $value){
                $this->load->model('admin_model');
                $apt_data = $this->admin_model->get_ad_info_for_inv($value);
				
                $query = $this->db->get('invoice')->result_array();
                $counter = count($query) + 3000;

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







}
?>
