 <?php 
  $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
  require_once( $parse_uri[0] . 'wp-load.php' );
?>

    <div class="subscribe-box">
<?php //if (function_exists('newsletter_form')) newsletter_form(); ?>
<form class="d-flex justify-content-center" method="post" action="https://www.thesolarvillage.org/?na=s" onsubmit="return newsletter_check(this)">
  
        <div class="col-md-5">
	
          <input type="email" name="ne" required class="form-control w-100" placeholder="Enter your email...">
        </div>
        
          <button type="submit" class="btn bg-yellow text-uppercase"><b>Subscribe</b></button>
      </form>
    </div>