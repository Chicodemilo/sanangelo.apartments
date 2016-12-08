<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
	<title>SANANGELO.APARTMENTS SUPER MAP</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="The SANANGELO.APARTMENTS Super Map is an indespensable tool for searching for your new apartment home. Use the search box to define your price or amenities and watch the results on the map.">
    <meta name="keywords" content="Apartment, Map, San Angelo, Texas">
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

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-86483238-1', 'auto');
      ga('send', 'pageview');

    </script>
    <style>


        .panel_container {
            font-size: 12px;
            position: relative;
            overflow-x: hidden;
            width: 100%;
            height: calc(100vh - 170px);
            box-sizing: border-box;
            background: #F0F0F0;
            box-shadow: 3px 3px 20px rgba(0, 0, 0, .5);
        }

        section {
            height: 70px;
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