<?php get_header(); ?>
<?php include(get_template_directory_uri().'/includes/faq-header.inc.php'); ?>
<div class="container faq py-5 mb-5">
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
	<?php if ( have_posts() ) : ?>
			<ul class="list-unstyled faq-list lead">
			<?php while ( have_posts() ) : the_post(); ?> 
			 	<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>        
		
        	<?php endwhile; ?>
   			 </ul>
		<div class="post-nav">
			<?php the_posts_pagination( array( 'mid_size' => 5 ) ); ?>
		</div>
		
   		<?php else: ?>
   			<h2 class="border-bottom pb-2 mb-3">Search Result</h2>
   			<p>No FAQ match with "<?php echo "$s"; ?>"</p>
   		
    	<?php endif; ?>
	
</div>
<div class="bg-light-gray">
	<?php echo do_shortcode('[INSERT_ELEMENTOR id="962"]'); ?>
</div>
<?php get_footer(); ?>
