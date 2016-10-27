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

// // HOURS *********************************************************************************

    public function hours(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        
        $this->load->model('edit_model', 'hours');
        $office_hours = $this->hours->get_hours($apt_id)->result_array();

        $data['office_hours'] = $office_hours;

        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/hours.php', $data);
        $this->load->view('edit/footer.php');
    }

    public function submit_hours(){
        $data['apt_id'] = $this->session->userdata('apt_id');
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
        redirect(base_url().'edit/hours');
    }


    public function delete_hours($id){
        $apt_id = $this->session->userdata('apt_id');
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('office_hours');
        redirect(base_url().'edit/hours');
    }


// // FLOORPLANS *********************************************************************************

    public function floorplans(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $this->load->model('edit_model', 'floorplans');
        $floorplans = $this->floorplans->get_floorplans($apt_id)->result_array();

        $data['floorplans'] = $floorplans;

        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/floorplans.php', $data);
        $this->load->view('edit/footer.php');

    }

    public function submit_floorplans(){
        $data = $_POST;
        $data['apt_id'] = $this->session->userdata('apt_id');
        $this->db->insert('floorplans', $data);
        redirect(base_url().'edit/floorplans');
    }

    public function delete_floorplan($id){
        $apt_id = $this->session->userdata('apt_id');
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

        redirect(base_url().'edit/floorplans');
    }

    public function edit_floorplan($id = 0){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        
        if($id == 0){
            $this->load->view('edit/header.php', $count_data);
            $this->load->view('edit/no_resource.php');
            $this->load->view('edit/footer.php');
        }else{
            $apt_id = $this->session->userdata('apt_id');
            $this->load->model('edit_model','edit_model');
            $data['floorplan_info'] = $this->edit_model->get_flooplan_info($apt_id, $id)->result_array();
            $data['error'] = '';
            $this->load->view('edit/header.php', $count_data);
            $this->load->view('edit/do_edit_this_floorplan', $data);
            $this->load->view('edit/footer.php');
        }
    }

    public function submit_floorplan_edits($id){
        $data = $_POST;
        $data['apt_id'] = $this->session->userdata('apt_id');
        $apt_id = $this->session->userdata('apt_id');
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->update('floorplans', $data);
        redirect(base_url().'edit/floorplans');
    }


    public function upload_this($id){
        $data = array('id' => $id, 'error' => '');
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/upload_this', $data);
        $this->load->view('edit/footer.php');

    }

    function do_upload_floorplan($id)
    {   
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

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

            $this->load->view('edit/header.php', $count_data);
            $this->load->view('edit/upload_this', $data);
            $this->load->view('edit/footer.php');
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
            redirect('edit/floorplans/');
        }
    }

    function delete_this_diagram($id = 0){
        $apt_id = $this->session->userdata('apt_id');
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
        redirect('edit/edit_floorplan/'.$id);

    }

// // PETS *********************************************************************************

    public function pets(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $this->load->model('edit_model', 'pets');
        $pets = $this->pets->get_pets($apt_id)->result_array();

        $data['pets'] = $pets;

        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/pets.php', $data);
        $this->load->view('edit/footer.php');
    }

    public function submit_pets(){
        $data = $_POST;
        $data['apt_id'] = $this->session->userdata('apt_id');
        $this->db->where('apt_id', $data['apt_id']);
        $this->db->delete('pet_policy');
        
        $this->db->insert('pet_policy', $data);
        redirect(base_url().'edit/pets');
    }


    public function delete_pets($id){
        $apt_id = $this->session->userdata('apt_id');
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('pet_policy');
        redirect(base_url().'edit/pets');

    }



// // SPECIALS *********************************************************************************

    public function specials(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $this->load->model('edit_model', 'specials');
        $specials = $this->specials->get_specials($apt_id)->result_array();

        $data['specials'] = $specials;

        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/specials.php', $data);
        $this->load->view('edit/footer.php');
    }

    public function submit_specials(){
        $data = $_POST;
        $data['apt_id'] = $this->session->userdata('apt_id');
        
        $this->db->where('apt_id', $data['apt_id']);
        $this->db->delete('special');

        $this->db->insert('special', $data);
        redirect(base_url().'edit/specials');
    }

    public function delete_special($id){
        $apt_id = $this->session->userdata('apt_id');
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('special');
        redirect(base_url().'edit/specials');

    }




