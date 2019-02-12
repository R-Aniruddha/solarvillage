<?php 
  $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
  require_once( $parse_uri[0] . 'wp-load.php' );
?>

<div class="faq-header text-center">
	<div class="faq-search">
		<h1><b>FAQ</b></h1>
		<div class="rounded-search">
			<form action="<?php echo site_url('/faq'); ?>" method="get">
		 		<div class="justify-content-center d-flex">
			 		<div class="input-group mb-3 col-md-6 input-group-lg">
				  		<input name="s" type="text" class="form-control lead" value="<?php echo $value; ?>" placeholder="What are you looking for?">
				  		<div class="input-group-append">
				  	 		<button class="btn btn-primary" type="submit" id="button-addon1"><i class="fa fa-search"></i></button>
				  		</div>
					</div>
				</div>
		  	</form>
		</div>
	</div>
</div>
