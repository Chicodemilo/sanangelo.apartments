<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $property_name.' '.MARKET.' '.STATE.' : '.WEBSITE; ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="<?php echo $property_name.'- '.MARKET.', '.STATE.'- '.$property_slogan.'- '; ?>- See our pictures, amenities, rent and deposit prices, pet policy, apartment floorplans, and office hours. Use the Contact form to get in touch with us.">
    <meta name="keywords" content="<?php echo $property_name.', '.MARKET.', '.STATE; ?>">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://<?php echo WEBSITELOWERWWW;?>/texas/apartment/<?php echo $property_search_name; ?>/<?php echo $apt_id; ?>">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.accordionImageMenu.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/main_page_javascript.js"></script>


    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/accordionImageMenu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link rel='stylesheet' media='only screen and (min-width: 901px)' href='<?php echo base_url();?>css/apt_main_page.css' />
    <link rel='stylesheet' media='only screen and (max-width: 900px)' href='<?php echo base_url();?>css/apt_main_page_little.css' />


    <link href="https://fonts.googleapis.com/css?family=Lobster|Oswald" rel="stylesheet"/>
    <meta name="google-site-verification" content="zklGPKpd_Dq2tiI4Z00lq_cVRp2pu1nNPwbFyVXbY48" />

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-86483238-1', 'auto');
      ga('send', 'pageview');

    </script>

</head>
<body>