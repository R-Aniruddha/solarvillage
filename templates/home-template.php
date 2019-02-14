<?php
/*
Template Name: home-page
*/
?>
<?php get_header(); ?>

<div class="container home-container d-flex justify-content-center align-items-center">
	<?php echo get_magic_quotes_gpc(); ?>
	<div class="home-content text-center w-100">
	    <div class="home-brand" style="margin-bottom: 3rem;">
	        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/solar-village-logo.svg" alt="Solar Village">
            <p class="lead-2"><?php echo get_bloginfo('description'); ?></p>
	    </div>
	    <div class="home-search">
		       <form action="<?php echo esc_attr( home_url( '/search' ) );?>" method="get">
					<div class="input-group input-group-lg">
						<input placeholder="Search to generate solar power..." type="search" class="form-control" name="q">
						<div class="input-group-append">
							<button type="submit" class="input-group-text bg-white btn border-left-0"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
		 
		</div>

	    <div class="solar-content mt-5 mb-2">
	        <?php echo addon_button(); ?>
	    </div>
	</div>
</div>
<style>
::-webkit-input-placeholder {
	color: #B0B0B2 !important;
}
::-moz-placeholder {
	color: #B0B0B2 !important;
}
:-ms-input-placeholder { 
	color: #B0B0B2 !important;
}
::placeholder { 
	color: #B0B0B2 !important;
	}
	@media only screen and (max-width: 767px){
	::-webkit-input-placeholder {
				font-size:.75em;
	}
	::-moz-placeholder {
				font-size:.75em;
	}
	:-ms-input-placeholder { 
				font-size:.75em;
	}
	::placeholder { 
				font-size:.75em;
	}
	}
</style>
<?php get_footer(); ?>