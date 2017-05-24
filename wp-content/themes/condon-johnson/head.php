<!DOCTYPE html>
    <html <?php language_attributes(); ?> >
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Condon Jonson</title>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <?php wp_head(); ?>


        <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/favicon.png" />

        <!-- Bootstrap -->
         <link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
         <link href="<?php bloginfo('template_directory'); ?>/css/style.css" rel="stylesheet">
         <link href="<?php bloginfo('template_directory'); ?>/css/responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/jquery.cookie.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/logic.js"></script>




        <?php wp_enqueue_media(); ?>

    </head>
    <body <?php body_class(); ?> >
    <div class="wrapper">