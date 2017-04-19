<html>
<head>
	<title><?php echo WEBSITE; ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico">
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    
    
    <script src="<?php echo base_url(); ?>js/jquery-3.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>js/panelSnap.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/main_page_javascript.js"></script>
    <style>
        body{
            padding:20px;
        }
        #outer_table{
            height:200px;
            width: 500px;
            border:1px solid blue;
        }
        section{
            width:100%;
            height:200px;
        }
        .blue{
            background: #9FC3E8;
        }
        .red{
            background: #E18B8F;
        }
        .green{
            background: #9AE68E;
        }
        .yellow{
            background: #E2C58E;
        }
    </style>

    <script>
        var options = {
            $menu: false,
            menuSelector: 'a',
            panelSelector: 'section',
            namespace: '.panelSnap',
            onSnapStart: function(){},
            onSnapFinish: function(){},
            directionThreshold: 10,
            slideSpeed: 100
        };

        $('#outer_table').panelSnap(options);
    </script>


</head>
<body>

<div id="outer_table">
    <section class="blue">
        ONE
    </section>
    <section class="red">
        TWO
    </section class="green">
    <section>
        THREE
    </section>
    <section class="yellow">
        FOUR
    </section>
</div>


</body>
</html>