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

		// print_r($amenities);

			foreach ($amenities as $amenity) {
				$data = array('apt_id' => $apt_id, 'name' => $amenity, 'active' => 'N', 'select_units' => 'N', 'extra_fees' => 'N');
				$insert = $this->db->insert('our_amenities_list', $data); 
			}
	}



}
?>
