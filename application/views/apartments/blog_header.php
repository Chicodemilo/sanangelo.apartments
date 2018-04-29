<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $blog[0]['post_title']; ?>: <?php echo WEBSITE; ?> Blog</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="<?php echo MARKET.' '.STATE; ?> Apartment news and info blog: <?php echo $blog[0]['post_title']; ?>">
    <meta name="keywords" content="<?php echo $blog[0]['post_title']; ?>">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <?php 
        $clean_title = str_replace(' ', '_', $blog[0]['post_title']);
        $clean_title = str_replace(',', '', $clean_title);
        $clean_title = preg_replace('/[\/|+ -]+/', '', $clean_title);
     ?>
    <link rel="canonical" href="https://<?php echo WEBSITELOWERWWW;?>/texas/this_blog/<?php echo $blog[0]['id'] ?>/<?php echo $clean_title; ?>">

    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js "></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/panelSnap.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/main_page_javascript.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel='stylesheet' media='only screen and (min-width: 901px)' href='<?php echo base_url();?>css/apt_main_page.css' />
    <link rel='stylesheet' media='only screen and (max-width: 900px)' href='<?php echo base_url();?>css/apt_main_page_little.css' />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pikaday.css">

    <link href="https://fonts.googleapis.com/css?family=Lobster|Oswald" rel="stylesheet">
    <meta name="google-site-verification" content="zklGPKpd_Dq2tiI4Z00lq_cVRp2pu1nNPwbFyVXbY48" />


    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-86483238-1', 'auto');
      ga('send', 'pageview');

    </script>

    <style>

    </style>

</head>
<body>
