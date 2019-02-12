<?php
/*
Template Name: no-header-footer
*/
?>
<?php get_header(); ?>
<div class="container">
	<div class="d-flex justify-content-center align-items-center no-hf">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>
</div>
</div>
<?php get_footer(); ?>
<style>
	.header-nav, .footer, .entry-header {
	display: none;
	}
</style>