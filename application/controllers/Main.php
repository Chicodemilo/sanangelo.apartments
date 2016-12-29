<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


// SESSION *********************************************************************************

	public function __construct(){
        parent::__construct();
        
    }


	// function is_logged_in(){
	// 	$is_logged_in = $this->session->userdata('is_logged_in');
 //        $user_role = $this->session->userdata('role');

	// 	if(!isset($is_logged_in) || $is_logged_in != true || $user_role != 'Master'){
	// 		redirect('login/login_user', 'refresh');
	// 	}
	// }


// INDEX *********************************************************************************

    public function index(){
        redirect(base_url(), 'refresh');
    }

   	public function find_apts(){
        $search_items = $_GET;
        $new_url = base_url().'texas/find_apts?';

        foreach ($search_items as $key => $value) {
            $new_url .= $key.'='.$value.'&';
        }
        redirect($new_url, 'refresh');
    }

    public function blog($offset = 0){
    	redirect(base_url().'texas/blog', 'refresh');
    }

    public function apartment($apt_name, $apt_id){
    	redirect(base_url().'texas/apartment/'.$apt_name.'/'.$apt_id, 'refresh');
    }

    public function map(){
    	redirect(base_url().'texas/map', 'refresh');
    }

    public function this_blog($id = 1){
    	redirect(base_url().'texas/this_blog/'.$id, 'refresh');
    }








}
?>
