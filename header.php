<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> ng-app="Hooligans">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('&laquo;', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/favicon.ico" />
  <?php wp_head();?>
  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />


  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-87016825-1', 'auto');
    ga('send', 'pageview');

  </script>



</head>
<body <?php body_class(); ?>>

  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '118165998643570',
        xfbml      : true,
        version    : 'v2.7'
      });
    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>

  <header>

    <a href="<?php bloginfo('wpurl'); ?>" onclick="sendAnalytics('header','click','logo - homepage')"><img class="logo svg" src="<?php echo get_template_directory_uri() ?>/assets/images/hooligans-logo.svg" alt="לוגו חוליגנס" /></a>

    <div class="links">
      <a class="contact-btn en" href="/wanted" onclick="sendAnalytics('header','click','wanted')">Wanted</a>
      <a class="contact-btn en" href="/contact" onclick="sendAnalytics('header','click','contact')">Talk to Us</a>
      <a class="fb-btn" href="https://www.facebook.com/HooligansLtd/?fref=ts" target="_blank" onclick="sendAnalytics('header','click','facebook')"><span class="fa fa-facebook"></span></a>
      <a class="insta-btn" href="https://www.instagram.com/hooligans_agency/" target="_blank" onclick="sendAnalytics('header','click','instagram')"><span class="fa fa-instagram"></span></a>
      <a class="youtube-btn" href="https://www.youtube.com/channel/UChafnH1HzHunCBpJaO2hDrA" target="_blank" onclick="sendAnalytics('header','click','youtube')"><span class="fa fa-youtube-play"></span></a>
    </div>
  </header>

  <div id="main-content" ng-controller="Main" >
