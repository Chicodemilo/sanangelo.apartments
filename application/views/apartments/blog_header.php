<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<title><?php echo $blog[0]['post_title']; ?>: San Angelo Apartment Blog</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="<?php echo $blog[0]['post_title']; ?>", news about San Angelo Texas Apartments>
    <meta name="keywords" content="<?php echo $blog[0]['post_title']; ?>">
    <meta name=viewport content="width=device-width, initial-scale=1">
    
    
    <script src="<?php echo base_url(); ?>js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js "></script>
    <script src="<?php echo base_url(); ?>js/panelSnap.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/main_page_javascript.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel='stylesheet' media='only screen and (min-width: 901px)' href='<?php echo base_url();?>css/apt_main_page.css' />
    <link rel='stylesheet' media='only screen and (max-width: 900px)' href='<?php echo base_url();?>css/apt_main_page_little.css' />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pikaday.css">

    <link href="https://fonts.googleapis.com/css?family=Lobster|Oswald" rel="stylesheet">


    <style>

    </style>

</head>
<body>
