<!DOCTYPE html>
<html lang="en" >
<head>
    <title>
      MASTER EDIT
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <script src="<?php echo base_url(); ?>js/jquery-3.1.0.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>js/edit_javascript.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/spectrum.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/edit_main.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pikaday.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/spectrum.css">
    <script src="<?php echo base_url() ?>js/moment.js"></script>
    <script src="<?php echo base_url() ?>js/pikaday.js"></script>
    <script>
        // google analytics
    </script>


</head>
<body>
    <script type="text/javascript">

    </script>

    

    <header>
    <div id="nav_bar">


    </div>
    <div id="nav_bar_clear">
        <table class='user_info'>
    
            <tr><td >Hello, <?php 
                $name = $this->session->userdata('username');
                echo $name;
                ?>
            </td></tr>
            <tr><td><a href='<?php echo base_url(); ?>login/logout' class='not_fancy'>LOGOUT</a></td></tr>
        </table>
        <table class="header_links">
            <tr>
                <td>
                    <ul class='main_links' id="main_links">
                        
                        <li class="contact_drop" id="contact_drop"><a href="#" class="">ADMIN LINKS</a>
                            <ul class="contact_menu" id="contact_menu">
                                <li><a href="<?php echo base_url() ?>admin" class="">MAIN ADMIN LINKS</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/new_apt" >MAKE NEW APT</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/all_apts" >SEE ALL APTS</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/these_users" >SEE ALL USERS</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/send_email_all">MESSAGE TO ALL APTS</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/see_all_ads">SEE ALL ADS</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/main_invoice">INVOICING</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/edit_cost">EDIT AD RATES</a></li>
                                <!-- <li><a href="<?php echo base_url() ?>edit/pictures" class="">PICTURES</a></li> -->
                                <!-- <li><a href="<?php echo base_url() ?>edit/specials" class="">SPECIALS</a></li> -->
                                <!-- <li><a href="<?php echo base_url() ?>edit/users" class="">USER</a></li> -->
                                <!-- <li><a href="<?php echo base_url() ?>edit/messages" class="small_links">MESSAGES</a></li> -->
                                <!-- <li><a href="<?php echo base_url() ?>contact/pre_applications" class="small_links">Pre-Applications</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>

        </table>
     
    </div>
       
    </header>
    <div id="wrapper" class="wrapper">
