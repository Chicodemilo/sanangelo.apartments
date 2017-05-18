<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {


// SESSION *********************************************************************************

	public function __construct(){
        parent::__construct();
        $this->is_logged_in();
        
    }


	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
        $user_role = $this->session->userdata('role');

		if(!isset($is_logged_in) || $is_logged_in != true || $user_role != 'Master'){
			redirect('login/login_user', 'refresh');
		}
	}


// INDEX *********************************************************************************

   	public function index(){
        $this->load->view('admin/master_header.php');
        $this->load->view('admin/master_edit_page.php');
        $this->load->view('admin/master_footer.php'); 
    }



// // MAKE A NEW APT *********************************************************************************

    public function new_apt(){
        $this->load->model('admin_model');
        $data['unused_ids'] = $this->admin_model->get_open_users();

        if($data['unused_ids'] == 'N'){
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/no_unused.php');
            $this->load->view('admin/master_footer.php');
        }else{
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/make_new_apt.php', $data);
            $this->load->view('admin/master_footer.php');
        }
    }


// // MAKE A NEW USER *********************************************************************************

    public function make_new_user(){
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/make_new_user.php');
            $this->load->view('admin/master_footer.php');
    }

    public function submit_new_user(){
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $email_2 = $this->input->post('email_2');
        $email_3 = $this->input->post('email_3');
        $email_4 = $this->input->post('email_4');
        $verified = $this->input->post('verified');
        $role = $this->input->post('role');
        date_default_timezone_set("America/Chicago");
        $date = date('Y-m-d H:i:s');
        $get_messages = 'Y';
        $password = $this->input->post('password');
        $temp_pw = $this->input->post('password');

        $password = hash('sha256', $password.SALT);

        $sql = "INSERT INTO users (username, password, temp_pw, email, email_2, email_3, email_4, role, verified, date_added, get_messages) 
        VALUES ('".$username."',
                '".$password."',
                '".$temp_pw."',
                '".$email."',
                '".$email_2."',
                '".$email_3."',
                '".$email_4."',
                '".$role."',
                '".$verified."',
                '".$date."',
                '".$get_messages."')
        ";

        $result = $this->db->query($sql);

        redirect(base_url()."admin/new_apt");
    }

    public function these_users(){
        $this->load->model('admin_model');
        $data['open_users'] = $this->admin_model->get_open_users();
        $data['used_users'] = $this->admin_model->get_used_users();

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/see_all_users.php', $data);
        $this->load->view('admin/master_footer.php');
    }

    public function delete_user($user_id){
        $this->db->where('ID', $user_id);
        $this->db->delete('users');
        redirect(base_url()."admin/these_users");
    }

    public function toggle_verification($user_id, $verification_status){
        if($verification_status == 'Y'){
            $data['verified'] = 'N';
        }else{
            $data['verified'] = 'Y';
        }

        $this->db->where('ID', $user_id);
        $this->db->update('users', $data);
        redirect(base_url()."admin/these_users");
    }

    public function reset_user_pw($user_id){
        $this->db->where('ID', $user_id);
        $this_user = $this->db->get('users')->result_array();

        $username = $this_user[0]['username'];

        $this->load->model('model_user');
        $this->model_user->do_reset_this_password($username);

        redirect(base_url()."admin/these_users");
    }

// // DELETE AN APT *********************************************************************************

    public function delete_apt($apt_id)
    {
        $this->db->where('ID', $apt_id);
        $this->db->delete('apartment_main');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('contact');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('floorplans');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('man_logo');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('office_hours');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('our_amenities_list');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('pet_policy');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('pictures');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('sales');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('session_data');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('special');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('their_amenities_list');

        $this->db->where('apt_id', $apt_id);
        $this->db->delete('upcoming_sales');

        redirect(base_url().'admin/all_apts');
    }


// // SUSPEND AN APT *********************************************************************************

    public function suspend_apt($apt_id)
    {
        $data['suspend'] = 'Y';

        $this->db->where('ID', $apt_id);
        $this->db->update('apartment_main', $data);

        $this->db->where('apt_id', $apt_id);
        $this->db->update('sales', $data);

        $this->db->where('apt_id', $apt_id);
        $this->db->update('floorplans', $data);

        redirect(base_url().'admin/all_apts');
    }

// // UN-SUSPEND AN APT *********************************************************************************

    public function unsuspend_apt($apt_id)
    {
        $data['suspend'] = 'N';
        $this->db->where('ID', $apt_id);
        $this->db->update('apartment_main', $data);

        $this->db->where('apt_id', $apt_id);
        $this->db->update('sales', $data);

        $this->db->where('apt_id', $apt_id);
        $this->db->update('floorplans', $data);

        redirect(base_url().'admin/all_apts');
    }


// // AMENITIES *********************************************************************************

    public function amenities($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_id'] = $apt_id;
        $count_data['apt_name'] = $main_info[0]['property_search_name'];

        $this->load->model('edit_model', 'our_amenities');
        $our_amenities_list = $this->our_amenities->get_our_amenities($apt_id)->result_array();
        $this->load->model('edit_model', 'their_amenities');
        $their_amenities_list = $this->their_amenities->get_thier_amenities($apt_id)->result_array();
        foreach($our_amenities_list as $k=>$v){
            $active[$k] = $v['active'];
            $name[$k] = $v['name'];
        }

        array_multisort($active, SORT_DESC, $name, SORT_ASC, $our_amenities_list);

        foreach ($their_amenities_list as $k => $v) {
            $their_active[$k] = $v['active'];
            $their_name[$k] = $v['name'];
        }
        if(count($their_amenities_list) > 0){
            array_multisort($their_active, SORT_DESC, $their_name, SORT_ASC, $their_amenities_list);
        }
        
        $data['our_amenities_list'] = $our_amenities_list;
        $data['their_amenities_list'] = $their_amenities_list;
        
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/edit_amenities.php', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function submit_amenities($apt_id){
        $data = $_POST;
        foreach ($data as $key => $value) {
            if($value['active'] == 'N'){
                $value['select_units'] = 'N';
                $value['extra_fees'] = 'N';
            }

            $this->db->where('apt_id', $apt_id);
            $this->db->where('id', $value['id']);
            $update = $this->db->update('our_amenities_list', $value);
        }
        redirect(base_url().'admin/amenities/'.$apt_id);
    }


    public function submit_their_amenities($apt_id){
        $data = $_POST;
        foreach ($data as $key => $value) {
            if($value['active'] == 'N'){
                $value['select_units'] = 'N';
                $value['extra_fees'] = 'N';
            }
            $this->db->where('apt_id', $apt_id);
            $this->db->where('id', $value['id']);
            $update = $this->db->update('their_amenities_list', $value);
        }
        redirect(base_url().'admin/amenities/'.$apt_id);
    }

    public function create_their_amenities($apt_id){
        $data = $_POST;
        $data['select_units'] = 'N';
        $data['extra_fees'] = 'N';
        $data['apt_id'] = $apt_id;
        $this->db->insert('their_amenities_list', $data);
        redirect(base_url().'admin/amenities/'.$apt_id);
    }

    public function delete_amenity($apt_id, $id){

        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('their_amenities_list');
        redirect(base_url().'admin/amenities/'.$apt_id);
    }

