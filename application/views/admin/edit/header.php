<!DOCTYPE html>
<html lang="en" >
<head>
    <title>
      <?php echo $this->session->userdata('apt_name'); ?>
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    
    
    <script src="<?php echo base_url(); ?>js/jquery-3.1.0.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>js/edit_javascript.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/spectrum.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/edit_main.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pikaday.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/spectrum.css">
    <script src="<?php echo base_url() ?>js/moment.js"></script>
    <script src="<?php echo base_url() ?>js/pikaday.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">
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
        <div id="site_counts">
            YOUR PAGE VIEWS:<br>
            <table class="count_table">
                <tr>
                    <td class="righter">Today: </td>
                    <td><?php echo $views_day; ?></td>
                    <td class="righter">This Month: </td>
                    <td><?php echo $views_month; ?></td>
                    <td class="righter">Year-To-Date: </td>
                    <td><?php echo $views_year; ?></td>
                </tr>
                <tr>
                    <td class="righter">Yesterday: </td>
                    <td><?php echo $views_last_day; ?></td>
                    <td class="righter">Last Month: </td>
                    <td><?php echo $views_last_month; ?></td>
                    <td class="righter">All Time: </td>
                    <td><?php echo $views_all; ?></td>
                </tr>
            </table>
            
        </div>
        <table class="header_links">
            <tr>
                <td>
                    <ul class='main_links' id="main_links">
                        
                        <li class="contact_drop" id="contact_drop"><a href="#" class="">EDIT APARTMENT INFO</a>
                            <ul class="contact_menu" id="contact_menu">
                                <li><a href="<?php echo base_url() ?>admin/" class="">MAIN ADMIN</a></li>
                                <li><a href="<?php echo base_url() ?>admin/all_apts" class="">ALL APTS</a></li>
                                <li><a href="<?php echo base_url() ?>admin/edit_this_apt/<?php echo $apt_id;?>" class="">MAIN EDIT</a></li>
                                <li><a href="<?php echo base_url() ?>admin/amenities/<?php echo $apt_id;?>" class="">AMENITIES</a></li>
                                <li><a href="<?php echo base_url() ?>admin/hours/<?php echo $apt_id;?>/<?php echo $apt_name; ?>" class="">HOURS</a></li>
                                <li><a href="<?php echo base_url() ?>admin/floorplans/<?php echo $apt_id;?>" class="">FLOORPLANS</a></li>
                                <li><a href="<?php echo base_url() ?>admin/pets/<?php echo $apt_id;?>" class="">PETS</a></li>
                                <li><a href="<?php echo base_url() ?>admin/pictures/<?php echo $apt_id;?>" class="">PICTURES</a></li>
                                <li><a href="<?php echo base_url() ?>admin/specials/<?php echo $apt_id;?>" class="">SPECIALS</a></li>
                                <li><a href="<?php echo base_url() ?>admin/users/<?php echo $apt_id;?>" class="">USER</a></li>
                                <li><a href="<?php echo base_url() ?>admin/messages/<?php echo $apt_id;?>" class="small_links">MESSAGES</a></li>
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
    
