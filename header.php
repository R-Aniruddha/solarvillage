<!doctype html>
<html <?php language_attributes(); ?> class="m-0">
  <head>
	<link rel="dns-prefetch" href="//csr.inspsearchapi.com" />
	<link rel="dns-prefetch" href="//config.inspsearchapi.com" />
	<link rel="dns-prefetch" href="//appapi.inspsearchapi.com" />
	<link rel="dns-prefetch" href="//glogger.stuff.com" />
	<link rel="dns-prefetch" href="//fonts.googleapis.com/" /> 
	<link rel="dns-prefetch" href="//use.fontawesome.com/" />
	<link rel="preconnect" href="//connect.facebook.net"  crossorigin  />
	  
	  
	<?php if ( is_front_page() ) { ?>
	  <title>Solar Village | Let&#039;s search for a brighter tomorrow</title>
	  <?php } else { ?>
	  <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?> | <?php wp_title(); ?></title>
	  <?php } ?>
   
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="manifest" href="./manifest.json" />
	<meta name="theme-color" content="#ffdd2e">
	<meta name="google-site-verification" content="Py_frmHF6ktyQ1LTrT4WnvaBvdask10Dz05Lxn8aBz4" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link rel="preload" as="script" href="//csr.inspsearchapi.com/lib/infospace.search.js">  
	<link rel="preload" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600" as="style" onload="this.rel='stylesheet'">
	<link rel="preload" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" as="style" onload="this.rel='stylesheet'">   
	<link rel="preload" href="<?php echo get_bloginfo('template_url').'/css/solarvillage.min.css';?>" as="style" onload="this.rel='stylesheet'">
	
	<script type="text/javascript" src="//csr.inspsearchapi.com/lib/infospace.search.js"></script> 
	  <!-- Global site tag (gtag.js) - Google Analytics -->
	  <script></script>
	  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109759673-1">
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-109759673-1');
	  </script>
	<?php wp_head(); ?>
	
	  <!-- Facebook Pixel Code -->
	<script async>
  	!function(f,b,e,v,n,t,s)
  	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  	n.queue=[];t=b.createElement(e);t.async=!0;
  	t.src=v;s=b.getElementsByTagName(e)[0];
  	s.parentNode.insertBefore(t,s)}(window, document,'script',
  	'https://connect.facebook.net/en_US/fbevents.js');
  	fbq('init', '348394299255814');
  	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
  	src="https://www.facebook.com/tr?id=348394299255814&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
	 <style>
		 /* source-sans-pro-200 - latin */
		 @font-face {
			 font-family: 'Source Sans Pro';
			 font-display: swap;
			 font-weight: 200;
			 src: local('Source Sans Pro ExtraLight'), local('SourceSansPro-ExtraLight'),
				 url('//thesolarvillage.org/wp-content/themes/solarvillage/webfonts/source-sans-pro-v11-latin-200.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
				 url('//thesolarvillage.org/wp-content/themes/solarvillage/webfonts/source-sans-pro-v11-latin-200.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
		 }
		 @font-face{
			 font-family: 'Font Awesome 5 Free';
			 font-display: swap;
		 }
	 </style>
	</head>
  <body <?php body_class(); ?>>
  <div class="container-fluid header-nav standard sticky-top" id="navHeader">  
  <nav class="navbar row">
      <a href="<?php echo home_url(); ?>" class="navbar-brand">
		  <img class="d-md-none" height="35"  src="<?php echo get_stylesheet_directory_uri(); ?>/images/solar-foot-path.png">
		  <img class="d-md-block d-none" height="35"  src="<?php echo get_stylesheet_directory_uri(); ?>/images/solar-village-logo.svg"></a>
      <?php include_once('includes/search.inc.php'); ?>
	    <?php echo addon_button(); ?>
      <div class="mobile-nav">
        <button class="navbar-toggler d-block" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="fa fa-bars"></span>
        </button>
      </div>
      
      <div class=" collapse navbar-collapse justify-content-center" id="navbarNav">
        <?php echo wp_nav_menu( $args = array("theme_location" => 'main_menu', "menu_class" => "navbar-nav header-nav") ); ?>
      </div>
  </nav>
</div>