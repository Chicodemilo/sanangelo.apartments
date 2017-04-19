<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function get_main_info($apt_id){
		$this->db->where('ID', $apt_id);
		$data = $this->db->get('apartment_main')->result_array();
		return $data;
	}

	public function get_count_data($apt_id){
		$this->db->where('apt_id', $apt_id);
	}

	public function get_adv_mssg($apt_id){
		$data = $this->db->get('site_promos')->result_array();
		$on = $data[0]['adv_mssg_on'];
		$start = $data[0]['adv_mssg_start'];
		$end = $data[0]['adv_mssg_end'];
		$now = date('Y-m-d');

		$this->db->where('ID', $apt_id);
		$their_data = $this->db->get('apartment_main')->result_array();
		$their_on = $their_data[0]['this_adv_mssg_on'];
		$their_start = $their_data[0]['this_adv_mssg_start'];
		$their_end = $their_data[0]['this_adv_mssg_end'];

		if($on == 'Y' && $start <= $now && $end > $now){
			$return_data['adv_mssg'] = $data[0]['adv_mssg_mssg'];
			$return_data['adv_pic'] = $data[0]['adv_mssg_pic'];
			if($their_on == 'Y' && $their_start <= $now && $their_end > $now){
				$return_data['their_mssg'] = $their_data[0]['this_adv_mssg_mssg'];
				return $return_data;
			}else{
				$return_data['their_mssg'] = 'N';
				return $return_data;
			}
			
		}else{
			$return_data['adv_mssg'] = 'N';
			$return_data['adv_pic'] = 'N';
			if($their_on == 'Y' && $their_start <= $now && $their_end > $now){
				$return_data['their_mssg'] = $their_data[0]['this_adv_mssg_mssg'];
				return $return_data;
			}else{
				$return_data['their_mssg'] = 'N';
				return $return_data;
			}
		}
	}

	public function get_our_amenities($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('our_amenities_list');
		return $data;
	}	

	public function get_thier_amenities($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('their_amenities_list');
		return $data;
	}

	public function get_hours($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('office_hours');
		return $data;
	}	

	public function get_floorplans($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('floorplans');
		return $data;
	}

	public function get_flooplan_info($apt_id, $id){
		$this->db->where('apt_id', $apt_id);
		$this->db->where('id', $id);
		$data = $this->db->get('floorplans');
		return $data;
	}


	public function get_pets($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('pet_policy');
		return $data;
	}


	public function get_specials($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('special');
		return $data;
	}


	public function get_user($id){
		$this->db->where('ID', $id);
		$data = $this->db->get('users');
		return $data;
	}

	public function get_recent_logins($id){
		$this->db->where('user_id', $id);
		$this->db->limit(0,20);
		$this->db->order_by('login_time', 'desc');
		$data = $this->db->get('session_data');
		return $data;
	}

	public function get_pictures($apt_id){
		$this->db->where('logo', 'N');
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('pic_order', 'asc');
		$data = $this->db->get('pictures');
		return $data;
	}

	public function reorder_pictures($apt_id){
		$this->db->where('logo', 'N');
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('pic_order', 'asc');
		$data = $this->db->get('pictures')->result_array();
		$x = 1;
		foreach ($data as $value) {
			$number['pic_order'] = $x;
			$this->db->where('id', $value['id']);
			$this->db->update('pictures', $number);
			$x = $x + 1;
		}
	}


	public function get_new_picture_data($apt_id){
		// $this->db->where('apt_id', $apt_id);
		$this->db->order_by('id', 'desc');
		$ids = $this->db->get('pictures')->result_array();
		if(count($ids) > 0){
			$id_new = $ids[0]['id'] + 1;
		}else{
			$id_new = 1;
		}
		

		$this->db->where('logo', 'N');
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('pic_order', 'desc');
		$orders = $this->db->get('pictures')->result_array();
		if(count($orders) > 0){
			$order_new = $orders[0]['pic_order'] + 1;
		}else{
			$order_new = 1;
		}
		
		$data = array('id' => $id_new, 'apt_id' => $apt_id, 'cover_pic' => 'N', 'logo' => 'N', 'pic_order' => $order_new, 'active' => 'Y');
		return $data;
	}


	public function get_picture_data($apt_id, $id){
		$this->db->where('apt_id', $apt_id);
		$this->db->where('id', $id);
		$data = $this->db->get('pictures')->result_array();
		return $data;
	}


	public function make_cover_pic($apt_id, $id){
		$data['cover_pic'] = 'N';
		$this->db->where('apt_id', $apt_id);
		$this->db->where('cover_pic', 'Y');
		$this->db->update('pictures', $data);
		$data['cover_pic'] = 'Y';
		$this->db->where('apt_id', $apt_id);
		$this->db->where('id', $id);
		$this->db->update('pictures', $data);
	}

	public function make_logo($apt_id, $id){
		$data['logo'] = 'N';
		$this->db->where('apt_id', $apt_id);
		$this->db->where('logo', 'Y');
		$this->db->update('pictures', $data);
		$data['logo'] = 'Y';
		$this->db->where('apt_id', $apt_id);
		$this->db->where('id', $id);
		$this->db->update('pictures', $data);
	}

	public function insert_pic_in_order($apt_id, $id, $pic_order, $old_order){
		if($pic_order < $old_order){
			$this->db->where('logo', 'N');
			$this->db->where('apt_id', $apt_id);
			$this->db->where('pic_order >= ', $pic_order);
			$this->db->where('pic_order <', $old_order);
			$data = $this->db->get('pictures')->result_array();
			$start = $pic_order + 1;
			foreach ($data as $key => $value) {
				$insert_data['pic_order'] = $start;
				$this->db->where('id', $value['id']);
				$this->db->where('apt_id', $apt_id);
				$this->db->update('pictures', $insert_data);
				$start = $start + 1;
			}
			$data_b['pic_order'] = $pic_order;
			$this->db->where('id', $id);
			$this->db->where('apt_id', $apt_id);
			$this->db->update('pictures', $data_b);
		}else{
			$this->db->where('logo', 'N');
			$this->db->where('apt_id', $apt_id);
			$this->db->where('pic_order > ', $old_order);
			$this->db->where('pic_order <=', $pic_order);
			$data = $this->db->get('pictures')->result_array();
			$start = $old_order;
			foreach ($data as $key => $value) {
				$insert_data['pic_order'] = $start;
				$this->db->where('apt_id', $apt_id);
				$this->db->where('id', $value['id']);
				$this->db->update('pictures', $insert_data);
				$start = $start + 1;
			}
			$data_b['pic_order'] = $pic_order;
			$this->db->where('apt_id', $apt_id);
			$this->db->where('id', $id);
			$this->db->update('pictures', $data_b);
		}
	}


	public function get_new_logo_data($apt_id){
		// $this->db->where('apt_id', $apt_id);
		$this->db->order_by('id', 'desc');
		$ids = $this->db->get('pictures')->result_array();
		$id_new = $ids[0]['id'] + 1;
		$order_new = null;
		$data = array('id' => $id_new, 'apt_id' => $apt_id, 'cover_pic' => 'N', 'logo' => 'N', 'pic_order' => $order_new, 'active' => 'Y', 'logo' => 'Y');
		return $data;
	}


	public function get_logo($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->where('logo', 'Y');
		$this->db->order_by('pic_order', 'asc');
		$data = $this->db->get('pictures');
		return $data;
	}

	public function get_new_man_logo_data(){
		$this->db->order_by('id', 'desc');
		$ids = $this->db->get('pictures')->result_array();
		$id_new = $ids[0]['id'] + 1;
		$order_new = null;
		$data = array('id' => $id_new, 'name' => '', 'caption' => '', 'cover_pic' => 'N', 'logo' => 'N', 'management_logo' => 'N', 'amenities_page_main_pic' => 'N', 'picture_page_main_pic' => 'N', 'pic_order' => $order_new, 'active' => 'Y', 'management_logo' => 'Y');
		return $data;
	}


	public function get_man_logo($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('man_logo');
		return $data;
	}

	public function get_messages($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('time', 'desc');
		$data = $this->db->get('contact');
		return $data;
	}

	public function send_thanks_email($email_data){
		$this->load->library('email');
        $this->email->clear();
        $this->email->from('donotreply@'.WEBSITELOWER, WEBSITE);
        $this->email->to('miles@bayrummedia.com');
        $this->email->subject($email_data['apt_name'].' Purchased A '.$email_data['item'].' on '.WEBSITE);
        $this->email->message(
                            'Username: '.$this->session->userdata('username').
                            '<br>Apartment Name: '.$email_data['apt_name'].
                            '<br>Item: '.$email_data['item'].
                            '<br>Start Date: '.$email_data['start_date'].
                            '<br>End Date: '.$email_data['end_date'].
                            '<br>Cost: $'.$email_data['cost'].
                            '<br>Left Banner: '.$email_data['left_takeover_name'].
                            '<br>Right Banner: '.$email_data['right_takeover_name'].
                            '<br>Top Banner: '.$email_data['top_takeover_name'].
                            '<br>Mobile Banner: '.$email_data['mobile_takeover_name']
                            );
        $sent = $this->email->send();

        $this->db->where('ID', $this->session->userdata('user_id'));
		$user_emails = $this->db->get('users')->result_array();

		if($user_emails[0]['email'] != ''){
			$send['email_one'] = $user_emails[0]['email'];
		}
		if($user_emails[0]['email_2'] != ''){
			$send['email_two'] = $user_emails[0]['email_2'];
		}
		if($user_emails[0]['email'] != ''){
			$send['email_three'] = $user_emails[0]['email_3'];
		}
		if($user_emails[0]['email'] != ''){
			$send['email_four'] = $user_emails[0]['email_4'];
		}

		foreach ($send as $key => $value) {

			if($email_data['item'] == 'top_3'){
				$message = '<h3 style="color:#3F79C9;">'.$email_data['apt_name'].' has a scheduled a TOP 3 BANNER on '.WEBSITE.'</h3>'.
                '<br>Start Date: '.$email_data['start_date'].
                '<br>End Date: '.$email_data['end_date'].
                '<br>Cost: $'.$email_data['cost'].
                '<br>Your invoice will be emailed to you at the end of the month that your TOP 3 BANNER runs.
                <br>Login to '.WEBSITE.' to see this and your other ads: <a href="'.base_url().'login/login_user">LOGIN</a>.
                <br><br>Thanks,<br>
                '.WEBSITE
				;
			}elseif($email_data['item'] == 'premium_level'){
				$message = '<h3 style="color:#3F79C9;">'.$email_data['apt_name'].' has a scheduled PREMIUM MEMBERSHIP on '.WEBSITE.'</h3>'.
                '<br>Start Date: '.$email_data['start_date'].
                '<br>End Date: '.$email_data['end_date'].
                '<br>Cost: $'.$email_data['cost'].'/month'.
                '<br>Your invoice will be emailed to you at the end of each month that your PREMIUM MEMBERSHIP runs.
                <br>Login to '.WEBSITE.' to see this and your other ads: <a href="'.base_url().'login/login_user">LOGIN</a>.
                <br><br>Thanks,<br>
                '.WEBSITE
				;
			}elseif($email_data['item'] == 'site_takeover'){
				$message = '<h3 style="color:#3F79C9;">'.$email_data['apt_name'].' has a scheduled SITE TAKEOVER on '.WEBSITE.'</h3>'.
                '<br>Run Date: '.$email_data['start_date'].
                '<br>Cost: $'.$email_data['cost'].'/day'.
                '<br>Left Banner Name: '.$email_data['left_takeover_name'].
                '<br>Right Banner Name: '.$email_data['right_takeover_name'].
                '<br>Top Banner Name: '.$email_data['top_takeover_name'].
                '<br>Mobile Banner Name: '.$email_data['mobile_takeover_name'].
                '<br><br> *** If any Banner Names are blank, please login to your account and upload a banner before the day your SITE TAKEOVER runs. ***'.
                '<br><br>&bull; File types .jpg .gif and .png are accepted for banners.'.
                '<br>&bull; Left and Right banners are 170px wide by 700px tall.'.
                '<br>&bull; Top banner is 870px wide by 80px tall.'.
                '<br>&bull; Mobile banner is 400px wide by 175px tall.'.
                '<br><br>Your SITE TAKEOVER will run even if you have not uploaded your banners.'.
                '<br>If you need help with your banners please contact us'.
                '<br><br>Your invoice will be emailed to you at the end of the month that your SITE TAKEOVER runs.
                <br>Login to '.WEBSITE.' to see this and your other ads: <a href="'.base_url().'login/login_user">LOGIN</a>.
                <br><br>Thanks,<br>
                '.WEBSITE
				;
			}

			$this->email->clear();
			$this->email->from('donotreply@'.WEBSITELOWER, WEBSITE);
			$this->email->to($value);
			$this->email->subject('Your Scheduled Ad On '.WEBSITE);
			$this->email->message($message);
			$sent = $this->email->send();
		}
	}


	public function send_special_sto_email($email_data){
		$this->load->library('email');

        $this->db->where('ID', $this->session->userdata('user_id'));
		$user_emails = $this->db->get('users')->result_array();

		if($user_emails[0]['email'] != ''){
			$send['email_one'] = $user_emails[0]['email'];
		}
		if($user_emails[0]['email_2'] != ''){
			$send['email_two'] = $user_emails[0]['email_2'];
		}
		if($user_emails[0]['email'] != ''){
			$send['email_three'] = $user_emails[0]['email_3'];
		}
		if($user_emails[0]['email'] != ''){
			$send['email_four'] = $user_emails[0]['email_4'];
		}

		foreach ($send as $key => $value) {
			$message = '<h3 style="color:#3F79C9;"> Promote your special on '.WEBSITE.'!</h3>'.
	        '<br>We have a few different ways to promote your new special on our site.'.
	        '<br><br>Consider a SITE TAKEOVER...
			Only <span class="adv_stickout">$'.$email_data['site_takeover'].' A DAY</span>!
					</div>
					<ul style="line-height: 1.9;">
						<li>Your Apartment Is Listed FIRST All Day Long On...
							<ul class="small_ul">
								<li>The Home Page</li>
								<li>The Map Page</li>
								<li>Search Results Pages</li>
								<li>List Of Open Apartments</li>
								<li>List Of Monthly Specials</li>
							</ul>

						</li>
						<li>Your Advertising BANNERS On the Left, Right & Center Of Our Homepage - All Link To Your Website!</li>
						<li>Your Mobile Banner Appears and Disolves On Our MOBILE Site</li>
						<li>A FACEBOOK Promotion On OUR FB Page On The Day Of Your Takeover... <a href="'.FBPAGE.'" target="blank">See Our FB Page</a></li>
						<li>We\'ll Help You Make Your Banner Ads</li>
						<li>Commitment Free! A Site Takeover Is One Day At A Time</li>
					</ul>'.
	        '<br>Login to '.WEBSITE.' to see your options for site promotions: <a href="'.base_url().'login/login_user">LOGIN</a>.
	        <br><br>Thanks,<br>
	        '.WEBSITE.'
	        <br><br>
	        PS.<br>
	        There\'s Nothing To Pay Today!<br>
			We will send you an invoice at the end the month of your SITE TAKEOVER runs.<br>'
			;

			$this->email->clear();
			$this->email->from('donotreply@'.WEBSITELOWER, WEBSITE);
			$this->email->to($value);
			$this->email->subject('Promote Your New Special On '.WEBSITE);
			$this->email->message($message);
			$sent = $this->email->send();
		}
	}
















































}
?>
