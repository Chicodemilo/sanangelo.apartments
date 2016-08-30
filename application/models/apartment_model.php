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

			$ci->db->where('ID', $apt_id);
			$ci->db->where('takeover', 'Y');
			$takeover = $ci->db->get('sales')->result_array();
			if(count($takeover) > 0){
				$data['level'] = 1;
			}

			$ci->db->where('ID', $apt_id);
			$ci->db->where('basic', 'Y');
			$ci->db->where('takeover', 'N');
			$basic = $ci->db->get('sales')->result_array();
			if(count($basic) > 0){
				$data['level'] = 2;
			}

			$ci->db->where('ID', $apt_id);
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
				$this->email->message('<h3 style="color:#3F79C9;">You have a contact from SANAGELO.APARTMENTS</h3><br><br>DATE: '.$data['time'].'<br><br>FROM: '.$data['email'].'<br><br>MESSAGE: '.$data['message']);
				$sent = $this->email->send();
 			}else{
 				$this->email->clear();
				$this->email->from('donotreply@sanangelo.apartments', 'CONTACT FORM SANANGELO.APARTMENTS');
				$this->email->to($value);
				$this->email->subject('SANANGELO.APARTMENTS: CONTACT FORM');
				$this->email->message('<h3 style="color:#3F79C9;">Someone just tried to contact you from SANAGELO.APARTMENTS</h3><br>Upgrade from our FREE Account to our BASIC Account and get all these leads! <br><br>Call us at 866-800-4727 today.' );
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

}


































































