<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function make_amen($apt_id){
		echo $apt_id;
		$amenities = array(
				'55+ Community',
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
				'Swimming Pools',
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