// // USERS *********************************************************************************

    public function users(){
        $this->load->model('edit_model', 'users');
        $user_id = $this->session->userdata('user_id');
        $users = $this->users->get_user($user_id)->result_array();

        $data['users'] = $users;

        $recent_logins = $this->users->get_recent_logins($user_id)->result_array();
        $data['recent_logins'] = $recent_logins;

        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/users.php', $data);
        $this->load->view('edit/footer.php');
    }


    public function submit_users($id){
        $this->load->model('edit_model', 'user');
        $user = $this->user->get_user($id)->result_array();
        $data['user'] = $user;

        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        if(count($user) > 0){
            $this->load->view('edit/header.php', $count_data);
            $this->load->view('edit/edit_user.php', $data);
            $this->load->view('edit/footer.php');      
        }else{
            $this->load->view('edit/header.php', $count_data);
            $this->load->view('edit/no_resource.php');
            $this->load->view('edit/footer.php');
        }
    }


    // public function delete_user($id){
    //     $this->db->where('id', $id);
    //     $this->db->delete('membership');
    //     redirect(base_url().'edit/users');
    // }


    public function submit_user_edits($id){
        $data = $_POST;
        $data['username'] = $data['email'];
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        redirect(base_url().'edit/users', 'refresh');
    }


    public function change_password($id){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $data = array('id' => $id);
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/change_password.php', $data);
        $this->load->view('edit/footer.php');
    }


    public function submit_change_password($id){
        $password = $this->input->post('password');
        $password = hash('sha256', $password.SALT);
        $data['password'] = $password;
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        redirect(base_url().'edit/users');
    }

// // PICTURES *********************************************************************************

public function pictures(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $apt_id = $this->session->userdata('apt_id');
        $this->load->model('edit_model', 'pictures');
        $data['pictures']= $this->pictures->get_pictures($apt_id)->result_array();
        $data['logo']= $this->pictures->get_logo($apt_id)->result_array();
        $data['man_logo']= $this->pictures->get_man_logo($apt_id)->result_array();
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/pictures.php', $data);
        $this->load->view('edit/footer.php');
}


public function picture_delete($id){
    $this->load->helper('file');
    $apt_id = $this->session->userdata('apt_id');
    $this->db->where('apt_id', $apt_id);
    $this->db->where('id', $id);
    $this->db->delete('pictures');
    $this->load->model('edit_model', 'pictures');
    $this->pictures->reorder_pictures($apt_id);
    // delete_files('./images/pictures/'.$id.'/');
    $files = glob('./images/pictures/'.$apt_id.'/'.$id.'/*'); 
    foreach($files as $file){ 
      if(is_file($file))
        unlink($file); }

    if(is_dir('./images/pictures/'.$apt_id.'/'.$id)){
        rmdir('./images/pictures/'.$apt_id.'/'.$id);
    }
    redirect(base_url().'edit/pictures', 'refresh');
}


public function picture_upload(){
    $apt_id = $this->session->userdata('apt_id');

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];

    $this->load->model('edit_model');
    $count = count($this->edit_model->get_pictures($apt_id)->result_array());
    if($count < 10){
        $data = array('error' => '');
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/upload_picture', $data);
        $this->load->view('edit/footer.php');
    }else{
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/too_many_pics');
        $this->load->view('edit/footer.php');
    }
}


public function do_upload_picture(){
    $apt_id = $this->session->userdata('apt_id');

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];

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
        $config['min_height'] = '500';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $data['id'] = $id;
            $this->load->view('edit/header.php', $count_data);
            $this->load->view('edit/upload_picture', $data);
            $this->load->view('edit/footer.php');
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
            redirect(base_url().'edit/picture_edit/'.$id);
        }
}



public function picture_edit($id){
    $apt_id = $this->session->userdata('apt_id');

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];

    $this->load->model('edit_model', 'picture');
    $data['picture'] = $this->picture->get_picture_data($apt_id, $id);
    $data['count'] = count($this->picture->get_pictures($apt_id)->result_array());
    $this->load->view('edit/header.php', $count_data);
    $this->load->view('edit/edit_picture', $data);
    $this->load->view('edit/footer.php');
}



