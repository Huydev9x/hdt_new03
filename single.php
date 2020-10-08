<?php setPostViews(get_the_ID());
get_header(); ?>
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
                    <div class="blog-tags">
                        <h5>Tags</h5>
                        <div class="tagcloud">
                            <?php
                            $post_tag = get_the_terms(get_the_ID(), 'post_tag');
                            if(!empty($post_tag) && count($post_tag) > 0) : foreach ($post_tag as $term_val) : ?>
                                <a href="<?php echo get_term_link((int)$term_val->term_id, 'post_tag'); ?>"><?php echo $term_val->name; ?></a>
                            <?php endforeach; endif; ?>
                        </div> 
                    </div>
                    <div class="recent-blog-area">
                        <div class="row">
                            <div class="col-12">
                                <h6>Bài Viết Liên Quan</h6>
                            </div>
                            <?php
                            $id = get_the_ID();
                            $type = 'post';
                            $taxonomy = 'category';
                            $pro_cat = get_the_terms($id, $taxonomy);
                            $args = array(
                                'post_type' => $type,
                                'posts_per_page' => 4,
                                'post__not_in' => array($id),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field'    => 'id',
                                        'terms'    => $pro_cat[0]->term_id,
                                    ),
                                ),
                            );
                            $pro_related = new WP_Query($args);
                            if($pro_related->have_posts()): while($pro_related->have_posts()) : $pro_related->the_post(); ?>
                                <div class="col-md-6">
                                    <div class="single-post-wrap">
                                        <div class="post-related-thumb thumb-cover thumb">
                                            <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                            <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
                                            <?php echo get_term_custom(get_the_ID(), 'category'); ?>
                                        </div>
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 17, '...'); ?></a></h3>
                                        <div class="meta">
                                            <div class="date">
                                                <i class="fa fa-clock-o"></i>
                                                <?php the_time('j F, Y'); ?>
                                            </div>
                                            <div class="views">
                                                <?php echo getPostViews(get_the_ID()); ?> Lượt xem
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;  wp_reset_postdata(); endif; ?>
                        </div>
                    </div>
                    <div class="comment-area">
                        <h5>Bình luận</h5>
                        <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-width="100%"></div>
                    </div>
                </div>                    
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=2390815964560833&autoLogAppEvents=1" nonce="ZAuXE1bX"></script>

<?php endwhile; endif; ?>
<?php get_footer(); ?>