// // INSERT NEW APT *********************************************************************************

    public function submit_new_apt(){
        $data = array();
        foreach ($_POST as $key => $value) {
            if($key == 'property_color_1' || $key == 'property_color_2'){
                $value = substr($value, 1);
            }
            if($key == 'verified_user_id'){
                $user_id = $value;
            }
            if($key == 'property_name'){
                $property_name = $value;
                $data['property_search_name'] = str_replace(' ', '_', $property_name);
            }
            $data['show_top'] = 'N';
            $data[$key] = $value;
        }
        $verify_data['verified'] = 'Y';
        $this->db->where('ID', $user_id);
        $this->db->update('users', $verify_data);

        $this->db->insert('apartment_main', $data);
        $apt_id = $this->db->insert_id();

        $this->load->model('admin_model');
        $this->admin_model->make_amen($apt_id);

        $sales_data=[
            'apt_id' => $apt_id,
            'property_name' => $property_name,
            'free' => 'Y',
            'basic' => 'N',
            'takeover' => 'N',
        ];
        $this->db->insert('sales', $sales_data);



        if(!is_dir('./images/pictures/'.$apt_id)){
            mkdir('./images/pictures/'.$apt_id.'/generic', 0777, true);
        }

        copy('./images/pictures/generic/generic.jpg', './images/pictures/'.$apt_id.'/generic/generic.jpg');


        redirect(base_url().'admin');
    }


// // SEND AN EMAIL TO ALL APTS *********************************************************************************

    public function send_email_all(){
        $this->load->model('admin_model');
        $old_message = $this->admin_model->get_old_message();

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/adv_mssg_page.php', $old_message);
        $this->load->view('admin/master_footer.php');
     }


     public function submit_mssg(){
        $data['adv_mssg_mssg'] = $_POST['adv_mssg_mssg'];
        $data['adv_mssg_email_only'] = $_POST['adv_mssg_email_only'];
        $data['email_subject'] = $_POST['email_subject'];
        $data['adv_mssg_on'] = $_POST['adv_mssg_on'];
        $data['email_adv'] = $_POST['email_adv'];
        $data['adv_mssg_start'] = $_POST['adv_mssg_start'];
        $data['adv_mssg_end'] = $_POST['adv_mssg_end'];
        $data['include_user'] = $_POST['include_user'];
        $data['include_email'] = $_POST['include_email'];
        $data['include_password'] = $_POST['include_password'];
        $data['include_link'] = $_POST['include_link'];

        $this->load->model('admin_model');
        $send = $this->admin_model->send_save_mssg($data);

        redirect(base_url().'admin');
     }


// // MAIN EDIT APT *********************************************************************************

     public function all_apts(){
        $this->load->model('admin_model');
        $all_apts['result'] = $this->admin_model->get_all_current_apts();
        $all_apts['suspended'] = $this->admin_model->get_all_suspended_apts();

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/see_all_apts.php', $all_apts);
        $this->load->view('admin/master_footer.php');
     }


    public function edit_this_apt($apt_id = 0){
        $user_role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);
        $data = array('main_info' => $main_info);

        $adv_mssg = $this->edit_model->get_adv_mssg($apt_id);
        $data['adv_mssg'] = $adv_mssg['adv_mssg'];
        $data['adv_pic'] = $adv_mssg['adv_pic'];
        $data['their_mssg'] = $adv_mssg['their_mssg'];

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_id'] = $apt_id;
        $count_data['apt_name'] = $main_info[0]['property_search_name'];

        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/edit_page.php', $data);
        $this->load->view('admin/edit/footer.php'); 
    }

    public function submit_main_edits($apt_id){
        $data = array();
        foreach ($_POST as $key => $value) {
            if($key == 'property_color_1' || $key == 'property_color_2'){
                $value = substr($value, 1);
            }
            $data[$key] = $value;
        }
        $this->db->where('ID', $apt_id);
        $this->db->update('apartment_main', $data);
        redirect(base_url().'admin/edit_this_apt/'.$apt_id);
    }

// // HOURS *********************************************************************************

    public function hours($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_id'] = $apt_id;
        $count_data['apt_name'] = $main_info[0]['property_search_name'];

        
        $this->load->model('edit_model', 'hours');
        $office_hours = $this->hours->get_hours($apt_id)->result_array();

        $data['office_hours'] = $office_hours;
        $data['apt_id'] = $apt_id;
        $data['apt_name'] = $main_info[0]['property_search_name'];;

        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/hours.php', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function submit_hours($apt_id){
        $data['apt_id'] = $apt_id;
        $data['day_type'] = $_POST['day_type'];
        $data['open_hour'] = $_POST['open_hour'];
        $data['open_min'] = $_POST['open_min'];
        $data['open_am_pm'] = $_POST['open_am_pm'];
        $data['close_hour'] = $_POST['close_hour'];
        $data['close_min'] = $_POST['close_min'];
        $data['close_am_pm'] = $_POST['close_am_pm'];
        $data['day_condition'] = $_POST['day_condition'];

        if($data['day_type'] == "Monday - Friday"){
            $data['hours_order'] = 1;
        }
        if($data['day_type'] == "Monday - Thursday"){
            $data['hours_order'] = 2;
        }
        if($data['day_type'] == "Monday"){
            $data['hours_order'] = 3;
        }
        if($data['day_type'] == "Tuesday"){
            $data['hours_order'] = 4;
        }
        if($data['day_type'] == "Wednesday"){
            $data['hours_order'] = 5;
        }
        if($data['day_type'] == "Thursday"){
            $data['hours_order'] = 6;
        }
        if($data['day_type'] == "Friday"){
            $data['hours_order'] = 7;
        }
        if($data['day_type'] == "Saturday"){
            $data['hours_order'] = 8;
        }
        if($data['day_type'] == "Sunday"){
            $data['hours_order'] = 9;
        }
        $this->db->insert('office_hours', $data);
        redirect(base_url().'admin/hours/'.$apt_id);
    }


    public function delete_hours($apt_id, $id){
        
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('office_hours');
        redirect(base_url().'admin/hours/'.$apt_id);
    }


// // FLOORPLANS *********************************************************************************

    public function floorplans($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];


        $this->load->model('edit_model', 'floorplans');
        $floorplans = $this->floorplans->get_floorplans($apt_id)->result_array();

        $data['floorplans'] = $floorplans;
        $data['apt_id'] = $apt_id;

        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/floorplans.php', $data);
        $this->load->view('admin/edit/footer.php');

    }

    public function submit_floorplans($apt_id){
        $data = $_POST;
        $data['apt_id'] = $apt_id;
        $this->db->insert('floorplans', $data);
        redirect(base_url().'admin/floorplans/'.$apt_id);
    }

    public function delete_floorplan($apt_id, $id){
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('floorplans');

        $files = glob('./images/floorplans/'.$apt_id.'/'.$id.'/*'); 
        foreach($files as $file){ 
          if(is_file($file))
            unlink($file); }

         if(is_dir('./images/floorplans/'.$apt_id.'/'.$id)){
            rmdir('./images/floorplans/'.$apt_id.'/'.$id);
        }

        redirect(base_url().'admin/floorplans/'.$apt_id);
    }

    public function edit_floorplan($apt_id, $id = 0){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];


        
        if($id == 0){
            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/no_resource.php');
            $this->load->view('admin/edit/footer.php');
        }else{
            $this->load->model('edit_model','edit_model');
            $data['floorplan_info'] = $this->edit_model->get_flooplan_info($apt_id, $id)->result_array();
            $data['error'] = '';
            $data['apt_id'] = $apt_id;
            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/do_edit_this_floorplan.php', $data);
            $this->load->view('admin/edit/footer.php');
        }
    }

    public function submit_floorplan_edits($apt_id, $id){
        $data = $_POST;
        $data['apt_id'] = $apt_id;
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->update('floorplans', $data);
        redirect(base_url().'admin/floorplans/'.$apt_id);
    }


    public function upload_this($apt_id, $id){
        $data = array('id' => $id, 'error' => '', 'apt_id' => $apt_id);

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];

        
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_this', $data);
        $this->load->view('admin/edit/footer.php');

    }

    function do_upload_floorplan($apt_id, $id)
    {   $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];

        if(!is_dir('./images/floorplans/'.$apt_id.'/'.$id)){
            mkdir('./images/floorplans/'.$apt_id.'/'.$id, 0777, true);
        }

        $files = glob('./images/floorplans/'.$apt_id.'/'.$id.'/*'); 
        foreach($files as $file){ 
          if(is_file($file))
            unlink($file); }

        $config['upload_path'] = './images/floorplans/'.$apt_id.'/'.$id;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '4048';
        $config['max_width']  = '4024';
        $config['max_height']  = '1868';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $data['id'] = $id;

            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/upload_this', $data);
            $this->load->view('admin/edit/footer.php');
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->model('edit_model','edit_model');
            $data['floorplan_info'] = $this->edit_model->get_flooplan_info($apt_id, $id)->result_array();

            $file_name = $data['upload_data']['file_name'];
            $data_b['floorplan_pic'] = $file_name;

            $this->db->where('apt_id', $apt_id);
            $this->db->where('id', $id);
            $this->db->update('floorplans', $data_b);     
            redirect('admin/floorplans/'.$apt_id);
        }
    }

    function delete_this_diagram($apt_id, $id = 0){
        $data['floorplan_pic'] = '';
        $this->db->where('apt_id',$apt_id);
        $this->db->where('id', $id);
        $this->db->update('floorplans', $data);

        $files = glob('./images/floorplans/'.$apt_id.'/'.$id.'/*'); 
        foreach($files as $file){ 
          if(is_file($file))
            unlink($file); }

        if(is_dir('./images/floorplans/'.$apt_id.'/'.$id)){
            rmdir('./images/floorplans/'.$apt_id.'/'.$id);
        }
        redirect('admin/edit_floorplan/'.$apt_id."/".$id);
    }



