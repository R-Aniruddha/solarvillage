<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Solarvillage
 * @since Solarvillage 1.0
 */

get_header(); ?>
<div class="container blog-single py-4 ">
	<div class="row">
		<div class="col-md-9">
			<?php while ( have_posts() ) : the_post(); ?>
			
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('large', array('class'=>'img-fluid')); ?>
					</a>
				</div><!-- .post-thumbnail -->
				<h2 class="mt-3 mb-0"><?php the_title(); ?>
			<div class="social-icons d-flex icon-small float-right">
							<a title="Share on Facebook" aria-label="Share on Facebook" tabindex="-1" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share', 'width=580, height=296'); return false;" class="fb icon"></a>
							<a title="Share on Twitter" aria-label="Share on Twitter" tabindex="-1" href="https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550, height=235'); return false;" class="tw icon"></a>
</div>
			</h2>
				<div class="text-muted text-uppercase mb-3">
					<?php //echo the_category(); ?>  <?php echo get_the_date(); ?> / <?php echo get_the_author(); ?>
				</div>
				<?php the_content( sprintf(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'solarvillalge' ),
					get_the_title()
				) ); ?>

				<?php //if ( comments_open() || get_comments_number() ) :
						//comments_template();
				//endif; ?>
			<?php endwhile; ?>
		</div>
		<div class="col-md-3">
				<?php $tags = wp_get_post_tags(get_the_id());
   
				 // if ($tags) {
				  $tag_ids = array();
				  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				  $args=array(
				  
				  'post_type' => 'post',
				  'orderby' => 'post_date',
				  'order' => 'DESC',
				  'tag__in' => $tag_ids,
				  'post__not_in' => array(get_the_id()),
				  'posts_per_page'=> 5, // Number of related posts to display.
			
				 
				  );

				$related = new WP_Query( $args );
				if ($related->have_posts()): ?>
					<h3 class="mb-2">Recent Posts</h3>
					
						<?php while($related->have_posts()): $related->the_post(); ?>
							<div class="recent d-flex border-bottom">
								<div class="recent-content">
									<h5><a class="text-dark small" href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h5>
									<div class="text-muted text-uppercase mb-3 small">
										<?php echo get_the_date(); ?>
									</div>
								</div>
								<div class="recent-thumbnail align-self-center">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium', array('class'=>'img-fluid')); ?>
									</a>
								</div><!-- .post-thumbnail -->
							</div>
						
						<?php endwhile; ?>
					
				<?php endif; ?>
		</div>
	</div>
</div>
<div class="bg-light-gray">
<?php echo do_shortcode('[INSERT_ELEMENTOR id="962"]'); ?>	
</div>

<?php get_footer(); ?>
