<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Solarvillage
 * @since Solarvillage 1.0
 */

get_header(); ?>

<div class="container">
	<div class="row pt-4">
		<div class="col-md-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<h2 class="mb-4"><b><?php echo the_title(); ?> </b></h2>
				<?php the_content(); ?>
			<?php endwhile; ?>
			
			
		</div>
		<div class="col-md-4">
			<div class="box mb-3">
				<h4 class="mb-2"><b>Search</b></h4>
				<div class="rounded-search">
					<form action="<?php echo site_url('/faq'); ?>" method="get">
				 		<div class="justify-content-center d-flex">
					 		<div class="input-group mb-3">
						  		<input name="s" type="text" class="form-control lead" value="<?php echo $value; ?>" placeholder="What are you looking for?">
						  		<div class="input-group-append">
						  	 		<button class="btn btn-primary" type="submit" id="button-addon1"><i class="fa fa-search"></i></button>
						  		</div>
							</div>
						</div>
				  	</form>
				</div>
			</div>
			

			

			<div class="faq-list related">
				<?php $tags = wp_get_post_tags(get_the_id());
   
				 // if ($tags) {
				  $tag_ids = array();
				  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				  $args=array(
				  'post_type' => 'faq',
				  'tag__in' => $tag_ids,
				  'post__not_in' => array(get_the_id()),
				  'posts_per_page'=> 5, // Number of related posts to display.
				  'orderby' => 'rand',
				 );

				$related = new WP_Query( $args );
				if ($related->have_posts()): ?>
					<h4 class="mb-2"><b>Related articles</b></h4>
					<ul class="list-unstyled">
						<?php while($related->have_posts()): $related->the_post(); ?>
							<li><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>
<div class="m-5"></div>
<div class="bg-light-gray">
	<?php echo do_shortcode('[INSERT_ELEMENTOR id="962"]'); ?>
</div>
<?php get_footer(); ?>