// // PETS *********************************************************************************

    public function pets($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $this->load->model('edit_model', 'pets');
        $pets = $this->pets->get_pets($apt_id)->result_array();

        $data['pets'] = $pets;

        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/pets.php', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function submit_pets($apt_id){
        $data = $_POST;
        $data['apt_id'] = $apt_id;
        $this->db->where('apt_id', $data['apt_id']);
        $this->db->delete('pet_policy');
        
        $this->db->insert('pet_policy', $data);
        redirect(base_url().'admin/pets/'.$apt_id);
    }


    public function delete_pets($apt_id, $id){
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('pet_policy');
        redirect(base_url().'admin/pets/'.$apt_id);

    }



// // SPECIALS *********************************************************************************

    public function specials($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $this->load->model('edit_model', 'specials');
        $specials = $this->specials->get_specials($apt_id)->result_array();

        $data['specials'] = $specials;

        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/specials.php', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function submit_specials($apt_id){
        $data = $_POST;
        $data['apt_id'] = $apt_id;
        
        $this->db->where('apt_id', $data['apt_id']);
        $this->db->delete('special');

        $this->db->insert('special', $data);
        redirect(base_url().'admin/specials/'.$apt_id);
    }

    public function delete_special($apt_id, $id){
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('special');
        redirect(base_url().'admin/specials/'.$apt_id);

    }




// // USERS *********************************************************************************

    public function users($apt_id){
        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $user_id = $main_info[0]['verified_user_id'];

        $this->load->model('edit_model', 'users');
        $users = $this->users->get_user($user_id)->result_array();

        $data['users'] = $users;

        $recent_logins = $this->users->get_recent_logins($user_id)->result_array();
        $data['recent_logins'] = $recent_logins;
        $data['apt_id'] = $apt_id;


        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/users.php', $data);
        $this->load->view('admin/edit/footer.php');
    }


    public function submit_users($apt_id, $id){
        $this->load->model('edit_model', 'user');
        $user = $this->user->get_user($id)->result_array();
        $data['user'] = $user;

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        if(count($user) > 0){
            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/edit_user.php', $data);
            $this->load->view('admin/edit/footer.php');      
        }else{
            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/no_resource.php');
            $this->load->view('admin/edit/footer.php');
        }
    }


    public function submit_user_edits($apt_id, $id){
        $data = $_POST;
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        redirect(base_url().'admin/users/'.$apt_id, 'refresh');
    }


    public function change_password($apt_id, $id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $data = array('id' => $id);
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/change_password.php', $data);
        $this->load->view('admin/edit/footer.php');
    }


    public function submit_change_password($apt_id, $id){
        $password = $this->input->post('password');
        $password = hash('sha256', $password.SALT);
        $data['password'] = $password;
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        redirect(base_url().'admin/users/'.$apt_id);
    }

// // PICTURES *********************************************************************************

public function pictures($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $this->load->model('edit_model', 'pictures');
        $data['pictures']= $this->pictures->get_pictures($apt_id)->result_array();
        $data['logo']= $this->pictures->get_logo($apt_id)->result_array();
        $data['man_logo']= $this->pictures->get_man_logo($apt_id)->result_array();
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/pictures.php', $data);
        $this->load->view('admin/edit/footer.php');
}


public function picture_delete($apt_id, $id){
    $this->load->helper('file');
    $this->db->where('apt_id', $apt_id);
    $this->db->where('id', $id);
    $this->db->delete('pictures');
    $this->load->model('edit_model', 'pictures');
    $this->pictures->reorder_pictures($apt_id);
    $files = glob('./images/pictures/'.$apt_id.'/'.$id.'/*'); 
    foreach($files as $file){ 
      if(is_file($file))
        unlink($file); }

    if(is_dir('./images/pictures/'.$apt_id.'/'.$id)){
        rmdir('./images/pictures/'.$apt_id.'/'.$id);
    }
    redirect(base_url().'admin/pictures/'.$apt_id, 'refresh');
}


public function picture_upload($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $this->load->model('edit_model');
    $count = count($this->edit_model->get_pictures($apt_id)->result_array());
    if($count < 10){
        $data = array('error' => '');
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_picture', $data);
        $this->load->view('admin/edit/footer.php');
    }else{
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/too_many_pics');
        $this->load->view('admin/edit/footer.php');
    }
}


public function do_upload_picture($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $this->load->model('edit_model', 'id');
    $new_pic_data = $this->id->get_new_picture_data($apt_id);
    $id = $new_pic_data['id'];

    if(!is_dir('./images/pictures/'.$apt_id.'/'.$id)){
            mkdir('./images/pictures/'.$apt_id.'/'.$id, 0777, true);
        }else{
            $files = glob('./images/pictures/'.$apt_id.'/'.$id.'/*'); 
            foreach($files as $file){ 
              if(is_file($file))
                unlink($file); }
        }
                
        $config['upload_path'] = './images/pictures/'.$apt_id.'/'.$id;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3000';
        $config['max_width']  = '10000';
        $config['max_height']  = '10000';
        $config['min_width'] = '500';
        $config['min_height'] = '300';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $data['id'] = $id;
            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/upload_picture', $data);
            $this->load->view('admin/edit/footer.php');
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->where('apt_id', $apt_id);
            $this->db->insert('pictures', $new_pic_data);

            $data = array('upload_data' => $this->upload->data());

            $file_name = $data['upload_data']['file_name'];
            $data_b['name'] = $file_name;

            $this->db->where('id', $id);
            $this->db->where('apt_id', $apt_id);
            $this->db->update('pictures', $data_b);     
            redirect(base_url().'admin/picture_edit/'.$apt_id.'/'.$id);
        }
}



public function picture_edit($apt_id, $id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $this->load->model('edit_model', 'picture');
    $data['picture'] = $this->picture->get_picture_data($apt_id, $id);
    $data['count'] = count($this->picture->get_pictures($apt_id)->result_array());
    $this->load->view('admin/edit/header.php', $count_data);
    $this->load->view('admin/edit/edit_picture', $data);
    $this->load->view('admin/edit/footer.php');
}



