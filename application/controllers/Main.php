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
        redirect('/', 'refresh');
    }









}
?>
