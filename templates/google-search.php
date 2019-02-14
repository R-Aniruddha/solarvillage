<?php
/* 
Template Name: google-search
*/

if(!get_query_var('q')){
	wp_redirect(home_url());
	exit();
}
?>
<?php get_header(); ?>
    <?php echo  get_query_var('q'); ?>
    hello
<?php get_footer(); ?>