public function submit_picture_edits($id){
    $apt_id = $this->session->userdata('apt_id');
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

    redirect(base_url().'edit/pictures');

}


public function logo_upload(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $data = array('error' => '');
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/upload_logo', $data);
        $this->load->view('edit/footer.php');
}


public function do_upload_logo(){
    $apt_id = $this->session->userdata('apt_id');

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];

    $this->db->where('apt_id', $apt_id);
    $this->db->where('logo', 'Y');
    $this->db->delete('pictures');
    $this->load->helper('file');
    // delete_files('./images/logos/property/');

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
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/upload_logo', $data);
        $this->load->view('edit/footer.php');
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
        redirect(base_url().'edit/pictures/');
    }
}

public function logo_delete($id){
    $apt_id = $this->session->userdata('apt_id');
    $this->load->helper('file');
    $this->db->where('apt_id', $apt_id);
    $this->db->where('id', $id);
    $this->db->delete('pictures');
    $files = glob('./images/logos/property/'.$apt_id.'/*'); 
            foreach($files as $file){ 
              if(is_file($file))
                unlink($file); }
    redirect(base_url().'edit/pictures', 'refresh');
}

public function man_logo_upload(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $data = array('error' => '');
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/upload_man_logo', $data);
        $this->load->view('edit/footer.php');
}


public function do_upload_man_logo(){
    $apt_id = $this->session->userdata('apt_id');

    $this->load->model('edit_model');
    $main_info = $this->edit_model->get_main_info($apt_id);

    $count_data['views_all'] = $main_info[0]['views_all'];
    $count_data['views_year'] = $main_info[0]['views_year'];
    $count_data['views_month'] = $main_info[0]['views_month'];
    $count_data['views_day'] = $main_info[0]['views_day'];
    $count_data['views_last_month'] = $main_info[0]['views_last_month'];
    $count_data['views_last_day'] = $main_info[0]['views_last_day'];

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
            $this->load->view('edit/header.php', $count_data);
            $this->load->view('edit/upload_man_logo', $data);
            $this->load->view('edit/footer.php');
        }
        else
        {   
            $data = array('upload_data' => $this->upload->data());

            $file_name = $data['upload_data']['file_name'];
            $data_b['name'] = $file_name;
            $data_b['apt_id'] = $apt_id;

            // $this->db->where('apt_id', $apt_id);
            $this->db->insert('man_logo', $data_b);     
            redirect(base_url().'edit/pictures/');
        }
}


public function man_logo_delete(){
    $apt_id = $this->session->userdata('apt_id');
    $this->load->helper('file');
    $this->db->where('apt_id', $apt_id);
    $this->db->delete('man_logo');
    delete_files('./images/logos/management/'.$apt_id);
    redirect(base_url().'edit/pictures', 'refresh');
}

// MESSAGES *******************************************************************************

    public function messages(){
        $apt_id = $this->session->userdata('apt_id');

        $this->load->model('edit_model');
        $main_info = $this->edit_model->get_main_info($apt_id);

        $count_data['views_all'] = $main_info[0]['views_all'];
        $count_data['views_year'] = $main_info[0]['views_year'];
        $count_data['views_month'] = $main_info[0]['views_month'];
        $count_data['views_day'] = $main_info[0]['views_day'];
        $count_data['views_last_month'] = $main_info[0]['views_last_month'];
        $count_data['views_last_day'] = $main_info[0]['views_last_day'];

        $this->load->model('edit_model', 'messages');
        $messages = $this->messages->get_messages($apt_id)->result_array();
        $data['messages'] = $messages;
        $this->load->view('edit/header.php', $count_data);
        $this->load->view('edit/messages.php', $data);
        $this->load->view('edit/footer.php');
    }

    public function delete_message($id){
        $apt_id = $this->session->userdata('apt_id');
        $this->db->where('apt_id', $apt_id);
        $this->db->where('id', $id);
        $this->db->delete('contact');
        redirect(base_url().'edit/messages');
    }






























}
?>