public function submit_picture_edits($apt_id, $id){
    $caption = $this->input->post('caption');
    $cover_pic = $this->input->post('cover_pic');
    $pic_order = $this->input->post('pic_order');
    $active = $this->input->post('active');

    if($cover_pic == 'Y'){
        $this->load->model('edit_model', 'cover_pic');
        $this->cover_pic->make_cover_pic($apt_id, $id);
    }

    $this->load->model('edit_model', 'picture');
    $old_pic_data = $this->picture->get_picture_data($apt_id, $id);
    $old_order = $old_pic_data[0]['pic_order'];
    if($old_order != $pic_order){
        $this->load->model('edit_model', 'renumber_pics');
        $this->renumber_pics->insert_pic_in_order($apt_id, $id, $pic_order, $old_order);
    }
    $data = array('caption' => $caption, 'active' => $active, 'cover_pic' => $cover_pic);
    $this->db->where('apt_id', $apt_id);
    $this->db->where('id', $id);
    $this->db->update('pictures', $data);

    redirect(base_url().'admin/pictures/'.$apt_id);

}


public function logo_upload($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $data = array('error' => '');
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_logo', $data);
        $this->load->view('admin/edit/footer.php');
}


public function do_upload_logo($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $this->db->where('apt_id', $apt_id);
    $this->db->where('logo', 'Y');
    $this->db->delete('pictures');
    $this->load->helper('file');

    if(!is_dir('./images/logos/property/'.$apt_id)){
            mkdir('./images/logos/property/'.$apt_id, 0777, true);
        }else{
            $files = glob('./images/logos/property/'.$apt_id.'/*'); 
            foreach($files as $file){ 
              if(is_file($file))
                unlink($file); }
        }

    $this->load->model('edit_model', 'id');
    $new_pic_data = $this->id->get_new_logo_data($apt_id);
    $id = $new_pic_data['id'];
                
    $config['upload_path'] = './images/logos/property/'.$apt_id;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '3048';
    $config['max_width']  = '6024';
    $config['max_height']  = '6068';
    $config['min_width'] = '300';
    $config['min_height'] = '300';
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
    {
        $data['error'] = $this->upload->display_errors();
        $data['id'] = $id;
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_logo', $data);
        $this->load->view('admin/edit/footer.php');
    }
    else
    {   $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->insert('pictures', $new_pic_data);

        $data = array('upload_data' => $this->upload->data());

        $file_name = $data['upload_data']['file_name'];
        $data_b['name'] = $file_name;

        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->update('pictures', $data_b);     
        redirect(base_url().'admin/pictures/'.$apt_id);
    }
}

public function logo_delete($apt_id, $id){
    $this->load->helper('file');
    $this->db->where('apt_id', $apt_id);
    $this->db->where('id', $id);
    $this->db->delete('pictures');
    $files = glob('./images/logos/property/'.$apt_id.'/*'); 
            foreach($files as $file){ 
              if(is_file($file))
                unlink($file); }
    redirect(base_url().'admin/pictures/'.$apt_id, 'refresh');
}

public function man_logo_upload($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $data = array('error' => '', 'apt_id' => $apt_id);
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_man_logo', $data);
        $this->load->view('admin/edit/footer.php');
}


public function do_upload_man_logo($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $this->db->where('apt_id', $apt_id);
    $this->db->delete('man_logo');
    $this->load->helper('file');
    delete_files('./images/logos/management/'.$apt_id);

    if(!is_dir('./images/logos/management/'.$apt_id)){
            mkdir('./images/logos/management/'.$apt_id, 0777, true);
        }
                
        $config['upload_path'] = './images/logos/management/'.$apt_id;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width']  = '12024';
        $config['max_height']  = '12024';
        $config['min_width'] = '50';
        $config['min_height'] = '50';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $data['apt_id'] = $apt_id;
            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/upload_man_logo', $data);
            $this->load->view('admin/edit/footer.php');
        }
        else
        {   
            $data = array('upload_data' => $this->upload->data());

            $file_name = $data['upload_data']['file_name'];
            $data_b['name'] = $file_name;
            $data_b['apt_id'] = $apt_id;

            $this->db->insert('man_logo', $data_b);     
            redirect(base_url().'admin/pictures/'.$apt_id);
        }
}


public function man_logo_delete($apt_id){
    $this->load->helper('file');
    $this->db->where('apt_id', $apt_id);
    $this->db->delete('man_logo');
    delete_files('./images/logos/management/'.$apt_id);
    redirect(base_url().'admin/pictures/'.$apt_id, 'refresh');
}

// MESSAGES *******************************************************************************

    public function messages($apt_id){

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $this->load->model('edit_model', 'messages');
        $messages = $this->messages->get_messages($apt_id)->result_array();
        $data['messages'] = $messages;
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/messages.php', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function delete_message($apt_id, $id){
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('contact');
        redirect(base_url().'admin/messages/'.$apt_id);
    }



// ADVERTISING *******************************************************************************

    public function edit_advertising($apt_id, $feedback = ''){
        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $this->load->model('admin_model');
        $data['cost'] = $this->admin_model->get_prices()->result_array();
        $data['upcoming_sales'] = $this->admin_model->get_adv_upcoming_sales($apt_id);
        $data['taken_sales'] = $this->admin_model->get_taken_sales();
        $data['feedback'] = str_replace("%20"," ",$feedback);

        $data['banner_names'] = $this->admin_model->get_banner_names($apt_id);
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/edit_advertising.php', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function submit_level($apt_id){
        $data = $_POST;
        $this->db->insert('upcoming_sales', $data);

        $this->load->model('admin_model');
        $this->admin_model->level_check_dates_and_change();

        redirect(base_url().'admin/edit_advertising/'.$apt_id);
    }

    public function submit_top_3($apt_id){
        $data = $_POST;
        $a_date = $data['start_date'];
        $data['end_date'] = date('Y-m-t', strtotime($a_date));
        $data['start_date'] = date('Y-m-'.'01', strtotime($a_date));

        $this->load->model('admin_model');
        $clean_date = $this->admin_model->check_top_3($data['start_date'], $apt_id);

        if($clean_date == 'Y'){
            $this->db->insert('upcoming_sales', $data);

            $this->load->model('admin_model');
            $this->admin_model->top_three_check_dates_and_change();

            redirect(base_url().'admin/edit_advertising/'.$apt_id);
        }else{
            redirect(base_url().'admin/edit_advertising/'.$apt_id."/".$clean_date);
        }
    }

    public function submit_sto($apt_id){

        $data = $_POST;
        $data['end_date'] = $data['start_date'];

        $this->load->model('admin_model');
        $clean_date = $this->admin_model->check_sto($data['start_date'], $apt_id);
        $banner_names = $this->admin_model->get_banner_names($apt_id);
        if($banner_names != 'N'){
            $data['left_takeover_name'] = $banner_names['left_takeover_name'];
            $data['right_takeover_name'] = $banner_names['right_takeover_name'];
            $data['top_takeover_name'] = $banner_names['top_takeover_name'];
            $data['mobile_takeover_name'] = $banner_names['mobile_takeover_name'];
        }

        if($clean_date == 'Y'){
            $this->db->insert('upcoming_sales', $data);

            $this->load->model('admin_model');
            $this->admin_model->sto_check_dates_and_change();


            redirect(base_url().'admin/edit_advertising/'.$apt_id);
        }else{
            redirect(base_url().'admin/edit_advertising/'.$apt_id."/".$clean_date);
        }
    }

    public function delete_this_advertising($advertisement_id, $apt_id)   
    {
        $this->db->where('ID', $advertisement_id);
        $this->db->delete('upcoming_sales');

        $this->load->model('admin_model');
        $this->admin_model->level_check_dates_and_change();
        $this->admin_model->top_three_check_dates_and_change();
        $this->admin_model->sto_check_dates_and_change();

        redirect(base_url().'admin/edit_advertising/'.$apt_id);
    }

    public function delete_this_advertising_all_ads($advertisement_id, $order)   
    {
        $this->db->where('ID', $advertisement_id);
        $this->db->delete('upcoming_sales');

        $this->load->model('admin_model');
        $this->admin_model->level_check_dates_and_change();
        $this->admin_model->top_three_check_dates_and_change();
        $this->admin_model->sto_check_dates_and_change();

        redirect(base_url().'admin/see_all_ads/'.$order);
    }



