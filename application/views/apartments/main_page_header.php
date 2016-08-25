<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<title>SANANGELO.APARTMENTS</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    
    
    <script src="<?php echo base_url(); ?>js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js "></script>
    <script src="<?php echo base_url(); ?>js/panelSnap.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/main_page_javascript.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/apt_main_page.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pikaday.css">

    <link href="https://fonts.googleapis.com/css?family=Lobster|Oswald" rel="stylesheet">

    <script src="<?php echo base_url() ?>js/moment.js"></script>
    <script src="<?php echo base_url() ?>js/pikaday.js"></script>


    <style>


        .panel_container {
            font-size: 12px;
            position: relative;
            overflow-x: hidden;
            width: 100%;
            height: 450px;
            box-sizing: border-box;
            background: #F0F0F0;
        }

        section {
            height: 90px;
        }

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