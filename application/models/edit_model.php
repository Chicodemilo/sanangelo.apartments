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




}
?>