// COST *******************************************************************************

    public function edit_cost(){
        $this->load->model('admin_model');
        $data['prices'] = $this->admin_model->get_prices()->result_array();

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/cost_edit_page.php', $data);
        $this->load->view('admin/master_footer.php'); 
    }

    public function submit_cost(){
        
        $data = $_POST;
        // print_r($data);
        $this->db->where('ID', $_POST['ID']);
        $this->db->update('cost', $data);echo "here";
        redirect(base_url().'admin/edit_cost');
    }



// BANNER UPLOAD *******************************************************************************

    public function left_banner_upload($apt_id){
        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $data['error'] = $error;
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_left_banner', $data);
        $this->load->view('admin/edit/footer.php');
    }


    public function right_banner_upload($apt_id){
        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $data['error'] = $error;
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_right_banner', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function top_banner_upload($apt_id){
        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $data['error'] = $error;
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_top_banner', $data);
        $this->load->view('admin/edit/footer.php');
    }

    public function mobile_banner_upload($apt_id){
        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];
        $count_data['apt_name'] = $main_info[0]['property_search_name'];
        $count_data['apt_id'] = $apt_id;

        $data['error'] = $error;
        $this->load->view('admin/edit/header.php', $count_data);
        $this->load->view('admin/edit/upload_mobile_banner', $data);
        $this->load->view('admin/edit/footer.php');
    }


public function do_upload_left_banner($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $config['upload_path'] = './images/takeover/left/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '1000';
    $config['max_width']  = '180';
    $config['max_height']  = '710';
    $config['min_width'] = '160';
    $config['min_height'] = '690';
    $this->load->library('upload', $config);

    $this->load->model('admin_model');
    $banner_names = $this->admin_model->get_banner_names($apt_id);

    $this->load->helper('file');

    $file = "./images/takeover/left/".$banner_names['left_takeover_name'];
    if($banner_names['left_takeover_name'] != ''){
            unlink($file); 
        }

    if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->model('edit_model');
            $main_info = $this->edit_model->get_main_info($apt_id);

            $count_data['views_all'] = $main_info[0]['views_all'];
            $count_data['views_year'] = $main_info[0]['views_year'];
            $count_data['views_month'] = $main_info[0]['views_month'];
            $count_data['views_day'] = $main_info[0]['views_day'];
            $count_data['views_last_month'] = $main_info[0]['views_last_month'];
            $count_data['views_last_day'] = $main_info[0]['views_last_day'];
            $count_data['apt_name'] = $main_info[0]['property_search_name'];
            $count_data['apt_id'] = $apt_id;

            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/upload_left_banner', $data);
            $this->load->view('admin/edit/footer.php');
        }
        else
        {   
            $data = array('upload_data' => $this->upload->data());

            $file_name = $data['upload_data']['file_name'];
            $data_b['left_takeover_name'] = $file_name;

            $this->db->where('apt_id', $apt_id);
            $this->db->where('item', 'site_takeover');
            $this->db->update('upcoming_sales', $data_b);

            $this->db->where('apt_id', $apt_id);
            $this->db->update('sales', $data_b);
         
            redirect(base_url().'admin/edit_advertising/'.$apt_id);
        }
    }

public function do_upload_right_banner($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $config['upload_path'] = './images/takeover/right/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '1000';
    $config['max_width']  = '180';
    $config['max_height']  = '710';
    $config['min_width'] = '160';
    $config['min_height'] = '690';
    $this->load->library('upload', $config);

    $this->load->model('admin_model');
    $banner_names = $this->admin_model->get_banner_names($apt_id);

    $this->load->helper('file');

    $file = "./images/takeover/right/".$banner_names['right_takeover_name'];
    if($banner_names['right_takeover_name'] != ''){
            unlink($file); 
        }

    if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->model('edit_model');
            $main_info = $this->edit_model->get_main_info($apt_id);

            $count_data['views_all'] = $main_info[0]['views_all'];
            $count_data['views_year'] = $main_info[0]['views_year'];
            $count_data['views_month'] = $main_info[0]['views_month'];
            $count_data['views_day'] = $main_info[0]['views_day'];
            $count_data['views_last_month'] = $main_info[0]['views_last_month'];
            $count_data['views_last_day'] = $main_info[0]['views_last_day'];
            $count_data['apt_name'] = $main_info[0]['property_search_name'];
            $count_data['apt_id'] = $apt_id;

            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/upload_right_banner', $data);
            $this->load->view('admin/edit/footer.php');
        }
        else
        {   
            $data = array('upload_data' => $this->upload->data());

            $file_name = $data['upload_data']['file_name'];
            $data_b['right_takeover_name'] = $file_name;

            $this->db->where('apt_id', $apt_id);
            $this->db->where('item', 'site_takeover');
            $this->db->update('upcoming_sales', $data_b);

            $this->db->where('apt_id', $apt_id);
            $this->db->update('sales', $data_b);
         
            redirect(base_url().'admin/edit_advertising/'.$apt_id);
        }
    }


public function do_upload_top_banner($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $config['upload_path'] = './images/takeover/top/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '1000';
    $config['max_width']  = '890';
    $config['max_height']  = '90';
    $config['min_width'] = '860';
    $config['min_height'] = '70';
    $this->load->library('upload', $config);

    $this->load->model('admin_model');
    $banner_names = $this->admin_model->get_banner_names($apt_id);

    $this->load->helper('file');

    $file = "./images/takeover/top/".$banner_names['top_takeover_name'];
    if($banner_names['top_takeover_name'] != ''){
            unlink($file); 
        }

    if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->model('edit_model');
            $main_info = $this->edit_model->get_main_info($apt_id);

            $count_data['views_all'] = $main_info[0]['views_all'];
            $count_data['views_year'] = $main_info[0]['views_year'];
            $count_data['views_month'] = $main_info[0]['views_month'];
            $count_data['views_day'] = $main_info[0]['views_day'];
            $count_data['views_last_month'] = $main_info[0]['views_last_month'];
            $count_data['views_last_day'] = $main_info[0]['views_last_day'];
            $count_data['apt_name'] = $main_info[0]['property_search_name'];
            $count_data['apt_id'] = $apt_id;

            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/upload_top_banner', $data);
            $this->load->view('admin/edit/footer.php');
        }
        else
        {   
            $data = array('upload_data' => $this->upload->data());

            $file_name = $data['upload_data']['file_name'];
            $data_b['top_takeover_name'] = $file_name;

            $this->db->where('apt_id', $apt_id);
            $this->db->where('item', 'site_takeover');
            $this->db->update('upcoming_sales', $data_b);

            $this->db->where('apt_id', $apt_id);
            $this->db->update('sales', $data_b);
         
            redirect(base_url().'admin/edit_advertising/'.$apt_id);
        }
    }

