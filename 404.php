<?php get_header();?>
<?php $post = get_post(429); ?>
<div class="container h-100 d-flex align-items-center">
	<div class="text-center w-100">
		<?php echo $post->post_content; ?>
	</div>
</div>
<?php get_footer();?>
<style>
	.header-nav, .footer {
		display:none;
	}
</style>