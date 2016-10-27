<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<title>SANANGELO.APARTMENTS</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="Find An Apartment In San Angelo Texas">
    <meta name="keywords" content="Apartments, Rentals, San Angelo, Greater San Angelo Renter, Texas">
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

    <script src="<?php echo base_url() ?>js/moment.js"></script>
    <script src="<?php echo base_url() ?>js/pikaday.js"></script>


    <style>




    </style>


    <script>
        jQuery(function($) {
            var options = {
              $menu: false,
              menuSelector: 'a',
              panelSelector: '> section',
              namespace: '.panelSnap',
              onSnapStart: function(){},
              onSnapFinish: function(){},
              onActivate: function(){},
              directionThreshold: 1,
              slideSpeed: 100,
              easing: 'linear',
              offset: 0,
              navigation: {
                keys: {
                  nextKey: false,
                  prevKey: false,
                },
                buttons: {
                  $nextButton: false,
                  $prevButton: false,
                },
                wrapAround: true
              }
            };
            $('.panel_container').panelSnap(options);
        });
    </script>
</head>
<body>