public function do_upload_mobile_banner($apt_id){

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];
    $count_data['apt_name'] = $main_info[0]['property_search_name'];
    $count_data['apt_id'] = $apt_id;

    $config['upload_path'] = './images/takeover/mobile/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '1000';
    $config['max_width']  = '410';
    $config['max_height']  = '185';
    $config['min_width'] = '390';
    $config['min_height'] = '165';
    $this->load->library('upload', $config);

    $this->load->model('admin_model');
    $banner_names = $this->admin_model->get_banner_names($apt_id);

    $this->load->helper('file');

    $file = "./images/takeover/mobile/".$banner_names['mobile_takeover_name'];
    if($banner_names['mobile_takeover_name'] != ''){
            unlink($file); 
        }

    if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->model('edit_model');
            $main_info = $this->edit_model->get_main_info($apt_id);

            $count_data['views_all'] = $main_info[0]['views_all'];
            $count_data['views_year'] = $main_info[0]['views_year'];
            $count_data['views_month'] = $main_info[0]['views_month'];
            $count_data['views_day'] = $main_info[0]['views_day'];
            $count_data['views_last_month'] = $main_info[0]['views_last_month'];
            $count_data['views_last_day'] = $main_info[0]['views_last_day'];
            $count_data['apt_name'] = $main_info[0]['property_search_name'];
            $count_data['apt_id'] = $apt_id;

            $this->load->view('admin/edit/header.php', $count_data);
            $this->load->view('admin/edit/upload_mobile_banner', $data);
            $this->load->view('admin/edit/footer.php');
        }
        else
        {   
            $data = array('upload_data' => $this->upload->data());

            $file_name = $data['upload_data']['file_name'];
            $data_b['mobile_takeover_name'] = $file_name;

            $this->db->where('apt_id', $apt_id);
            $this->db->where('item', 'site_takeover');
            $this->db->update('upcoming_sales', $data_b);

            $this->db->where('apt_id', $apt_id);
            $this->db->update('sales', $data_b);
         
            redirect(base_url().'admin/edit_advertising/'.$apt_id);
        }
    }


// SEE ALL ADS *******************************************************************************


    public function see_all_ads($order = ''){
        $this->load->model('admin_model');

        switch($order){
            case date_asc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_date_asc();
            break;

            case date_end_desc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_date_end_desc();
            break;

            case date_end_asc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_date_end_asc();
            break;

            case adv_desc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_adv_desc();
            break;

            case adv_asc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_adv_asc();
            break;

            case type_desc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_type_desc();
            break;

            case type_asc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_type_asc();
            break;

            case cost_desc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_cost_desc();
            break;

            case cost_asc:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_cost_asc();
            break;

            default:
                $data['all_ads'] = $this->admin_model->get_all_ads_by_date();
            break;
        }

        $data['all_ads'] = $data['all_ads']->result_array();

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $data['order'] = $order;

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/see_all_ads', $data);
        $this->load->view('admin/master_footer.php');
    }


