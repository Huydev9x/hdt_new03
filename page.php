<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<div class="blog-details-area pd-top-50 pd-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-wrap">
                	<div class="block-breakcrumb-single block-breakcrumb">
					    <?php if ( function_exists('yoast_breadcrumb') ){yoast_breadcrumb('','');} ?>
					</div>
                    <h1 class="single-title"><?php the_title(); ?></h1>
                    <div class="single-content">
                    	<?php the_content(); ?>
                    </div>
                    <div class="blog-share-area">
                        <h5>Chia Sẻ:</h5>
                        <ul class="social-area social-area-3">
                            <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
                        </ul>
                    </div>
                </div>                    
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>