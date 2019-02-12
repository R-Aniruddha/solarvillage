<?php get_header(); ?>
<div class="container custom-page">
	<?php include_once(get_template_directory_uri().'/includes/faq-header.inc.php'); ?>
	<h2 class="border-bottom pb-2 mb-3"><?php echo get_query_var( 'term' );?></h2>
	<?php if ( have_posts() ) : ?>
		<ul class="list-unstyled faq-list">
		<?php while ( have_posts() ) : the_post(); ?>
			<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <small> (<?php edit_post_link(); ?>) </small></li>
       		<?php wp_link_pages(); ?> 
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	</ul>
    	<div class="navigation index">
       		<div class="alignleft"><?php next_posts_link( 'Older Entries' ); ?></div>
       		<div class="alignright"><?php previous_posts_link( 'Newer Entries' ); ?></div>
    	</div><!--end navigation-->
	<?php else : ?>
	<?php endif; ?>
</div>
<?php get_footer(); ?>