// INVOICE *******************************************************************************

    public function main_invoice(){
        $this->load->model('admin_model');
        $all_apts['result'] = $this->admin_model->get_all_current_apts();
        $all_apts['suspended'] = $this->admin_model->get_all_suspended_apts();

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/invoice/main_invoice.php', $all_apts);
        $this->load->view('admin/master_footer.php');
    }

    public function make_invoices(){
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $this->load->model('admin_model');
        $all_ad_items = $this->admin_model->get_ads_for_date_range($start_date, $end_date);

        $all_items_clean = array();
        $all_ids = array();

        if($all_ad_items != 'N'){
            foreach ($all_ad_items as $key => $value) {

                $this_item = array(
                    'ID' => $value[0]['ID'],
                    'apt_id' => $value[0]['apt_id'],
                    'apt_name' => $value[0]['apt_name'],
                    'item' => $value[0]['item'],
                    'start_date' => $value[0]['start_date'],
                    'end_date' => $value[0]['end_date'],
                    'percent_deduction' => $value[0]['percent_deduction'],
                    'amount_deduction' => $value[0]['amount_deduction'],
                    'total_deduction' => $value[0]['total_deduction'],
                    'base_cost' => $value[0]['base_cost'],
                    'cost' => $value[0]['cost']
                    );
                $all_ids[] = $value[0]['apt_id'];

                array_push($all_items_clean, $this_item);
            }

            $unique_ids = array_unique($all_ids);

            $this->admin_model->make_these_invoices($unique_ids);

            foreach($all_items_clean as $key_b => $value_b){
                $x = 1;
                date_default_timezone_set("America/Chicago");
                $today = date('Y-m-d');
                $inv_sets_today = $this->admin_model->invoice_sets_created_today();
                $this->db->where('inv_creation_date', $today);
                $this->db->where('inv_sets_today', $inv_sets_today);
                $this->db->where('apt_id', $value_b['apt_id']);
                $invoice_info = $this->db->get('invoice')->result_array();

                if($invoice_info[0]['item_1'] != ''){
                    $x=2;
                }

                if($invoice_info[0]['item_2'] != ''){
                    $x=3;
                }

                if($invoice_info[0]['item_3'] != ''){
                    $x=4;
                }

                if($invoice_info[0]['item_4'] != ''){
                    $x=5;
                }

                if($invoice_info[0]['item_5'] != ''){
                    $x=6;
                }

                if($invoice_info[0]['item_6'] != ''){
                    $x=7;
                }

                if($invoice_info[0]['item_7'] != ''){
                    $x8;
                }

                if($invoice_info[0]['item_8'] != ''){
                    $x=9;
                }

                if($invoice_info[0]['item_9'] != ''){
                    $x=10;
                }

                if($invoice_info[0]['item_10'] != ''){
                    $x=11;
                }

                if($invoice_info[0]['item_11'] != ''){
                    $x=12;
                }

                if($invoice_info[0]['item_12'] != ''){
                    $x=13;
                }

                $data['apt_id'] = $value_b['apt_id'];
                $data['item_'.$x] = $value_b['item'];
                $data['start_date_'.$x] = $value_b['start_date'];
                $data['end_date_'.$x] = $value_b['end_date'];
                $data['deduction_'.$x] = $value_b['total_deduction'];
                $data['base_cost_'.$x] = $value_b['base_cost'];
                $data['cost_'.$x] = $value_b['cost'];

                $this->db->where('inv_creation_date', $today);
                $this->db->where('inv_sets_today', $inv_sets_today);
                $this->db->where('apt_id', $data['apt_id']);
                $this->db->update('invoice', $data);
                $data = array();
            }

            date_default_timezone_set("America/Chicago");
            $today = date('Y-m-d');
            $inv_sets_today = $this->admin_model->invoice_sets_created_today();
            $this->db->where('inv_creation_date', $today);
            $this->db->where('inv_sets_today', $inv_sets_today);
            $these_invoices = $this->db->get('invoice')->result_array();
            foreach ($these_invoices as $key => $value) {
                $inv_bal = 0;
                for ($i=1; $i <= 13; $i++) { 
                    $inv_bal = $inv_bal + $value['cost_'.$i];
                }

                $this->db->where('ID', $value['apt_id']);
                $this->db->limit(1);
                $apt_info = $this->db->get('apartment_main')->result_array();

                $apt_main_balance = $apt_info[0]['balance'];

                $new_main_balance = $apt_main_balance - $inv_bal;

                if($new_main_balance >= 0){
                    $data['inv_notes'] = "Thank you for your choice to trust us with your advertising budget.<br>Please contact us with any comments or concerns.<br>This invoice is marked as PAID because of a previous customer payment.";
                    $data['inv_status'] = "PAID";
                    $data['payment_1'] = $inv_bal;
                    $data['payment_1_date'] = $today;
                    $data['payment_1_type'] = 'EXISTING CUSTOMER CREDIT';
                    $data['invoice_balance'] = 0;

                    $this->db->where('id', $value['id']);
                    $this->db->update('invoice', $data);

                    $data_b['balance'] = $new_main_balance;

                    $this->db->where('ID', $value['apt_id']);
                    $this->db->update('apartment_main', $data_b);
                }elseif($apt_main_balance > 0 && $inv_bal > $apt_main_balance){

                    $data_c['invoice_balance'] = $inv_bal - $apt_main_balance;
                    $data_c['inv_notes'] = "Thank you for your choice to trust us with your advertising budget.<br>Please contact us with any comments or concerns.<br>This invoice was partialy paid by of a previous customer balance of $".$apt_main_balance.". <br>Creating a currently due amount of $".$data_c['invoice_balance'];
                    $data_c['payment_1'] = $apt_main_balance;
                    $data_c['payment_1_date'] = $today;
                    $data_c['payment_1_type'] = 'EXISTING CUSTOMER CREDIT';

                    $this->db->where('id', $value['id']);
                    $this->db->update('invoice', $data_c);

                    $data_d['balance'] = $new_main_balance;

                    $this->db->where('ID', $value['apt_id']);
                    $this->db->update('apartment_main', $data_d);   
                }else{
                    $data_e['invoice_balance'] = $inv_bal;
                    $this->db->where('id', $value['id']);
                    $this->db->update('invoice', $data_e); 

                    $data_f['balance'] = $new_main_balance;

                    $this->db->where('ID', $value['apt_id']);
                    $this->db->update('apartment_main', $data_f);                  
                }
            } //end of foreach $these_invoices
            $this->admin_model->make_past_dues($today);

            redirect(base_url()."admin/show_current_inv_set/".$today."/".$inv_sets_today);
            
        }else{
            $dates['start_date'] = $start_date;
            $dates['end_date'] = $end_date;
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/no_ads.php', $dates);
            $this->load->view('admin/master_footer.php');
        }
    }

    public function enter_master_payment(){
        $data['apt_id'] = $_POST['apt_id'];
        $data['payment_date'] = $_POST['master_payment_date'];
        $data['payment_type'] = $_POST['master_payment_type'];
        $data['amount'] = $_POST['amount'];
        $data['check_number'] = $_POST['check_number'];
        $data['notes'] = $_POST['notes'];

        $this->load->model('admin_model');
        $main_data = $this->admin_model->get_this_adv_info($data['apt_id']);

        $data['property_name'] = $main_data[0]['property_name'];

        $this->db->insert('master_payments', $data);

        $data_b['balance'] = $main_data[0]['balance'] + $data['amount'];

        $this->db->where('ID', $data['apt_id']);
        $this->db->update('apartment_main', $data_b);

        redirect(base_url().'admin/adv_master_balance/'.$data['apt_id']);
    }

    public function adv_master_balance($apt_id){

        $this->load->model('admin_model');
        $data['main_data'] = $this->admin_model->get_this_adv_info($apt_id);
        $data['master_payments'] = $this->admin_model->get_master_payments($apt_id);

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/invoice/master_payments.php', $data);
        $this->load->view('admin/master_footer.php');
    }

    public function this_inv_edit($inv_num,$creation_date = 0,$sets = 0,$param_4 = 0){

        $this->load->model('admin_model');
        $data['this_inv'] = $this->admin_model->get_this_inv($inv_num);
        $data['page_note'] = $page_note;
        $data['creation_date'] = $creation_date;
        $data['sets'] = $sets;
        if($param_4 != 0){
            $data['param_4'] = $param_4;
        }

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/invoice/edit_this_inv.php', $data);
        $this->load->view('admin/master_footer.php');
    }

    public function show_current_inv_set($date, $inv_set){
        $this->load->model('admin_model');
        $invoices['current'] = $this->admin_model->get_inv_for_date_and_set($date, $inv_set);
        $invoices['past_due'] = $this->admin_model->get_past_due_invoices();

        if($invoices['current'] == 'N'){
            echo "There was a problem finding your invoices";
        }else{
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/these_invoices.php', $invoices);
            $this->load->view('admin/master_footer.php');
        }
    }

    public function submit_this_invoice($inv_num, $creation_date = 0, $sets = 0, $param_4 = 0){
        $data_b = $_POST;

        $this->db->where('id', $data_b['id']);
        $this->db->update('invoice', $data_b);

        if($creation_date == 'past_due'){
            redirect(base_url()."admin/see_past_due_inv");
        }elseif($creation_date == 'this_adv'){
            redirect(base_url()."admin/inv_by_advertiser/".$sets);
        }elseif($creation_date == 'these_dates'){
            redirect(base_url()."admin/inv_by_date/".$sets."/".$param_4);
        }elseif($_POST['inv_status'] == 'PAST DUE'){
            redirect(base_url()."admin/show_current_inv_set/".$creation_date.'/'.$sets);
        }else{
            redirect(base_url()."admin/show_current_inv_set/".$_POST['inv_creation_date'].'/'.$_POST['inv_sets_today']);
        }
    }

    public function delete_this_invoice($inv_number,$creation_date,$sets,$param_4 = 0){
        $this->db->where('inv_number', $inv_number);
        $this->db->delete('invoice');

        if($creation_date == 'past_due'){
            redirect(base_url()."admin/see_past_due_inv");
        }elseif($creation_date == 'this_adv'){
            redirect(base_url()."admin/inv_by_advertiser/".$sets);
        }elseif($creation_date == 'these_dates'){
            redirect(base_url()."admin/inv_by_date/".$sets."/".$param_4);
        }else{
            redirect(base_url()."admin/show_current_inv_set/".$creation_date.'/'.$sets);
        }
    }

    public function send_current_set_and_past_due($creation_date, $set){
        $this->load->model('admin_model');
        $current_sent = $this->admin_model->send_current_set($creation_date, $set);
        $past_due_sent = $this->admin_model->send_past_due();

        redirect(base_url()."admin/main_invoice");
    }

    public function send_current_set($creation_date, $set){
        $this->load->model('admin_model');
        $current_sent = $this->admin_model->send_current_set($creation_date, $set);

        redirect(base_url()."admin/main_invoice");
    }

    public function send_past_due(){
        $this->load->model('admin_model');
        $past_due_sent = $this->admin_model->send_past_due();

        redirect(base_url()."admin/main_invoice");
    }

    public function enter_payments(){
        $this->load->model('admin_model');
        $data['invoices'] = $this->admin_model->get_due_and_past_due_inv();

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/invoice/enter_payments.php', $data);
        $this->load->view('admin/master_footer.php');
    }

    public function submit_these_payments(){
        $data = $_POST;
        $entered_items = array();
        foreach($data as $key => $value){
            for ($i=0; $i < 50; $i++) { 
                if($key == 'payment_amount_'.$i){
                    if($value > 0){
                       array_push($entered_items, $i); 
                    }
                }
            }
        }

        foreach($entered_items as $key => $value){
            foreach($data as $key_b => $value_b){
                if($key_b == 'inv_number_'.$value){
                    $data_b['invoice_number'] = $value_b;
                }
                if($key_b == 'pay_date_entered_'.$value){
                    $data_b['payment_date'] = $value_b;
                }
                if($key_b == 'payment_'.$value.'_type_payment'){
                    $data_b['payment_type'] = $value_b;
                }
                if($key_b == 'payment_check_num_'.$value){
                    $data_b['payment_check_num'] = $value_b;
                }
                if($key_b == 'payment_amount_'.$value){
                    $data_b['payment_amount'] = $value_b;
                }
            }

            $this->db->where('inv_number', $data_b['invoice_number']);
            $invoice_info = $this->db->get('invoice')->result_array();
            $x = 1;
            if($invoice_info[0]['payment_1_type'] != ''){$x=2;}
            if($invoice_info[0]['payment_2_type'] != ''){$x=3;}
            if($invoice_info[0]['payment_3_type'] != ''){$x=4;}
            if($invoice_info[0]['payment_4_type'] != ''){$x=5;}
            if($invoice_info[0]['payment_5_type'] != ''){$x=6;}
            if($invoice_info[0]['payment_6_type'] != ''){$x=7;}
            if($invoice_info[0]['payment_7_type'] != ''){$x8;}
            if($invoice_info[0]['payment_8_type'] != ''){$x=9;}
            if($invoice_info[0]['payment_9_type'] != ''){$x=10;}
            if($invoice_info[0]['payment_10_type'] != ''){$x=11;}
            if($invoice_info[0]['payment_11_type'] != ''){$x=12;}
            if($invoice_info[0]['payment_12_type'] != ''){$x=13;}

            $data_c['invoice_balance'] = $invoice_info[0]['invoice_balance'] - $data_b['payment_amount'];
            $old_inv_status = $invoice_info[0]['inv_status'];
            if($data_c['invoice_balance'] <= 1){
                $data_c['inv_status'] = 'PAID';
            }else{
                $data_c['inv_status'] = $old_inv_status;
            }
            $data_c['payment_'.$x] = $data_b['payment_amount'];
            $data_c['payment_'.$x.'_date'] = $data_b['payment_date'];
            $data_c['payment_'.$x.'_type'] = $data_b['payment_type'];
            $data_c['payment_'.$x.'_check_num'] = $data_b['payment_check_num'];
            $inv_num = $data_b['invoice_number'];

            $this->db->where('inv_number', $inv_num);
            $this->db->update('invoice', $data_c);

            $this->db->where('ID', $invoice_info[0]['apt_id']);
            $apt_main_info = $this->db->get('apartment_main')->result_array();

            $data_d['balance'] = $apt_main_info[0]['balance'] + $data_b['payment_amount'];
            $this->db->where('ID', $invoice_info[0]['apt_id']);
            $this->db->update('apartment_main', $data_d);
        }

        redirect(base_url()."admin/main_invoice");
    }

    public function inv_by_advertiser($this_apt_id = 0){
        if($this_apt_id == 0){
            $apt_id = $_POST['apt_id'];
        }else{
            $apt_id = $this_apt_id;
        }
        
        $this->load->model('admin_model');
        $invoices['advertiser_inv'] = $this->admin_model->get_adv_inv($apt_id);

        if($invoices['advertiser_inv'] == 'N'){
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/no_inv.php');
            $this->load->view('admin/master_footer.php');
        }else{
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/these_adv_inv.php', $invoices);
            $this->load->view('admin/master_footer.php');
        }
    }

    public function pay_by_advertiser($this_apt_id = 0){
        if($this_apt_id == 0){
            $apt_id = $_POST['apt_id'];
        }else{
            $apt_id = $this_apt_id;
        }
        
        $this->load->model('admin_model');
        $invoices['advertiser_inv'] = $this->admin_model->get_adv_inv($apt_id);

        if($invoices['advertiser_inv'] == 'N'){
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/no_pay.php');
            $this->load->view('admin/master_footer.php');
        }else{
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/these_adv_pay.php', $invoices);
            $this->load->view('admin/master_footer.php');
        }
    }

    public function delete_this_payment($inv_num, $pay_num, $apt_id){
        $this->db->where('inv_number', $inv_num);
        $inv_info = $this->db->get('invoice')->result_array();

        $data['invoice_balance'] = $inv_info[0]['invoice_balance'] + $inv_info[0]['payment_'.$pay_num];

        $this->db->where('ID', $apt_id);
        $apt_info = $this->db->get('apartment_main')->result_array();
        $data_b['balance'] = $apt_info[0]['balance'] - $inv_info[0]['payment_'.$pay_num];

        $this->db->where('ID', $apt_id);
        $this->db->update('apartment_main', $data_b);

        $data['payment_'.$pay_num] = '';
        $data['payment_'.$pay_num.'_date'] = '';
        $data['payment_'.$pay_num.'_type'] = '';
        $data['payment_'.$pay_num.'_check_num'] = '';
        // print_r($data);
        $this->db->where('inv_number', $inv_num);
        $this->db->update('invoice', $data);

        redirect(base_url().'admin/pay_by_advertiser/'.$apt_id);
    }

    public function inv_by_date($start_date = 0, $end_date = 0){
        if($start_date == 0){
            $see_inv_start_date = $_POST['see_inv_start_date'];
        }else{
            $see_inv_start_date = $start_date;
        }
        if($end_date == 0){
            $see_inv_end_date = $_POST['see_inv_end_date'];
        }else{
            $see_inv_end_date = $end_date;
        }

        // echo $see_inv_start_date." ; ";
        // echo $see_inv_end_date;

        $this->load->model('admin_model');
        $invoices['dates_inv'] = $this->admin_model->get_dates_inv($see_inv_start_date, $see_inv_end_date);
        $invoices['see_inv_start_date'] = $see_inv_start_date;
        $invoices['see_inv_end_date'] = $see_inv_end_date;

        // print_r($invoices['dates_inv']);

        if($invoices['dates_inv'] == 'N'){
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/no_inv.php');
            $this->load->view('admin/master_footer.php');
        }else{
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/these_dates_inv.php', $invoices);
            $this->load->view('admin/master_footer.php');
        }
    }

    public function see_past_due_inv(){
        date_default_timezone_set("America/Chicago");
        $today = date('Y-m-d');
        $this->load->model('admin_model');
        $this->admin_model->make_past_dues($today);
        $invoices['past_due'] = $this->admin_model->get_past_due_invoices();
        // print_r($invoices['past_due']);

        if($invoices['past_due'] == 'N'){
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/no_inv.php');
            $this->load->view('admin/master_footer.php');
        }else{
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/these_past_due_inv.php', $invoices);
            $this->load->view('admin/master_footer.php');
        }
    }

    public function send_this_invoice($inv_number, $redirect_type = 0, $param_1 = 0, $param_2 = 0){
        $this->load->model('admin_model');
        $this->admin_model->send_one_invoice($inv_number);
        
        if($redirect_type == 'this_adv'){
            redirect(base_url()."admin/inv_by_advertiser/".$param_1);
        }elseif($redirect_type == 'these_dates'){
            redirect(base_url()."admin/inv_by_date/".$param_1."/".$param_2);
        }elseif($redirect_type == 'past_due'){
            redirect(base_url()."admin/see_past_due_inv");
        }else{
            redirect(base_url."admin/main_invoice");
        }
    }


    public function enter_item(){
        $this->load->model('admin_model');
        $all_apts['result'] = $this->admin_model->get_all_current_apts();
        $all_apts['suspended'] = $this->admin_model->get_all_suspended_apts();

        $this->load->view('admin/master_header.php');
        $this->load->view('admin/invoice/enter_item.php', $all_apts);
        $this->load->view('admin/master_footer.php');
    }

    public function enter_this_item(){
        $data = $_POST;

        $data['end_date'] = $data['start_date'];

        $this->load->model('admin_model');
        $advertiser_info = $this->admin_model->get_this_adv_info($data['apt_id']);
        $data['apt_name'] = $advertiser_info[0]['property_search_name'];

        $this->db->insert('upcoming_sales', $data);

        redirect(base_url().'admin/see_adv_custom_items/'.$data['apt_id']);
    }

    public function see_adv_custom_items($apt_id){
        $this->db->where('apt_id', $apt_id);
        $this->db->where('custom_item', 'Y');
        $data['custom_items'] = $this->db->get('upcoming_sales')->result_array();

        if(count($data['custom_items']) < 1){
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/no_items.php');
            $this->load->view('admin/master_footer.php');
        }else{
            $this->load->view('admin/master_header.php');
            $this->load->view('admin/invoice/these_adv_items.php', $data);
            $this->load->view('admin/master_footer.php');
        }
    }

    public function custom_item_delete($item_id, $apt_id){
        $this->db->where('ID', $item_id);
        $this->db->delete('upcoming_sales');
        redirect(base_url()."admin/see_adv_custom_items/".$apt_id);
    }

    public function see_these_cust_items(){
        $apt_id = $_POST['apt_id'];
        redirect(base_url().'admin/see_adv_custom_items/'.$apt_id);
    }






}
?>
