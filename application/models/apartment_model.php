<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apartment_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}



	public function get_top_of_nav(){
		$this->db->where('main_page_top', 'Y');
		$this->db->order_by('apt_id', 'RANDOM');
		$paid_top = $this->db->get('sales')->result_array();
		// print_r(count($paid_top));

		//Get 3 Random Apartments
		if(count($paid_top) == 0){
			$this->db->where('show_top', 'Y');
			$this->db->order_by('ID', 'RANDOM');
			$this->db->limit('3');
			$result = $this->db->get('apartment_main')->result_array();

			//Put their ID into the return Data
			$data['pos_1']['ID'] = $result[0]['ID'];
			$data['pos_2']['ID'] = $result[1]['ID'];
			$data['pos_3']['ID'] = $result[2]['ID'];
   			
   			//Put their Name into the return Data
			$data['pos_1']['property_name'] = $result[0]['property_name'];
			$data['pos_2']['property_name'] = $result[1]['property_name'];
			$data['pos_3']['property_name'] = $result[2]['property_name'];
   			
   			//Put their Search Name into the return Data
			$data['pos_1']['property_search_name'] = $result[0]['property_search_name'];
			$data['pos_2']['property_search_name'] = $result[1]['property_search_name'];
			$data['pos_3']['property_search_name'] = $result[2]['property_search_name'];

			$i = 1;
			foreach ($result as $key => $value) {

				//Get Their Picture Data If They Have A Cover Picture
				$id = $value['ID'];
				$this->db->where('apt_id', $id);
				$this->db->where('cover_pic', 'Y');
				$this->db->where('logo', 'N');
				$pic_data = $this->db->get('pictures')->result_array();
				


				//Get Their Picture Data If They DON'T Have A Cover Picture
				if(count($pic_data) == 0){
					$this->db->where('apt_id', $id);
					$this->db->where('logo', 'N');
					$this->db->limit('1');
					$pic_data = $this->db->get('pictures')->result_array();
					

					//Use Generic Picture if they don't have any pictures
					if(count($pic_data) == 0){
						$data['pos_'.$i]['picture_id'] = 'generic';
						$data['pos_'.$i]['picture_name'] = 'generic.jpg';
					}else{
						$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
						$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
					}

				}else{
					$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
					$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
				}

				$i = ++$i;

			}
			
			return $data;
		}

		if(count($paid_top) == 1){
			$not_in = array('0' => $paid_top[0]['apt_id'] );
			$this->db->order_by('ID', 'RANDOM');
			$this->db->where_not_in('ID', $not_in);
			$this->db->limit('2');
			$result = $this->db->get('apartment_main')->result_array();

			$this->db->where('ID', $paid_top[0]['apt_id']);
			$result_paid = $this->db->get('apartment_main')->result_array();

			//Put their ID into the return Data
			$data['pos_1']['ID'] = $result[0]['ID'];
			$data['pos_2']['ID'] = $result_paid[0]['ID'];
			$data['pos_3']['ID'] = $result[1]['ID'];
   			
   			//Put their Name into the return Data
			$data['pos_1']['property_name'] = $result[0]['property_name'];
			$data['pos_2']['property_name'] = $result_paid[0]['property_name'];
			$data['pos_3']['property_name'] = $result[1]['property_name'];
   			
   			//Put their Search Name into the return Data
			$data['pos_1']['property_search_name'] = $result[0]['property_search_name'];
			$data['pos_2']['property_search_name'] = $result_paid[0]['property_search_name'];
			$data['pos_3']['property_search_name'] = $result[1]['property_search_name'];

			foreach ($result_paid as $key => $value) {

				//Get Their Picture Data If They Have A Cover Picture
				$id = $value['ID'];
				$this->db->where('apt_id', $id);
				$this->db->where('cover_pic', 'Y');
				$pic_data = $this->db->get('pictures')->result_array();
				


				//Get Their Picture Data If They DON'T Have A Cover Picture
				if(count($pic_data) == 0){
					$this->db->where('apt_id', $id);
					$this->db->where('logo', 'N');
					$this->db->limit('1');
					$pic_data = $this->db->get('pictures')->result_array();
					

					//Use Generic Picture if they don't have any pictures
					if(count($pic_data) == 0){
						$data['pos_2']['picture_id'] = 'generic';
						$data['pos_2']['picture_name'] = 'generic.jpg';
					}else{
						$data['pos_2']['picture_id'] = $pic_data[0]['id'];
						$data['pos_2']['picture_name'] = $pic_data[0]['name'];
					}

				}else{
					$data['pos_2']['picture_id'] = $pic_data[0]['id'];
					$data['pos_2']['picture_name'] = $pic_data[0]['name'];
				}
			}

			$i = 1;
			foreach ($result as $key => $value) {

				//Get Their Picture Data If They Have A Cover Picture
				$id = $value['ID'];
				$this->db->where('apt_id', $id);
				$this->db->where('cover_pic', 'Y');
				$pic_data = $this->db->get('pictures')->result_array();
				


				//Get Their Picture Data If They DON'T Have A Cover Picture
				if(count($pic_data) == 0){
					$this->db->where('apt_id', $id);
					$this->db->where('logo', 'N');
					$this->db->limit('1');
					$pic_data = $this->db->get('pictures')->result_array();
					

					//Use Generic Picture if they don't have any pictures
					if(count($pic_data) == 0){
						$data['pos_'.$i]['picture_id'] = 'generic';
						$data['pos_'.$i]['picture_name'] = 'generic.jpg';
					}else{
						$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
						$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
					}

				}else{
					$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
					$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
				}

				$i = 3;

			}
			
			return $data;
		}


		if(count($paid_top) == 2){
			$not_in = array('0' => $paid_top[0]['apt_id'], '1' => $paid_top[1]['apt_id']);
			$this->db->order_by('ID', 'RANDOM');
			$this->db->where_not_in('ID', $not_in);
			$this->db->limit('1');
			$result = $this->db->get('apartment_main')->result_array();

			$this->db->where('ID', $paid_top[0]['apt_id']);
			$result_paid[0] = $this->db->get('apartment_main')->result_array();

			$this->db->where('ID', $paid_top[1]['apt_id']);
			$result_paid[1] = $this->db->get('apartment_main')->result_array();


			//Put their ID into the return Data
			$data['pos_1']['ID'] = $result[0]['ID'];
			$data['pos_2']['ID'] = $result_paid[0][0]['ID'];
			$data['pos_3']['ID'] = $result_paid[1][0]['ID'];
   			
   			//Put their Name into the return Data
			$data['pos_1']['property_name'] = $result[0]['property_name'];
			$data['pos_2']['property_name'] = $result_paid[0][0]['property_name'];
			$data['pos_3']['property_name'] = $result_paid[1][0]['property_name'];
   			
   			//Put their Search Name into the return Data
			$data['pos_1']['property_search_name'] = $result[0]['property_search_name'];
			$data['pos_2']['property_search_name'] = $result_paid[0][0]['property_search_name'];
			$data['pos_3']['property_search_name'] = $result_paid[1][0]['property_search_name'];

			$i = 2;
			$x = 0;
			foreach ($result_paid as $key => $value) {

				//Get Their Picture Data If They Have A Cover Picture
				$id = $value[0]['ID'];
				$this->db->where('apt_id', $id);
				$this->db->where('cover_pic', 'Y');
				$pic_data = $this->db->get('pictures')->result_array();
				


				//Get Their Picture Data If They DON'T Have A Cover Picture
				if(count($pic_data) == 0){
					$this->db->where('apt_id', $id);
					$this->db->where('logo', 'N');
					$this->db->limit('1');
					$pic_data = $this->db->get('pictures')->result_array();
					

					//Use Generic Picture if they don't have any pictures
					if(count($pic_data) == 0){
						$data['pos_'.$i]['picture_id'] = 'generic';
						$data['pos_'.$i]['picture_name'] = 'generic.jpg';
					}else{
						$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
						$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
					}

				}else{
					$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
					$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
				}
				$i = 3;
				$x = 1;
			}

			foreach ($result as $key => $value) {

				//Get Their Picture Data If They Have A Cover Picture
				$id = $value['ID'];
				$this->db->where('apt_id', $id);
				$this->db->where('cover_pic', 'Y');
				$pic_data = $this->db->get('pictures')->result_array();
				


				//Get Their Picture Data If They DON'T Have A Cover Picture
				if(count($pic_data) == 0){
					$this->db->where('apt_id', $id);
					$this->db->where('logo', 'N');
					$this->db->limit('1');
					$pic_data = $this->db->get('pictures')->result_array();
					

					//Use Generic Picture if they don't have any pictures
					if(count($pic_data) == 0){
						$data['pos_1']['picture_id'] = 'generic';
						$data['pos_1']['picture_name'] = 'generic.jpg';
					}else{
						$data['pos_1']['picture_id'] = $pic_data[0]['id'];
						$data['pos_1']['picture_name'] = $pic_data[0]['name'];
					}

				}else{
					$data['pos_1']['picture_id'] = $pic_data[0]['id'];
					$data['pos_1']['picture_name'] = $pic_data[0]['name'];
				}
			}	
			return $data;
		}


		if(count($paid_top) == 3){

			$this->db->where('ID', $paid_top[0]['apt_id']);
			$result_paid[0] = $this->db->get('apartment_main')->result_array();

			$this->db->where('ID', $paid_top[1]['apt_id']);
			$result_paid[1] = $this->db->get('apartment_main')->result_array();

			$this->db->where('ID', $paid_top[2]['apt_id']);
			$result_paid[2] = $this->db->get('apartment_main')->result_array();


			//Put their ID into the return Data
			$data['pos_1']['ID'] = $result_paid[0][0]['ID'];
			$data['pos_2']['ID'] = $result_paid[1][0]['ID'];
			$data['pos_3']['ID'] = $result_paid[2][0]['ID'];
   			
   			//Put their Name into the return Data
			$data['pos_1']['property_name'] = $result_paid[0][0]['property_name'];
			$data['pos_2']['property_name'] = $result_paid[1][0]['property_name'];
			$data['pos_3']['property_name'] = $result_paid[2][0]['property_name'];
   			
   			//Put their Search Name into the return Data
			$data['pos_1']['property_search_name'] = $result_paid[0][0]['property_search_name'];
			$data['pos_2']['property_search_name'] = $result_paid[1][0]['property_search_name'];
			$data['pos_3']['property_search_name'] = $result_paid[2][0]['property_search_name'];

			$i = 1;
			foreach ($result_paid as $key => $value) {

				//Get Their Picture Data If They Have A Cover Picture
				$id = $value[0]['ID'];
				$this->db->where('apt_id', $id);
				$this->db->where('cover_pic', 'Y');
				$pic_data = $this->db->get('pictures')->result_array();

				//Get Their Picture Data If They DON'T Have A Cover Picture
				if(count($pic_data) == 0){
					$this->db->where('apt_id', $id);
					$this->db->where('logo', 'N');
					$this->db->limit('1');
					$pic_data = $this->db->get('pictures')->result_array();
					

					//Use Generic Picture if they don't have any pictures
					if(count($pic_data) == 0){
						$data['pos_'.$i]['picture_id'] = 'generic';
						$data['pos_'.$i]['picture_name'] = 'generic.jpg';
					}else{
						$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
						$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
					}

				}else{
					$data['pos_'.$i]['picture_id'] = $pic_data[0]['id'];
					$data['pos_'.$i]['picture_name'] = $pic_data[0]['name'];
				}
				$i = ++$i;
			}	
			return $data;
		}
	}

	public function add_views($apt_id){
		$this->db->where('ID', $apt_id);
		$old_views = $this->db->get('apartment_main')->result_array();

		$new_views['views_all'] = $old_views[0]['views_all'] + 1;
		$new_views['views_year'] = $old_views[0]['views_all'] + 1;
		$new_views['views_month'] = $old_views[0]['views_month'] + 1;
		$new_views['views_day'] = $old_views[0]['views_day'] + 1;

		$this->db->where('ID', $apt_id);
		$this->db->update('apartment_main', $new_views);
	}

	public function get_views(){
		date_default_timezone_set('America/Chicago');
		$year = date('Y');
		$month = date('n');
		$day = date('j');
		$this->db->where('year', $year);
		$old_dates = $this->db->get('site_data')->result_array();

		if(count($old_dates) == 0){
			$this->db->where('year', $year-1);
			$old_dates = $this->db->get('site_data')->result_array();
		}

		$old_year = $old_dates['0']['year'];
		$old_month = $old_dates['0']['last_month'];
		$old_day = $old_dates['0']['last_day'];

		if($year != $old_year){
			$data['year'] = $year;
			$data['last_month'] = $month;
			$data['last_day'] = $day;

			$this->db->insert('site_data', $data);

			$this->db->order_by('views_year', 'desc');
			$year_winner = $this->db->get('apartment_main')->result_array();

			$this->db->order_by('views_month', 'desc');
			$month_winner = $this->db->get('apartment_main')->result_array();

			$winners['year_winner'] = $year_winner[0]['property_search_name'];
			$winners['year_winner_tot_views'] = $year_winner[0]['views_year'];
			$winners[$old_month.'_month_winner'] = $month_winner[0]['property_search_name'];
			$winners[$old_month.'_month_winner_tot_views'] = $month_winner[0]['views_month'];

			$year_tot_count = 0;
			foreach ($year_winner as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == "views_year"){
						$year_tot_count = $year_tot_count + $value_b;
					}
				}
			}

			$month_tot_count = 0;
			foreach ($month_winner as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == "views_month"){
						$month_tot_count = $year_tot_count + $value_b;
					}
				}
			}

			$winners['tot_site_views'] = $year_tot_count;
			$winners[$old_month.'_month_tot_views'] = $year_tot_count;

			$this->db->where('year', $old_year);
			$this->db->update('site_data', $winners);

			foreach ($year_winner as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == 'ID'){
						$apt_id = $value_b;
					}
					if($key_b == 'views_year'){
						$view_shift['views_year'] = 0;
						$view_shift['views_last_year'] = $value_b;
					}
					if($key_b == 'views_month'){
						$view_shift['views_month'] = 0;
						$view_shift['views_last_month'] = $value_b;
					}
					if($key_b == 'views_day'){
						$view_shift['views_day'] = 0;
						$view_shift['views_last_day'] = $value_b;
						$this->db->where('ID', $apt_id);
						$this->db->update('apartment_main', $view_shift);
					}
				}
			}


		}elseif($month != $old_month){
			$data['last_month'] = $month;
			$data['last_day'] = $day;

			$this->db->where('year', $year);
			$this->db->update('site_data', $data);

			$this->db->order_by('views_year', 'desc');
			$year_winner = $this->db->get('apartment_main')->result_array();

			$this->db->order_by('views_month', 'desc');
			$month_winner = $this->db->get('apartment_main')->result_array();

			
			$winners[$old_month.'_month_winner'] = $month_winner[0]['property_search_name'];
			$winners[$old_month.'_month_winner_tot_views'] = $month_winner[0]['views_month'];

			$year_tot_count = 0;
			foreach ($year_winner as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == "views_year"){
						$year_tot_count = $year_tot_count + $value_b;
					}
				}
			}

			$month_tot_count = 0;
			foreach ($month_winner as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == "views_month"){
						$month_tot_count = $year_tot_count + $value_b;
					}
				}
			}

			$winners['tot_site_views'] = $year_tot_count;
			$winners[$old_month.'_month_tot_views'] = $year_tot_count;

			$this->db->where('year', $year);
			$this->db->update('site_data', $winners);

			foreach ($year_winner as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == 'ID'){
						$apt_id = $value_b;
					}
					if($key_b == 'views_month'){
						$view_shift['views_month'] = 0;
						$view_shift['views_last_month'] = $value_b;
					}
					if($key_b == 'views_day'){
						$view_shift['views_day'] = 0;
						$view_shift['views_last_day'] = $value_b;
						$this->db->where('ID', $apt_id);
						$this->db->update('apartment_main', $view_shift);
					}
				}
			}

		}elseif($day != $old_day){
			$data['last_day'] = $day;

			$this->db->where('year', $year);
			$this->db->update('site_data', $data);

			$this->db->order_by('views_year', 'desc');
			$year_winner = $this->db->get('apartment_main')->result_array();

			foreach ($year_winner as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == 'ID'){
						$apt_id = $value_b;
					}
					if($key_b == 'views_day'){
						$view_shift['views_day'] = 0;
						$view_shift['views_last_day'] = $value_b;
						$this->db->where('ID', $apt_id);
						$this->db->update('apartment_main', $view_shift);
					}
				}
			}

		}

		$this->db->order_by('views_month', 'desc');
		$this->db->limit('4');
		$results = $this->db->get('apartment_main')->result_array();
		return $results;

	}

	public function get_takeover_bg_info(){
		$this->db->where('takeover', 'Y');
		$takeover = $this->db->get('sales')->result_array();
		
		$data['takeover_id'] = $takeover[0]['apt_id'];
		$data['takeover_left'] = $takeover[0]['left_takeover_name'];
		$data['takeover_right'] = $takeover[0]['right_takeover_name'];
		$data['takeover_mobile'] = $takeover[0]['mobile_takeover_name'];
		$data['takeover_top'] = $takeover[0]['top_takeover_name'];
		$data['takeover_start'] = $takeover[0]['takeover_start'];
		$data['takeover_end'] = $takeover[0]['takeover_end'];

		$this->db->where('ID', $data['takeover_id']);
		$takeover_link = $this->db->get('apartment_main')->result_array();
		if(!$takeover_link[0]['property_website']){
			$data['takeover_link'] = 'N';
		}else{
			$data['takeover_link'] = $takeover_link[0]['property_website'];
		}
		return $data;
	}


	public function get_market_data(){

		#get all aptment floorplan data and figure average cost per sq. foot
		$all_apts = $this->db->get('floorplans')->result_array();
		$all_rent = 0;
		$all_sq_ft = 0;
		foreach ($all_apts as $key => $value) {
			foreach ($value as $key_b => $value_b) {
				if($key_b == 'rent'){
					$all_rent = $all_rent + $value_b;
				}
			}
		}
		foreach ($all_apts as $key => $value) {
			foreach ($value as $key_b => $value_b) {
				if($key_b == 'square_footage'){
					$all_sq_ft = $all_sq_ft + $value_b;
				}
			}
		}

		$data['ave_sq_ft'] = round(($all_rent / $all_sq_ft), 2);

		#get the average rent for one bedroom apartments
		$this->db->where('bedroom', 1);
		$one_bed = $this->db->get('floorplans')->result_array();

		$all_rent = 0;
		$apt_count = count($one_bed);

		if($apt_count > 0){
			foreach ($one_bed as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == 'rent'){
						$all_rent = $all_rent + $value_b;
					}
				}
			}
			$data['ave_one_bed_rent'] = round(($all_rent / $apt_count), 0);
		}else{
			$data['ave_one_bed_rent'] = 0;
		}

		#get the average rent for two bedroom apartments
		$this->db->where('bedroom', 2);
		$two_bed = $this->db->get('floorplans')->result_array();

		$all_rent = 0;
		$apt_count = count($two_bed);

		if($apt_count > 0){
			foreach ($two_bed as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == 'rent'){
						$all_rent = $all_rent + $value_b;
					}
				}
			}
			$data['ave_two_bed_rent'] = round(($all_rent / $apt_count), 0);
		}else{
			$data['ave_two_bed_rent'] = 0;
		}

		$date = date('d');
		if($date == 25){
			$this_date = date('Y-m-d');
			$this->db->where('date', $this_date);
			$date_check = $this->db->get('market_data')->result_array();
			if(count($date_check) < 1){
				$insert_data['date'] = $this_date;
				$insert_data['ave_one'] = $data['ave_one_bed_rent'];
				$insert_data['ave_two'] = $data['ave_two_bed_rent'];
				$insert_data['ave_sq_ft'] = $data['ave_sq_ft'];

				$this->db->insert('market_data', $insert_data);
			}
		}

		return $data;		
	}

	public function get_open_takeover_apt(){

		$this->db->where('takeover', 'Y');
		$takeover = $this->db->get('sales')->result_array();
		if(count($takeover) > 0){
			$takeover_id = $takeover[0]['apt_id'];

			$this->db->where('ID', $takeover_id);
			$result = $this->db->get('apartment_main')->result_array();

			$takeover_name = $result[0]['property_name'];
			$takeover_search_name = $result[0]['property_search_name'];

			$data['takeover_apt']['apt_id'] = $takeover_id;
			$data['takeover_apt']['property_name'] = $takeover_name;
			$data['takeover_apt']['property_search_name'] = $takeover_search_name;

			$this->db->where('apt_id', $takeover_id);
			$this->db->where('is_available', 'Y');
			$data['takeover_apt']['open_apts'] = $this->db->get('floorplans')->result_array();

			return $data;
		}else{
			return false;
		}
	}

	public function get_open_basic_apt(){
		$this->db->where('basic', 'Y');
		$this->db->where('takeover', 'N');
		$this->db->order_by('apt_id', 'RANDOM');
		$basics = $this->db->get('sales')->result_array();

		$i = 0;
		if(count($basics) > 0){
			foreach ($basics as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == 'apt_id'){
						$apt_id = $value_b;

						$this->db->where('apt_id', $apt_id);
						$this->db->where('is_available', 'Y');
						$data['basic_apt_'.$i]['open_apts'] = $this->db->get('floorplans')->result_array();

						if(count($data['basic_apt_'.$i]['open_apts']) > 0){
							$this->db->where('ID', $apt_id);
							$basic_apt = $this->db->get('apartment_main')->result_array();

							$data['basic_apt_'.$i]['apt_id'] = $apt_id;
							$data['basic_apt_'.$i]['property_name'] = $basic_apt[0]['property_name'];
							$data['basic_apt_'.$i]['property_search_name'] = $basic_apt[0]['property_search_name'];
						}else{
							$data['basic_apt_'.$i]['open_apts'] = '';
						}					

						$i = ++$i;
					}
				}
			}
			return $data;
		}else{
			return false;
		}

	}

	public function get_open_free_apt(){
		$this->db->where('free', 'Y');
		$this->db->where('takeover', 'N');
		$this->db->order_by('apt_id', 'RANDOM');
		$free = $this->db->get('sales')->result_array();

		$i = 0;
		if(count($free) > 0){
			foreach ($free as $key => $value) {
				foreach ($value as $key_b => $value_b) {
					if($key_b == 'apt_id'){
						$apt_id = $value_b;

						$this->db->where('apt_id', $apt_id);
						$this->db->where('is_available', 'Y');
						$data['free_apt_'.$i]['open_apts'] = $this->db->get('floorplans')->result_array();

						if(count($data['free_apt_'.$i]['open_apts']) > 0){
							$this->db->where('ID', $apt_id);
							$basic_apt = $this->db->get('apartment_main')->result_array();

							$data['free_apt_'.$i]['apt_id'] = $apt_id;
							$data['free_apt_'.$i]['property_name'] = $basic_apt[0]['property_name'];
							$data['free_apt_'.$i]['property_search_name'] = $basic_apt[0]['property_search_name'];
						}else{
							$data['free_apt_'.$i]['open_apts'] = '';
						}
						$i = ++$i;
					}
				}
			}
			return $data;
		}else{
			return false;
		}

	}

	public function get_special_takeover(){

		$this->db->where('takeover', 'Y');
		$takeover = $this->db->get('sales')->result_array();
		if(count($takeover) > 0){
			$takeover_id = $takeover[0]['apt_id'];

			$this->db->where('apt_id', $takeover_id);
			$result_spec = $this->db->get('special')->result_array();

			if(count($result_spec) > 0){
				$end_date = $result_spec[0]['end'];
				$start_date = $result_spec[0]['start'];
				$now = date('Y-m-d');
			}

			if((count($result_spec) > 0) && ($end_date > $now) && ($start_date <= $now)){
				$this->db->where('ID', $takeover_id);
				$result = $this->db->get('apartment_main')->result_array();

				$takeover_name = $result[0]['property_name'];
				$takeover_search_name = $result[0]['property_search_name'];

				$data['takeover_special']['apt_id'] = $takeover_id;
				$data['takeover_special']['property_name'] = $takeover_name;
				$data['takeover_special']['property_search_name'] = $takeover_search_name;

				$this->db->where('apt_id', $takeover_id);
				$data['takeover_special']['special'] = $this->db->get('special')->result_array();
				return $data;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	public function get_special_basic(){
		$this->db->where('basic', 'Y');
		$this->db->where('takeover', 'N');
		$this->db->order_by('ID', 'RANDOM');
		$basics = $this->db->get('sales')->result_array();
		$i = 0;
		if(count($basics) > 0){
			foreach ($basics as $key => $value) {

				$apt_id = $value['apt_id'];
				$this->db->where('apt_id', $apt_id);
				$result_spec = $this->db->get('special')->result_array();
				
				if((count($result_spec) > 0)){
					$end_date = $result_spec[0]['end'];
					$start_date = $result_spec[0]['start'];
					$now = date('Y-m-d');

					$this->db->where('ID', $apt_id);
					$result = $this->db->get('apartment_main')->result_array();

					if(($end_date > $now) && ($start_date <= $now)){
						$data['basic_special_'.$i]['apt_id'] = $apt_id;
						$data['basic_special_'.$i]['property_name'] = $result[0]['property_name'];
						$data['basic_special_'.$i]['property_search_name'] = $result[0]['property_search_name'];
						$data['basic_special_'.$i]['special'] = $result_spec;
						$i = ++$i;
						}
					}
			}
			if(isset($data)){
				return $data;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}

	public function get_special_free(){
		$this->db->where('free', 'Y');
		$this->db->where('takeover', 'N');
		$this->db->order_by('ID', 'RANDOM');
		$free = $this->db->get('sales')->result_array();
		$i = 0;
		if(count($free) > 0){
			foreach ($free as $key => $value) {

				$apt_id = $value['apt_id'];
				$this->db->where('apt_id', $apt_id);
				$result_spec = $this->db->get('special')->result_array();
				
				if((count($result_spec) > 0)){
					$end_date = $result_spec[0]['end'];
					$start_date = $result_spec[0]['start'];
					$now = date('Y-m-d');

					$this->db->where('ID', $apt_id);
					$result = $this->db->get('apartment_main')->result_array();

					if(($end_date > $now) && ($start_date <= $now)){
						$data['free_special_'.$i]['apt_id'] = $apt_id;
						$data['free_special_'.$i]['property_name'] = $result[0]['property_name'];
						$data['free_special_'.$i]['property_search_name'] = $result[0]['property_search_name'];
						$data['free_special_'.$i]['special'] = $result_spec;
						$i = ++$i;
						}
					}
			}
			if(isset($data)){
				return $data;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}

	public function get_all_apartments(){
		$this->db->where('takeover', 'Y');
		$takeover = $this->db->get('sales')->result_array();
		$main_info_ids  = array();

		if(count($takeover) > 0){
			$data = array('apt_id' => $takeover[0]['apt_id'], 'level' => 'takeover');
			array_push($main_info_ids, $data);
		}

		$this->db->where('basic', 'Y');
		$this->db->where('takeover', 'N');
		$this->db->order_by('property_name', 'RANDOM');
		$basics = $this->db->get('sales')->result_array();

		if(count($basics) > 0){
			foreach ($basics as $key => $value) {
				$data = array('apt_id' => $value['apt_id'], 'level' => 'basic');
				array_push($main_info_ids, $data);
			}
		}

		$this->db->where('free', 'Y');
		$this->db->where('takeover', 'N');
		$this->db->order_by('property_name', 'RANDOM');
		$free = $this->db->get('sales')->result_array();

		if(count($free) > 0){
			foreach ($free as $key => $value) {
				$start_data = array('apt_id' => $value['apt_id'], 'level' => 'free');
				array_push($main_info_ids, $start_data);
			}
		}

		$return_data = array();
		function get_main_data($apt_id, $level){
			$ci =& get_instance();
			$ci->db->where('ID', $apt_id);
			$result_main = $ci->db->get('apartment_main')->result_array();
			$data['apt_id'] = $result_main[0]['ID'];
			if($level = 'takeover'){
				$data['level'] = 1;
			}
			if($level = 'basic'){
				$data['level'] = 2;
			}
			if($level = 'free'){
				$data['level'] = 3;
			}
			
			$data['property_name'] = $result_main[0]['property_name'];
			$data['property_search_name'] = $result_main[0]['property_search_name'];
			$data['property_address'] = $result_main[0]['property_address'];
			$data['property_city'] = $result_main[0]['property_city'];
			$data['property_state'] = $result_main[0]['property_state'];
			$data['property_phone'] = $result_main[0]['property_phone'];
			$data['property_slogan'] = $result_main[0]['property_slogan'];
			$data['property_description'] = $result_main[0]['property_description'];
			$data['lat'] = $result_main[0]['lat'];
			$data['long'] = $result_main[0]['long'];

			$ci->db->where('apt_id', $apt_id);
			$ci->db->where('cover_pic', 'Y');
			$result_pic = $ci->db->get('pictures')->result_array();

			if(count($result_pic) < 1){
				$ci->db->where('apt_id', $apt_id);
				$ci->db->where('logo', 'N');
				$ci->db->order_by('pic_order', 'asc');
				$result_pic = $ci->db->get('pictures')->result_array();
				if(count($result_pic) < 1){
					$data['pic_id'] = 'generic';
					$data['pic_name'] = 'generic.jpg';

				}else{
					$data['pic_id'] = $result_pic[0]['id'];
					$data['pic_name'] = $result_pic[0]['name'];
				}
			}else{
				$data['pic_id'] = $result_pic[0]['id'];
				$data['pic_name'] = $result_pic[0]['name'];
			}
			return $data;
		}
		foreach ($main_info_ids as $key => $value) {
			$apts = get_main_data($value['apt_id'], $value['level']);
			array_push($return_data, $apts);
		}
		return $return_data;
	}

	public function get_these_apts($search_params){

		$ids_bedroom_rent  = array();

		//if bd is one or two go to next search - ba
		if($search_params['bedroom'] == 1 || $search_params['bedroom'] == 2){
			$this->db->where('bedroom', $search_params['bedroom']);
			$this->db->where('bathroom >=', $search_params['bathroom']);
			$this->db->where('rent >=', $search_params['min-rent']);
			$this->db->where('rent <=', $search_params['max-rent']);
			$this->db->order_by('apt_id', 'RANDOM');
			$this->db->group_by('apt_id');
			$floorplan_results = $this->db->get('floorplans')->result_array();
			if(count($floorplan_results) > 0){
				foreach ($floorplan_results as $key => $value) {
					$start_data = array('apt_id' => $value['apt_id']);
					array_push($ids_bedroom_rent, $start_data);
				}
			}
		//search for any or 3br or greater
		}else{
			$this->db->where('bedroom >=', $search_params['bedroom']);
			$this->db->where('bathroom >=', $search_params['bathroom']);
			$this->db->where('rent >=', $search_params['min-rent']);
			$this->db->where('rent <=', $search_params['max-rent']);
			$this->db->order_by('apt_id', 'RANDOM');
			$this->db->group_by('apt_id');
			$floorplan_results = $this->db->get('floorplans')->result_array();
			if(count($floorplan_results) > 0){
				foreach ($floorplan_results as $key => $value) {
					$start_data = array('apt_id' => $value['apt_id']);
					array_push($ids_bedroom_rent, $start_data);
				}
			}
		}

		$get_data_for_these = array();
		// Get all of the active amenities for each property with the correct bedroom and bath
		foreach ($ids_bedroom_rent as $key => $value) {

			//count how many amenities are required
			$how_many_amenities = 0;
			if(isset($search_params['pets'])){
				$pets = $search_params['pets'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$pets = 'N';}

			if(isset($search_params['pool'])){
				$pool = $search_params['pool'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$pool = 'N';}

			if(isset($search_params['gated'])){
				$gated = $search_params['gated'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$gated = 'N';}

			if(isset($search_params['fitness'])){
				$fitness = $search_params['fitness'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$fitness = 'N';}

			if(isset($search_params['wd'])){
				$wd = $search_params['wd'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$wd = 'N';}

			if(isset($search_params['clubhouse'])){
				$clubhouse = $search_params['clubhouse'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$clubhouse = 'N';}

			if(isset($search_params['furnished'])){
				$furnished = $search_params['furnished'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$furnished = 'N';}

			if(isset($search_params['seniors'])){
				$seniors = $search_params['seniors'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$seniors = 'N';}

			if(isset($search_params['covered'])){
				$covered = $search_params['covered'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$covered = 'N';}

			if(isset($search_params['laundry'])){
				$laundry = $search_params['laundry'];
				$how_many_amenities = ++$how_many_amenities;
			}else{$laundry = 'N';}


			//search for all requested, active amentities for each apartment with the correct br and ba
			$this->db->where('apt_id', $value['apt_id']);
			$this->db->where('active', 'Y');
			$this->db->where('(name = "'.$pets.'" OR name = "'.$pool.'" OR name = "'.$gated.'" OR name = "'.$fitness.'" OR name = "'.$wd.'" OR name = "'.$clubhouse.'" OR name = "'.$furnished.'" OR name = "'.$seniors.'" OR name = "'.$covered.'" OR name = "'.$laundry.'")');
			$amen_result = $this->db->get('our_amenities_list')->result_array();
			

			if(count($amen_result) == $how_many_amenities){
				$start_data = array('apt_id' => $value['apt_id']);
				array_push($get_data_for_these, $start_data);
			}
 			
		}

		$return_data = array();
		function get_main_data($apt_id){
			$ci =& get_instance();
			$ci->db->where('ID', $apt_id);
			$result_main = $ci->db->get('apartment_main')->result_array();
			$data['apt_id'] = $result_main[0]['ID'];
			// $data['level'] = $result_main[0]['level'];
			$data['property_name'] = $result_main[0]['property_name'];
			$data['property_search_name'] = $result_main[0]['property_search_name'];
			$data['property_address'] = $result_main[0]['property_address'];
			$data['property_city'] = $result_main[0]['property_city'];
			$data['property_state'] = $result_main[0]['property_state'];
			$data['property_phone'] = $result_main[0]['property_phone'];
			$data['property_slogan'] = $result_main[0]['property_slogan'];
			$data['property_description'] = $result_main[0]['property_description'];
			$data['lat'] = $result_main[0]['lat'];
			$data['long'] = $result_main[0]['long'];

			$ci->db->where('apt_id', $apt_id);
			$ci->db->where('takeover', 'Y');
			$takeover = $ci->db->get('sales')->result_array();
			if(count($takeover) > 0){
				$data['level'] = 1;
			}

			$ci->db->where('apt_id', $apt_id);
			$ci->db->where('basic', 'Y');
			$ci->db->where('takeover', 'N');
			$basic = $ci->db->get('sales')->result_array();
			if(count($basic) > 0){
				$data['level'] = 2;
			}

			$ci->db->where('apt_id', $apt_id);
			$ci->db->where('free', 'Y');
			$ci->db->where('takeover', 'N');
			$basic = $ci->db->get('sales')->result_array();
			if(count($basic) > 0){
				$data['level'] = 3;
			}

			$ci->db->where('apt_id', $apt_id);
			$ci->db->where('cover_pic', 'Y');
			$ci->db->where('logo', 'N');
			$result_pic = $ci->db->get('pictures')->result_array();

			if(count($result_pic) < 1){
				$ci->db->where('apt_id', $apt_id);
				$ci->db->where('logo', 'N');
				$ci->db->order_by('pic_order', 'asc');
				$result_pic = $ci->db->get('pictures')->result_array();
				if(count($result_pic) < 1){
					$data['pic_id'] = 'generic';
					$data['pic_name'] = 'generic.jpg';

				}else{
					$data['pic_id'] = $result_pic[0]['id'];
					$data['pic_name'] = $result_pic[0]['name'];
				}
			}else{
				$data['pic_id'] = $result_pic[0]['id'];
				$data['pic_name'] = $result_pic[0]['name'];
			}
			return $data;
		}
		foreach ($get_data_for_these as $key => $value) {
			$apts = get_main_data($value['apt_id']);
			array_push($return_data, $apts);
		}
		if(count($return_data) > 0){
			function cmp_by_level($a, $b) {
			  return $a["level"] - $b["level"];
			}
			usort($return_data, "cmp_by_level");
			return $return_data;
		}else{
			return false;
		}
	}

	public function get_apt_main_data($apt_id){
		$this->db->where('ID', $apt_id);
		$this->db->limit('1');
		$data = $this->db->get('apartment_main')->result_array();
		if(count($data) > 0){
			return $data;
		}else{
			return false;
		}
	}

	public function get_cover_picture($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->where('cover_pic', 'Y');
		$this->db->where('logo', 'N');
		$result_pic = $this->db->get('pictures')->result_array();

		if(count($result_pic) < 1){
			$this->db->where('apt_id', $apt_id);
			$this->db->where('logo', 'N');
			$this->db->order_by('pic_order', 'asc');
			$result_pic = $this->db->get('pictures')->result_array();
			if(count($result_pic) < 1){
				$data['pic_id'] = 'generic';
				$data['pic_name'] = 'generic.jpg';

			}else{
				$data['pic_id'] = $result_pic[0]['id'];
				$data['pic_name'] = $result_pic[0]['name'];
			}
		}else{
			$data['pic_id'] = $result_pic[0]['id'];
			$data['pic_name'] = $result_pic[0]['name'];
		}
		return $data;
	}

	public function get_sales_level($apt_id){
		$this->db->where('apt_id', $apt_id);
		$result = $this->db->get('sales')->result_array();
		$data = $result[0]['free'];
		return $data;
	}

	public function get_pics($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->where('logo', 'N');
		$this->db->order_by('pic_order', 'asc');
		$data = $this->db->get('pictures')->result_array();
		if(count($data) > 0){
			return $data;
		}else{
			return false;
		}
	}

	public function send_contact_email($data){
		$this->db->where('ID', $data['apt_id']);
		$result = $this->db->get('apartment_main')->result_array();
		$user_id = $result[0]['verified_user_id'];

		$this->db->where('ID', $user_id);
		// $this->db->where('get_messages', 'Y');
		$user_emails = $this->db->get('users')->result_array();


 //************************ THIS IS WHERE TO DELETE IF GETTING TOO MANY EMAILS *****************//
 //************************ THIS IS WHERE TO DELETE IF GETTING TOO MANY EMAILS *****************//
 //************************ THIS IS WHERE TO DELETE IF GETTING TOO MANY EMAILS *****************//
		$send['miles'] = 'miles@bayrummedia.com';

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
		$this->load->library('email');
		foreach ($send as $key => $value) {
 			if($data['free'] != 'Y'){
 				$this->email->clear();
				$this->email->from('donotreply@sanangelo.apartments', 'CONTACT FORM SANANGELO.APARTMENTS');
				$this->email->to($value);
				$this->email->subject('SANANGELO.APARTMENTS: CONTACT FORM');
				$this->email->message('<h3 style="color:#3F79C9;">You have a contact from SANANGELO.APARTMENTS</h3><br><br>DATE: '.$data['time'].'<br><br>FROM: '.$data['email'].'<br><br>MESSAGE: '.$data['message']);
				$sent = $this->email->send();
 			}else{
 				$this->email->clear();
				$this->email->from('donotreply@sanangelo.apartments', 'CONTACT FORM SANANGELO.APARTMENTS');
				$this->email->to($value);
				$this->email->subject('SANANGELO.APARTMENTS: CONTACT FORM');
				$this->email->message('<h3 style="color:#3F79C9;">Someone just tried to contact you from SANANGELO.APARTMENTS</h3><br>Login to SANANGELO.APARTMENTS to see this lead: <a href="'.base_url().'login/login_user">LOGIN</a>.' );
				$sent = $this->email->send();
 			}
			
		}
		return true;
	}

	public function get_floorplans($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('floorplans')->result_array();
		if(count($data) > 0){
			return $data;
		}else{
			return 'N';
		}
	}

	public function get_amenities($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->where('active', 'Y');
		$our_amenities = $this->db->get('our_amenities_list')->result_array();

		$data = array();

		foreach ($our_amenities as $key => $value) {
			$push_data['name'] = $value['name'];
			$push_data['select_units'] = $value['select_units'];
			$push_data['extra_fees'] = $value['extra_fees'];

			array_push($data, $push_data);
		}

		$this->db->where('apt_id', $apt_id);
		$this->db->where('active', 'Y');
		$their_amenities = $this->db->get('their_amenities_list')->result_array();
		foreach ($their_amenities as $key => $value) {
			$push_data['name'] = $value['name'];
			$push_data['select_units'] = $value['select_units'];
			$push_data['extra_fees'] = $value['extra_fees'];

			array_push($data, $push_data);
		}

		function comp_by_name($a, $b){
			return strcmp($a['name'], $b['name']);
		}

		usort($data, 'comp_by_name');

		return $data;
	}

	public function get_hours($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->order_by('hours_order', 'asc');
		$data = $this->db->get('office_hours')->result_array();

		if(count($data) > 0){
			return $data;
		}else{
			$data = 'N';
			return $data;
		}
	}

	public function get_logo($apt_id){
		$this->db->where('apt_id', $apt_id);
		$this->db->where('logo', 'Y');
		$data = $this->db->get('pictures')->result_array();

		if(count($data) > 0){
			$return_data['logo_id'] = $data[0]['id'];
			$return_data['name'] = $data[0]['name'];
		}else{
			$return_data = 'N';
		}

		return $return_data;
	}

	public function get_pet_policy($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('pet_policy')->result_array();

		if(count($data) > 0){
			$return_data['pet_type'] = $data[0]['type'];
			$return_data['pet_dep'] = $data[0]['pet_deposit'];
			$return_data['pet_refund'] = $data[0]['pet_deposit_refundable'];
			$return_data['pet_restrictions'] = $data[0]['restrictions'];
		}else{
			$return_data = 'N';
		}

		return $return_data;
	}

	public function get_special_info($apt_id){
		$this->db->where('apt_id', $apt_id);
		$result_spec = $this->db->get('special')->result_array();
		
		if((count($result_spec) > 0)){
			$end_date = $result_spec[0]['end'];
			$start_date = $result_spec[0]['start'];
			$now = date('Y-m-d');

			$this->db->where('ID', $apt_id);
			$result = $this->db->get('apartment_main')->result_array();

			if(($end_date > $now) && ($start_date <= $now)){
					$data = $result_spec;
					return $data;
				}else{
					$data = 'N';
					return $data;
				}
			}else{
				$data = 'N';
				return $data;
			}
	}

	public function get_managment_logo($apt_id){
		$this->db->where('apt_id', $apt_id);
		$data = $this->db->get('man_logo')->result_array();
		if(count($data) > 0){
			$return_data = $data[0]['name'];
			return $return_data;
		}else{
			$return_data = 'N';
			return $return_data;
		}
	}

	public function get_all_blog($limit, $offset){
		if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $this->db->order_by('post_date', 'desc');
        $result['rows'] = $this->db->get('blog', $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results('blog');
        return $result;
	}

	public function get_this_blog($id){
		$this->db->where('id', $id);
        $result['rows'] = $this->db->get('blog');
		return $result;
	}

	public function does_blog_exsist($type){
		$date = date('Y-m-d');
		$this->db->where('post_type', $type);
		$this->db->where('post_date', $date);
		$result = $this->db->get('blog')->result_array();

		if(count($result) > 0){
			return 'Y';
		}else{
			return 'N';
		}
	}


	public function make_spot_blog(){
		$data['post_date'] = date('Y-m-d');
		$data['post_type'] = 'SPOT';

		$this->db->order_by('id', 'RANDOM');
		$this->db->limit(1);
		$apt = $this->db->get('apartment_main')->result_array();

		$data['post_title'] = 'San Angelo Apartment Spotlight : '.$apt[0]['property_name'];
		$name = $apt[0]['property_name'];
		$address = $apt[0]['property_address'];
		$city = $apt[0]['property_city'];

		$amen = $this->get_amenities($apt[0]['ID']);

		$pic_info = $this->get_cover_picture($apt[0]['ID']);

		copy(
			'images/pictures/'.$apt[0]['ID'].'/'.$pic_info['pic_id'].'/'.$pic_info['pic_name'],
			'images/blog/'.$pic_info['pic_name']
			);

		$data['post_pic'] = $pic_info['pic_name'];

		function spot_blog_create($apt, $amen){
			$name = $apt[0]['property_name'];
			$address = $apt[0]['property_address'];
			$city = $apt[0]['property_city'];
			$search_name = $apt[0]['property_search_name'];
			$id = $apt[0]['ID'];
			$sent_one_rand = rand(1,3);
			$rand_one = rand(0,3);
			$rand_two = rand(0,3);
			$rand_three = rand(0,3);
			$rand_four = rand(0,1);
			$rand_six = rand(0,2);
			$rand_seven = rand(0,4);
			$rand_eight = rand(0,10);
			do {
				$rand_nine = rand(0,10);
			}while($rand_eight == $rand_nine);


			if($sent_one_rand == 1){

				$start = ['start', 'outset', 'kickoff', 'beginning'];
				$look = ['taking a look at', 'turning our attention to', 'focusing on', 'taking a quick glimpse at'];
				$our = ['our', 'the'];

				$text = "It's the ".$start[$rand_one]." of the week, time for ".$our[$rand_four]." Apartment Spotlight. This week we're ".$look[$rand_two].", ".$name.". ";
				
			}elseif ($sent_one_rand == 2) {
				$go = ['go', 'are'];
				$look = ['take a look at', 'turn our attention to', 'focus on', 'take a quick glimpse at'];
				$apt = ['community', 'apartments', 'apartment community', 'apartment complex'];

				$text = "Here we ".$go[$rand_four]." again. It's Monday so let's ".$look[$rand_one]." our Apartment Spotlight ".$apt[$rand_two]."... ".$name.". ";

			}elseif ($sent_one_rand == 3){
				$start = ['start', 'outset', 'kickoff', 'beginning'];
				$look = ['taking a look at', 'turning our attention to', 'taking a gander at', 'taking a quick glimpse at'];
				$now = ['Now', 'Right now', 'And now', 'Here\'s where'];

				$text = "Just like at the ".$start[$rand_one]." of every week... It's Apartment Spotlight time.  ".$now[$rand_three]." we're ".$look[$rand_two]." ".$name.".";
			}
			$businesses = ['businesses', 'shops', 'schools', 'restaurants', 'major employers', 'stores', 'places to eat', 'supermarkets', 'local attractions', 'entertainment venues'];

			$sent_two = ["You'll find ".$name." at ".$address." in ".$city.". With ".$businesses[$rand_eight]." and ".$businesses[$rand_nine]." close at hand, most everthing you need is nearby.", $name." is located at ".$address." in ".$city.". Close to lots of ".$businesses[$rand_eight]." and ".$businesses[$rand_nine].". ", "Conveniently located at ".$address." in ".$city.". ".$name." is in the heart of it all, near ".$businesses[$rand_eight]." and ".$businesses[$rand_nine].". "];

			if(count($amen) > 1){
				$plenty = ['plenty', 'tons', 'lots', 'a wealth'];
				$prospective = ['possible tenants', 'prospective renters', 'folks looking for an apartment', 'apartment hunters'];
				$find = ['find', 'discover', 'see', 'spot'];
				$sent_three = "With ".$plenty[$rand_two]." to offer ".$prospective[$rand_three].", here are some of the amenities you can ".$find[$rand_one]." at ".$name.":<br><ul>";
				foreach($amen as $amen){
					$sent_three .= "<li>".$amen['name']."</li>";
				}
				$sent_three .= "</ul>";

			}else{
				$sent_three = 'N';
			}

			$text = $text."<br><br>".$sent_two[$rand_six];

			if($sent_three != 'N'){
				$text = $text."<br><br>".$sent_three;
			}

			$sent_four = [
				"If you're interested in contacting them or learning more, take a look here: <a href='".base_url()."main/apartment/".$search_name."/".$id."'>".$name."</a>", 
				"Take a look here: <a href='".base_url()."main/apartment/".$search_name."/".$id."'>".$name."</a> to contact them or learn more.", 
				"Get their contact info and get some more information here: <a href='".base_url()."main/apartment/".$search_name."/".$id."'>".$name."</a>", 
				"There's lots more to see here: <a href='".base_url()."main/apartment/".$search_name."/".$id."'>".$name."</a>", 
				"Want more info? Take a look here: <a href='".base_url()."main/apartment/".$search_name."/".$id."'>".$name."</a>"];

			$text = $text."<br><br>".$sent_four[$rand_seven];

			return $text;
		}	

		$data['post_text'] = spot_blog_create($apt, $amen);	
		return $data;
	}

	public function make_spec_blog($main_page_data){
		$data['post_date'] = date('Y-m-d');
		$data['post_type'] = 'SPEC';
		$data['post_title'] = 'San Angelo Apartment Specials Roundup : '.date('F jS, Y');

		$special_takeover = $main_page_data['special_takeover'];
		$special_basic = $main_page_data['special_basic'];
		$special_free = $main_page_data['special_free'];

		function spec_blog_create($special_takeover, $special_basic, $special_free){
			
			$sent_one_rand = rand(1,3);
			$rand_one = rand(0,3);
			$rand_two = rand(0,3);
			$rand_three = rand(0,3);
			$rand_four = rand(0,1);
			$rand_six = rand(0,2);
			$rand_seven = rand(0,4);
			$rand_eight = rand(0,3);

			if($sent_one_rand == 1){

				$deal = ['good deal', 'bargain', 'some value', 'good buy'];
				$right = ['right place', 'correct place', 'right location', 'perfect place'];
				$offered = ['offered', 'extended', 'provided', 'shown'];
				$look = ['look', 'gander'];
				$apt = ['communities', 'apartments', 'apartment communities', 'apartment complexes'];
				$specials = ['specials', 'deals', 'bargains', 'offers'];
				$looking = ['looking', 'seeking', 'wanting', 'needing'];

				$text = "If you're ".$looking[$rand_eight]." for a ".$deal[$rand_one]." on your next home, you've come to the ".$right[$rand_two].".<br><br>Every Thursday we take a ".$look[$rand_four]." at the ".$specials[$rand_three]." being ".$offered[$rand_three]." by the ".$apt[$rand_one]." around town.<ul class='spec_round_list'>";
				
			}elseif ($sent_one_rand == 2) {

				$deal = ['good deal', 'bargain', 'some value', 'good buy'];
				$right = ['right place', 'correct place', 'right location', 'perfect place'];
				$offered = ['offered', 'extended', 'provided', 'shown'];
				$look = ['look', 'quick look'];
				$apt = ['home', 'apartment', 'apartment community', 'place to live'];
				$apts = ['communities', 'apartments', 'apartment communities', 'apartment complexes'];
				$specials = ['specials', 'deals', 'bargains', 'offers'];
				$looking = ['looking', 'seeking', 'wanting', 'needing'];

				$text = "Seems like everyone needs a ".$deal[$rand_one]." these days.<br><br>If you're ".$looking[$rand_eight]." for a ".$deal[$rand_two]." on your next ".$apt[$rand_one].", take a ".$look[$rand_four]." at these ".$specials[$rand_three]." being ".$offered[$rand_three]." by the ".$apts[$rand_two]." in our market.<ul class='spec_round_list'>";
				

			}elseif ($sent_one_rand == 3){

				$deal = ['good deal', 'bargain', 'some value', 'good buy'];
				$right = ['right place', 'correct place', 'right location', 'perfect place'];
				$offered = ['offered', 'extended', 'provided', 'shown'];
				$look = ['gander', 'quick look'];
				$look_b = ['check out', 'have a look', 'take a peek', 'have a quick look'];
				$apt = ['apartment', 'home', 'place to live', 'apartment home'];
				$specials = ['specials', 'deals', 'bargains', 'offers'];
				$looking = ['looking', 'seeking', 'wanting', 'needing'];

				$text = "It's Thursday and that means we take a ".$look[$rand_four]." at the specials being ".$offered[$rand_three]." around town.<br><br>So if you're ".$looking[$rand_eight]." for a ".$deal[$rand_two]." on a new ".$apt[$rand_one].", then ".$look_b[$rand_two]." at these ".$specials[$rand_three]."...<ul class='spec_round_list'>";
				
			}	

			if($special_takeover != false){
				$add_text = "<li class='list_smaller'><a class='spec_list_title' href='".base_url()."main/apartment/".$special_takeover['takeover_special']['property_search_name']."/".$special_takeover['takeover_special']['apt_id']."'>".$special_takeover['takeover_special']['property_name']."</a> : ";

				$add_text_b = $special_takeover['takeover_special']['special'][0]['title']." : ";
				$add_text_c = $special_takeover['takeover_special']['special'][0]['description']."</li>";

				$text .= $add_text.$add_text_b.$add_text_c;

			}

			if($special_basic != false){
				$i = 0;
				foreach($special_basic as $special_basic){
					$add_text = "<li class='list_smaller'><a class='spec_list_title' href='".base_url()."main/apartment/".$special_basic['property_search_name']."/".$special_basic['apt_id']."'>".$special_basic['property_name']."</a> : ";

					$add_text_b = $special_basic['special'][0]['title']." : ";
					$add_text_c = $special_basic['special'][0]['description']."</li>";

					$text .= $add_text.$add_text_b.$add_text_c;

					$i = ++$i;
				}
			}

			if($special_free != false){
				$i = 0;
				foreach($special_free as $special_free){
					$add_text = "<li class='list_smaller'><a class='spec_list_title' href='".base_url()."main/apartment/".$special_free['property_search_name']."/".$special_free['apt_id']."'>".$special_free['property_name']."</a> : ";

					$add_text_b = $special_free['special'][0]['title']." : ";
					$add_text_c = $special_free['special'][0]['description']."</li>";

					$text .= $add_text.$add_text_b.$add_text_c;

					$i = ++$i;
				}
			}
			$text .= "</ul>";
			return $text;
		}	

		$data['post_text'] = spec_blog_create($special_takeover, $special_basic, $special_free);	
		return $data;
	}

	public function make_pric_blog(){
		$data['post_date'] = date('Y-m-d');
		$data['post_type'] = 'PRIC';
		$data['post_title'] = 'Average San Angelo Apartment Rent for '.date('F, Y');

		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$recent_prices = $this->db->get('market_data')->result_array();

		$current_ave_one = $recent_prices[0]['ave_one'];
		$current_ave_two = $recent_prices[0]['ave_two'];
		$current_ave_sq_ft = $recent_prices[0]['ave_sq_ft'];
		$current_id = $recent_prices[0]['id'];

		$this->db->where('id', ($current_id - 1));
		$last_prices = $this->db->get('market_data')->result_array();

		$last_ave_one = $last_prices[0]['ave_one'];
		$last_ave_two = $last_prices[0]['ave_two'];
		$last_ave_sq_ft = $last_prices[0]['ave_sq_ft'];

		$up = ['Up', 'On The Rise', 'Higher', 'Move Up'];
		$down = ['Down', 'Lower', 'Decline', 'Decreased'];
		$steady = ['Steady', 'Unchanged', 'Not Moving', 'Stagnant'];
		$mixed = ['Mixed', 'Uneven', 'Varied', 'Diverse'];
		$rand = rand(0,3);

		if($current_ave_one > $last_ave_one && $current_ave_two > $last_ave_two && $current_ave_sq_ft > $last_ave_sq_ft){
			$data['post_title'] = 'Apartment Rents '.$up[$rand].' In San Angelo for '.date('F, Y');
			$change = 'UP';
		}elseif($current_ave_one < $last_ave_one && $current_ave_two < $last_ave_two && $current_ave_sq_ft < $last_ave_sq_ft){
			$data['post_title'] = 'Apartment Rents '.$down[$rand].' In San Angelo for '.date('F, Y');
			$change = 'DOWN';
		}elseif($current_ave_one == $last_ave_one && $current_ave_two == $last_ave_two && $current_ave_sq_ft == $last_ave_sq_ft){
			$data['post_title'] = 'Apartment Rents '.$steady[$rand].' In San Angelo for '.date('F, Y');
			$change = 'STEADY';
		}else{
			$data['post_title'] = 'Apartment Rents '.$mixed[$rand].' In San Angelo for '.date('F, Y');
			$change = 'MIXED';
		}

		function pric_blog_create($change, $current_ave_one, $current_ave_two, $current_ave_sq_ft, $last_ave_one, $last_ave_two, $last_ave_sq_ft){
			
			$sent_one_rand = rand(1,3);
			$rand_one = rand(0,3);
			$rand_two = rand(0,3);
			$rand_three = rand(0,3);
			$rand_four = rand(0,1);
			$rand_six = rand(0,2);
			$rand_seven = rand(0,4);
			$rand_eight = rand(0,3);
			$rand_nine = rand(0,3);
			$rand_ten = rand(0,2);

			$text_b = '';
			$text_c = '';
			$text_d = '';

			if($change == 'UP'){

				$up = ['up', 'on the rise', 'higher', 'above'];
				$board = ['across the board', 'in all categories', 'in our tracked categories'];
				$look = ['look', 'gander'];
				$apt = ['communities', 'apartments', 'apartment communities', 'apartment complexes'];
				$renter = ['Renter', 'Tenants', 'Occupants', 'Leaseholders'];
				$rent = ['per month', 'for their rent', 'for their leases'];
				$cost_of = ['cost of', 'price of', 'bill for', 'amount for'];
				$cost = ['cost', 'price', 'bill', 'amount'];
				$last = ['last', 'the previous'];

				$text = $renter[$rand_three]." are paying more ".$rent[$rand_six]." ".$board[$rand_ten]." this month as ".$apt[$rand_eight]." raised their rents. The ".$cost_of[$rand_two]." renting a one bedroom apartment, a two bedroom apartment, and the average ".$cost[$rand_one]." per square foot (regardless of the number of bedrooms) are all ".$up[$rand_nine]." this month over ".$last[$rand_four].".";
				
			}elseif ($change == 'DOWN') {

				$down = ['down', 'lower', 'in a state of decline', 'smaller'];
				$board = ['across the board', 'in all categories', 'in our tracked categories'];
				$look = ['look', 'gander'];
				$apt = ['communities', 'apartments', 'apartment communities', 'apartment complexes'];
				$renter = ['Renter', 'Tenants', 'Occupants', 'Leaseholders'];
				$rent = ['per month', 'for their rent', 'for their leases'];
				$cost_of = ['cost of', 'price of', 'bill for', 'amount for'];
				$cost = ['cost', 'price', 'bill', 'amount'];
				$last = ['last', 'the previous'];
				$lowered = ['lowered', 'decreased', 'curbed', 'diminished', 'dropped'];

				$text = $renter[$rand_three]." are paying less ".$rent[$rand_six]." ".$board[$rand_ten]." this month as ".$apt[$rand_eight]." ".$lowered[$rand_seven]." their rents. The ".$cost_of[$rand_two]." renting a one bedroom apartment, a two bedroom apartment, and the average ".$cost[$rand_one]." per square foot (regardless of the number of bedrooms) are all ".$down[$rand_nine]." this month over ".$last[$rand_four].".";
				

			}elseif ($change == 'STEADY'){

				$steady = ['steady', 'unchanged', 'stagnant', 'the same'];
				$board = ['across the board', 'in all categories', 'in our tracked categories'];
				$look = ['look', 'gander'];
				$apt = ['communities', 'apartments', 'apartment communities', 'apartment complexes'];
				$renter = ['Renter', 'Tenants', 'Occupants', 'Leaseholders'];
				$rent = ['per month', 'for their rent', 'for their leases'];
				$cost_of = ['cost of', 'price of', 'bill for', 'amount for'];
				$cost = ['cost', 'price', 'bill', 'amount'];
				$last = ['last', 'the previous'];
				$held_steady = ['held steady with', 'did not move', 'did not change'];

				$text = $renter[$rand_three]." are paying the same ".$rent[$rand_six]." ".$board[$rand_six]." this month as ".$apt[$rand_eight]." ".$held_steady[$rand_ten]." their rents. The ".$cost_of[$rand_two]." renting a one bedroom apartment, a two bedroom apartment, and the average ".$cost[$rand_one]." per square foot (regardless of the number of bedrooms) are all ".$steady[$rand_nine]." this month over ".$last[$rand_four].".";
				
			}elseif ($change == 'MIXED'){

				$steady = ['steady', 'unchanged', 'stagnant', 'the same'];
				$board = ['across the board', 'in all categories', 'in our tracked categories'];
				$look = ['look', 'gander'];
				$apt = ['communities', 'apartments', 'apartment communities', 'apartment complexes'];
				$tenants = ['renters', 'tenants', 'occupants', 'leaseholders'];
				$property_owners = ['property owners', 'property managers', 'apartment owners', 'managment companies'];
				$news = ['Some good news and some bad news for', 'Some positive news and some negative news for', 'A mixed bag for ', 'Ups and downs for '];
				$rent = ['per month', 'for their rent', 'for their leases'];
				$renter = ['Renters', 'Tenants', 'Occupants', 'Leaseholders'];
				$cost_of = ['cost of', 'price of', 'bill for', 'amount for'];
				$cost = ['cost', 'price', 'bill', 'amount'];
				$last = ['last', 'the previous'];
				$held_steady = ['heald steady with', 'did not move', 'did not change'];
				$down = ['down', 'lower', 'in a state of decline', 'smaller'];
				$up = ['up', 'on the rise', 'higher', 'above'];

				$text = $news[$rand_three]." ".$tenants[$rand_one]." and ".$property_owners[$rand_two]." alike this month".". ";

				if($current_ave_one > $last_ave_one){
					$text_b = 'On average, the '.$cost_of[$rand_eight].' a one-bedroom apartment is '.$up[$rand_nine].' this month over '.$last[$rand_four].'. ';

				}elseif($current_ave_one < $last_ave_one){
					$text_b = 'The average '.$cost_of[$rand_eight].' a one-bedroom apartment is '.$down[$rand_nine].' this month over '.$last[$rand_four].'. ';

				}elseif ($current_ave_one == $last_ave_one) {
					$text_b = $renter[$rand_three]." are paying the same ".$rent[$rand_six]." on one-bedroom units this month as ".$apt[$rand_eight]." ".$held_steady[$rand_ten]." their rents for single bedrooms. ";
				}

				if($current_ave_two > $last_ave_two){
					$text_c = 'On average, the '.$cost_of[$rand_eight].' a two-bedroom apartment is '.$up[$rand_nine].' this month over '.$last[$rand_four].'. ';

				}elseif($current_ave_two < $last_ave_two){
					$text_c = 'The average '.$cost_of[$rand_eight].' a two-bedroom apartment is '.$down[$rand_nine].' this month over '.$last[$rand_four].'. ';

				}elseif ($current_ave_two == $last_ave_two) {
					$text_c = $renter[$rand_three]." are paying the same ".$rent[$rand_six]." on two-bedroom units this month as ".$apt[$rand_eight]." ".$held_steady[$rand_ten]." their rents for double bedrooms. ";
				}

				if($current_ave_sq_ft > $last_ave_sq_ft){
					$text_d = 'All while, the average '.$cost_of[$rand_eight].' per square foot of all units (no matter how many bedrooms) is '.$up[$rand_nine].' this month over '.$last[$rand_four].'. ';

				}elseif($current_ave_sq_ft < $last_ave_sq_ft){
					$text_d = 'Meanwhile, the average '.$cost[$rand_eight].' per square foot of all units (regardless of number of bedrooms) is '.$down[$rand_nine].' this month over '.$last[$rand_four].'. ';

				}elseif ($current_ave_sq_ft == $last_ave_sq_ft) {
					$text_d = 'And '.$tenants[$rand_three]." are paying the same ".$rent[$rand_six]." per square foot (without regard to number of bedrooms), as ".$apt[$rand_eight]." ".$held_steady[$rand_ten]." their rents per foot of living space. ";
				}
				
			}	

			return $text.$text_b.$text_c.$text_d;
		}	

		if($current_ave_one > $last_ave_one){
			$one_symb = "<span class='uppers'>&nbsp;&nbsp;&uarr;</span>";

		}elseif($current_ave_one < $last_ave_one){
			$one_symb = "<span class='downers'>&nbsp;&nbsp;&darr;</span>";

		}elseif ($current_ave_one == $last_ave_one) {
			$one_symb = "<span class='equalers'>&nbsp;&nbsp;=</span>";
		}

		if($current_ave_two > $last_ave_two){
			$two_symb = "<span class='uppers'>&nbsp;&nbsp;&uarr;</span>";

		}elseif($current_ave_two < $last_ave_two){
			$two_symb = "<span class='downers'>&nbsp;&nbsp;&darr;</span>";

		}elseif ($current_ave_two == $last_ave_two) {
			$two_symb = "<span class='equalers'>&nbsp;&nbsp;=</span>";
		}

		if($current_ave_sq_ft > $last_ave_sq_ft){
			$sq_ft_symb = "<span class='uppers'>&nbsp;&nbsp;&uarr;</span>";

		}elseif($current_ave_sq_ft < $last_ave_sq_ft){
			$sq_ft_symb = "<span class='downers'>&nbsp;&nbsp;&darr;</span>";

		}elseif ($current_ave_sq_ft == $last_ave_sq_ft) {
			$sq_ft_symb = "<span class='equalers'>&nbsp;&nbsp;=</span>";
		}
		$text_b = '<br><br><table class="rent_table"><tr><th></th><th>Ave One Br</th><th>Ave Two Br</th><th>Ave Price Per Sq Ft</th></tr>';

		$text_c = '<tr><td>This Month:</td><td>$'.$current_ave_one.$one_symb.'</td><td>$'.$current_ave_two.$two_symb.'</td><td>$'.$current_ave_sq_ft.$sq_ft_symb.'</td></tr>';
		$text_d = '<tr><td>Last Month:</td><td>$'.$last_ave_one.'</td><td>$'.$last_ave_two.'</td><td>$'.$last_ave_sq_ft.'</td></tr>';

		$text_e ='</table>';

		$data['post_text'] = pric_blog_create($change, $current_ave_one, $current_ave_two, $current_ave_sq_ft, $last_ave_one, $last_ave_two, $last_ave_sq_ft).$text_b.$text_c.$text_d.$text_e;	

		return $data;
	}

	public function send_pric_blog(){
		$users = $this->db->get('users')->result_array();
		$all_emails = [];
		foreach ($users as $key => $value) {
			array_push($all_emails, $value['email']);
			if($value['email_2'] != ''){
				array_push($all_emails, $value['email_2']);
			}
			if($value['email_3'] != ''){
				array_push($all_emails, $value['email_3']);
			}
			if($value['email_4'] != ''){
				array_push($all_emails, $value['email_4']);
			}
		}

		// print_r($all_emails);
		// for testing environment
		// $all_emails = ['miles@bayrummedia.com', 'mileschick@gmail.com'];

		$this->load->library('email');
		foreach ($all_emails as $key => $value) {
 			
			$this->email->clear();
			$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS');
			$this->email->to($value);
			$this->email->subject('Are Rents Up or Down This Month?');
			$this->email->message('<h3 style="color:#3F79C9;">WHERE ARE RENTS HEADED?</h3><br>Our monthly blog report on rent trends is online. Take a look at it <a href="'.base_url().'main/blog">here</a>. <br><br>While you\'re there, take a look at your own rents and make sure they\'re current! Login <a href="'.base_url().'login/login_user">here</a>.');
			$sent = $this->email->send();
		}
	}


	public function make_amen_blog(){
		$data['post_date'] = date('Y-m-d');
		$data['post_type'] = 'AMEN';

		$amen = ['65+ Community', 
				'Accepts Credit Card Payments', 
				'Affordable Housing', 
				'All Bills Paid', 
				'Balcony', 
				'Business Center', 
				'Ceiling Fan(s)', 
				'Covered Parking', 
				'Disability Access', 
				'Dog Park', 
				'Enclosed Yards', 
				'Extra Storage', 
				'Fireplace', 
				'Fitness Center', 
				'Furnished Available', 
				'Garage', 
				'Garden Tub', 
				'Gated Access', 
				'Hardwood Flooring', 
				'Laundry Facility', 
				'Oversized Closets', 
				'Pets', 
				'Playground', 
				'Security Systems', 
				'Swimming Pool', 
				'Washer / Dryer Connections', 
				'Washer / Dryer In Unit', 
				'Yards'];
		$rand = rand(0,27);

		

		$apt_ids = [];
		$this->db->where('active', 'Y');
		$this->db->where('name', $amen[$rand]);
		$apts = $this->db->get('our_amenities_list')->result_array();

		foreach ($apts as $key => $value) {
			array_push($apt_ids, $value['apt_id']);
		}

		$data['post_title'] = count($apt_ids).' San Angelo Apartments Have The Amenitiy: '.$amen[$rand].'!';

		$rand_one = rand(0,3);
		$rand_two = rand(0,3);
		$rand_three = rand(0,3);
		$rand_four = rand(0,1);
		$rand_six = rand(0,2);
		$rand_seven = rand(0,4);
		$rand_eight = rand(0,3);
		$rand_nine = rand(0,3);
		$rand_ten = rand(0,2);

		$always = ['always', 'just some', 'invariably' ];
		$things = ['things', 'items', 'amenities', 'conveniences' ];
		$there = ['There are', 'Of course, there are', 'Sure, there are', 'I know, there are'];
		$have = ['have to have', 'can\'t live without', 'just need', 'can\'t do without'];
		$is = ['is a list of all', 'are all of', 'is a complete list of', 'is an exhaustive list of'];
		$apt = ['communities', 'apartments', 'apartment communities', 'apartment complexes'];
		$showing = ['showing', 'boasting', 'advertising', 'displaying', 'featuring'];
		$town = ['town', 'our market'];

		$text = $there[$rand_two]." ".$always[$rand_six]." ".$things[$rand_one]." you ".$have[$rand_three]."!<br><br>So here ".$is[$rand_eight]." the ".$apt[$rand_nine]." in ".$town[$rand_four]." that are ".$showing[$rand_seven]." <span class='bolder'>'".$amen[$rand]."'</span> on their list of amenities:<ul class='spec_round_list'>";

		foreach($apt_ids as $key => $value){
			$this->db->where('ID', $value);
			$one_apt = $this->db->get('apartment_main')->result_array();


			$text_b = "<li class='list_smaller'><a class='spec_list_title' href='".base_url()."main/apartment/".$one_apt[0]['property_search_name']."/".$one_apt[0]['ID']."'>".$one_apt[0]['property_name']."</a></li>";

			$text .= $text_b;

		}

		$text .= "</ul>";

		if(count($apt_ids) == 1){
			$data['post_title'] = 'Only '.count($apt_ids).' San Angelo Apartment Has The Amenitiy: '.$amen[$rand];
		}else{
			$data['post_title'] = count($apt_ids).' San Angelo Apartments Have The Amenitiy: '.$amen[$rand];
		}

		

		$data['post_text'] = $text;

		// $users = $this->db->get('users')->result_array();
		// $all_emails = [];
		// foreach ($users as $key => $value) {
		// 	array_push($all_emails, $value['email']);
		// 	array_push($all_emails, $value['email_2']);
		// 	array_push($all_emails, $value['email_3']);
		// 	array_push($all_emails, $value['email_4']);
		// }

		// $this->load->library('email');
		// foreach ($all_emails as $key => $value) {
 			
		// 	$this->email->clear();
		// 	$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS');
		// 	$this->email->to($value);
		// 	$this->email->subject('Are Rents Up or Down This Month?');
		// 	$this->email->message('<h3 style="color:#3F79C9;">WHERE ARE RENTS HEADED?</h3><br>Our monthly blog report on rent trends is online. Take a look at it <a href="'.base_url().'main/blog">here</a>. <br><br>While you\'re there, take a look at your own rents and make sure they\'re current! Login <a href="'.base_url().'login/login_user">here</a>.');
		// 	$sent = $this->email->send();
		// }

		if(count($apt_ids) < 1){
			$data = 'N';
		}

		return $data;
	}

	public function email_no_models(){
		
		$this->db->distinct();
		$this->db->select('apt_id');
		$floorplans = $this->db->get('floorplans')->result_array();

		$all_emails = [];

		$yes_mod_apt_ids = [];
		foreach ($floorplans as $key => $value) {
			array_push($yes_mod_apt_ids, $value['apt_id']);
		}
		$this->db->where_not_in('ID', $yes_mod_apt_ids);
		$no_mod_apts = $this->db->get('apartment_main')->result_array();

		foreach ($no_mod_apts as $key => $value) {
			$apt['apt_name'] = $value['property_name'];
			
			$this->db->where('ID', $value['verified_user_id']);
			$user_data = $this->db->get('users', $value)->result_array();

			foreach($user_data as $key =>$value){
				$apt['email'] = $value['email'];
				array_push($all_emails, $apt);
				if($value['email_2'] != ''){
					$apt['email'] = $value['email_2'];
					array_push($all_emails, $apt);
				}
				if($value['email_3'] != ''){
					$apt['email'] = $value['email_3'];
					array_push($all_emails, $apt);
				}
				if($value['email_4'] != ''){
					$apt['email'] = $value['email_4'];
					array_push($all_emails, $apt);
				}

			}

		}


		// print_r($all_emails);
		// //for testing environment
		// $all_emails = [
		// 	0 => ['apt_name' => 'Red Sonja Apartments', 'email' => 'mileschick@gmail.com'],
		// 	1 => ['apt_name' => 'Bay Rum Apartments', 'email' => 'miles@bayrummedia.com'],
		// 	];

		$this->load->library('email');
		foreach ($all_emails as $key => $value) {
 			
			$this->email->clear();
			$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS');
			$this->email->to($value['email']);
			$this->email->subject('Enter Your Floorplans On SANANGELO.APARTMENTS for '.$value['apt_name']);
			$this->email->message('<h3 style="color:#3F79C9;">PLEASE! Take Some Time To Enter Floorplans For '.$value['apt_name'].'</h3><br>One of the best ways to search SANANGELO.APARTMENTS is by looking for specific floorplans and prices. <br><br>So, for example, if an apartment hunter comes to our site looking for a 1 bedroom, 1 bath between $400 and $1200 a month... <br>'.$value['apt_name'].' will not show up.<br>Why? Because you do not have any floorplans listed on the site.<br>YOU\'RE MISSING TRAFFIC!<br><br>Login and fix this here: <a href="'.base_url().'login/login_user">LOGIN</a>.<br>Use the \'EDIT APARTMENT INFO\' link on the right of the screen and follow the \'FLOORPLANS\' link under that to add, edit and delete Flooplans and Prices.<br><br>PS. This is an automated email and you will stop getting it after you enter your floorplans!');
			$sent = $this->email->send();
		}

		$fp_remind['sent_floorplan_reminder'] = date('Y-m-d');
		$this->db->insert('reminders', $fp_remind);
	}

	public function email_login_remind(){
		
		$all_users = $this->db->get('users')->result_array();

		$need_reminder_ids = [];
		date_default_timezone_set("America/Chicago");
		$date = date('d');

		foreach ($all_users as $key => $value) {

			$this->db->where('user_id', $value['ID']);
			$this->db->order_by('login_time', 'desc');
			$logins = $this->db->get('session_data')->result_array();

			$recent_login_date = date('d', strtotime($logins[0]['login_time']));
			$last_login = date('m-d-Y', strtotime($logins[0]['login_time']));
			$login_test = $date - $recent_login_date;

			if($login_test > 25){
				$username = $value['username'];

				$emails[0] = $value['email'];

				if($value['email_2'] != ''){
					array_push($emails, $value['email_2']);
				}
				if($value['email_3'] != ''){
					array_push($emails, $value['email_3']);
				}
				if($value['email_4'] != ''){
					array_push($emails, $value['email_4']);
				}

				$this->db->where('verified_user_id', $value['ID']);
				$apt_info = $this->db->get('apartment_main')->result_array();
				if(count($apt_info) > 0){
					$apt_name = $apt_info[0]['property_name'];
				}else{
					$apt_name = 'your apartment';
				}

				$this->load->library('email');
				foreach ($emails as $key => $value) {
		 			
					$this->email->clear();
					$this->email->from('donotreply@sanangelo.apartments', 'SANANGELO.APARTMENTS');
					$this->email->to($value);
					$this->email->subject('Update Your Info On SANANGELO.APARTMENTS for '.$apt_name);
					$this->email->message('<h3 style="color:#3F79C9;">It\'s been a while since you logged in to SANANGELO.APARTMENTS</h3>
						<br>Your last login for '.$apt_name.' was on: '.$last_login.' 

						<br><br>Here are some things you may need to do... 
						<br><br>&bull; Update your prices
						<br>&bull; Run a special
						<br>&bull; Update your Office Hours or Pet Policy
						<br>&bull; Put up some fresh pictures
						<br>&bull; Add or delete an amenity
						<br>&bull; Add floorplan diagrams to your floorplans
						<br>&bull; Edit your property description

						<br><br>Login here to update your apartment: <a href="'.base_url().'login/login_user">LOGIN</a>.

						<br><br>Your username is: '.$username.'

						<br><br>If you forgot your password, reset it here: <a href="'.base_url().'login/reset_password">RESET PASSWORD</a>.

						<br><br>PS. This is an automated email... once you login we\'ll stop bothering you. For a while at least :)');
					$sent = $this->email->send();
				}

			}
		}

		$login_remind['sent_login_reminder'] = date('Y-m-d');
		$this->db->insert('reminders', $login_remind);
	}

}


































































