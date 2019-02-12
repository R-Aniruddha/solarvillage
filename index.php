<?php get_header(); ?>
<div class="container blog py-5">
    <h2 class="mb-4 mt-4 pb-2 text-center"><b>Blog</b></h2>
    <?php if ( have_posts() ) : ?>
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" class="col-sm-4 mb-4">
                    <div class="card border-0">
                        <div class="card-img">
                            <?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail('medium', array('class'=>'card-img-top')); ?>
                            <div class="card-share social-icons d-flex icon-small">
                                <a title="Share on Facebook" aria-label="Share on Facebook" tabindex="-1" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share', 'width=580, height=296'); return false;" class="fb icon"></a>
                                <a title="Share on Twitter" aria-label="Share on Twitter" tabindex="-1" href="https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550, height=235'); return false;" class="tw icon"></a>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <h5 class="card-title mb-1"><a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <div class="text-muted text-uppercase small">
                                <?php echo get_the_date(); ?> / <?php echo get_the_author(); ?>
                            </div>
                        </div>
                    </div>
            </div>
            <?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
        </div>
        <?php else : ?>
            <?php the_content(); ?>
            <?php edit_post_link(); ?>
            <?php wp_link_pages(); ?>
            <div class="navigation index">
                <div class="alignleft"><?php next_posts_link( 'Older Entries' ); ?></div>
                <div class="alignright"><?php previous_posts_link( 'Newer Entries' ); ?></div>
            </div><!--end navigation-->
        <?php endif; ?>
</div>
<?php get_footer(); ?>
   