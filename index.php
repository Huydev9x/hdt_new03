<?php get_header(); ?>
<!-- post-banner start -->
<div class="post-banner-area pd-bottom-55">
    <div class="container">
        <div class="row">
        	<?php
        	$i = 0;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
            );
            $post_new_query = new WP_Query($args);
            if($post_new_query->have_posts()): while($post_new_query->have_posts()) : $post_new_query->the_post(); $i++; ?>
                <div class="<?php if($i == 2){ echo 'col-lg-8'; }else{ echo 'col-lg-4'; } ?>">
	                <div class="top-post-wrap top-post-wrap-4">
	                    <div class="post-new-thumb thumb-cover thumb">
	                        <div class="overlay"></div>
                            <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
	                        <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
	                    </div>
	                    <div class="top-post-details">
	                        <?php echo get_term_custom(get_the_ID(), 'category'); ?>
	                        <h3 class="post-new-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 15, '...'); ?></a></h3>
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
	            </div>
            <?php endwhile;  wp_reset_postdata(); endif; $i = 0; ?>
        </div>
    </div>
</div>
<!-- post-banner end -->

<!-- visitors-area Start -->
<div class="visitors-area bg-gray pd-top-70 pd-bottom-50">
    <div class="container">
        <div class="section-title">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="title m-0">Tin xem nhiều</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="visitor-slider owl-carousel owl-theme">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 10,
                        'orderby'     => 'meta_value_num',
                        'meta_key'    => 'post_views_count',
                        'order'       => 'DESC',
                        'post_status' => 'publish',
                    );
                    $post_new_query = new WP_Query($args);
                    if($post_new_query->have_posts()): while($post_new_query->have_posts()) : $post_new_query->the_post(); ?>
                        <div class="item">
                            <div class="single-post-wrap">
                                <div class="post-fea-thumb thumb-cover thumb">
                                    <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                    <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
                                </div>
                                <?php echo get_term_custom(get_the_ID(), 'category'); ?>
                                <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 12, '...'); ?></a></h3>
                            </div>
                        </div>
                    <?php endwhile;  wp_reset_postdata(); endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- visitors-area End -->

<!-- top-news area Start -->
<div class="top-news-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 pd-top-70">
                <div class="section-title section-title-3 pb-0">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title mb-0"><?php echo get_field('home_tab_title', 'option'); ?></h4>
                        </div>
                        <div class="col-md-8 align-self-center text-left text-md-right">
                            <div class="top-news-tab d-inline-block">
                                <ul class="nav nav-tabs">
                                    <?php
                                    $i = 0;
                                    $content = get_field('home_tab_content', 'option');
                                    if(!empty($content) && count($content) > 0) : foreach ($content as $val) : $i++; ?>
                                        <li><a class="<?php if($i == 1) echo 'active'; ?>" data-toggle="tab" href="#news<?php echo $i; ?>"><?php echo $val['title']; ?></a></li>
                                    <?php endforeach; endif; $i = 0; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-news-tab-content tab-content">
                            <?php
                            $i = 0;
                            if(!empty($content) && count($content) > 0) : foreach ($content as $val) : $i++; ?>
                                <div id="news<?php echo $i; ?>" class="tab-pane fade <?php if($i == 1) echo 'active'; ?> show">
                                    <div class="row">
                                        <?php
                                        $args = array(
                                            'post_type' => 'post',
                                            'posts_per_page' =>  $val['number_post'],
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'category',
                                                    'field'    => 'id',
                                                    'terms'    =>  $val['cat_id'],
                                                ),
                                            ),
                                        );
                                        $post_tab_query = new WP_Query($args);
                                        if($post_tab_query->have_posts()): while($post_tab_query->have_posts()) : $post_tab_query->the_post(); ?>
                                            <div class="col-md-6">
                                                <div class="single-post-wrap">
                                                    <div class="post-tab-thumb thumb-cover thumb">
                                                        <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                                        <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
                                                        <?php echo get_term_custom(get_the_ID(), 'category'); ?>
                                                    </div>
                                                    <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 17, '...'); ?></a></h3>
                                                    <p><?php echo wp_trim_words(get_the_excerpt(), 22, '...'); ?></p>
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
                                        <?php endwhile; wp_reset_postdata(); endif; ?>
                                        <div class="col-lg-12">
                                            <a class="load-more-btn" href="<?php echo get_category_link($val['cat_id']); ?>">Xem Thêm</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; endif; $i = 0; ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="adbar-area">
                            <div class="adbar-right" style="background: url(assets/img/ad/bg-2.png);">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 align-self-center">
                                        <h6 class="text-white">Smart &amp; Responsive Ads <span>Advertisment</span></h6>
                                    </div>
                                    <div class="col-lg-4 d-none d-lg-block align-self-center text-center">
                                        <div class="thumb">
                                            <span class="text-white">710x100</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 align-self-center text-md-right">
                                        <button class="btn btn-buy">Buy Theme</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recent-news-area pd-top-70">
                            <div class="section-title section-title-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="title"><?php echo get_field('new_bottom_title', 'option'); ?></h4>
                                    </div>
                                    <div class="col-sm-6 text-sm-right align-self-center">
                                        <a class="see-all-btn" href="<?php echo get_category_link(get_field('new_bottom_cat', 'option')); ?>">Xem Thêm</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $args = array(
                                'post_type' => 'post',
                                'posts_per_page' =>  4,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field'    => 'id',
                                        'terms'    =>  get_field('new_bottom_cat', 'option'),
                                    ),
                                ),
                            );
                            $post_tab_query = new WP_Query($args);
                            if($post_tab_query->have_posts()): while($post_tab_query->have_posts()) : $post_tab_query->the_post(); ?>
                                <div class="media-post-wrap-2 media">
                                    <div class="post-bottom-thumb thumb-cover thumb">
                                        <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                            <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
                                    </div>
                                    <div class="media-body">
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 20, '...'); ?></a></h3>
                                        <div class="meta">
                                            <div class="date">
                                                <i class="fa fa-clock-o"></i>
                                                <?php the_time('j F, Y'); ?>
                                            </div>
                                            <div class="views">
                                                <?php echo getPostViews(get_the_ID()); ?> Lượt xem
                                            </div>
                                        </div>
                                        <p><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
                                    </div>
                                </div> 
                            <?php endwhile; wp_reset_postdata(); endif; ?>
                            <a class="load-more-btn" href="<?php echo get_category_link(get_field('new_bottom_cat', 'option')); ?>">Xem Thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>  
<!-- top-news area End -->

<div class="pd-bottom-80 text-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="kgl-add-inner" href="<?php echo get_option('home'); ?>">
                    <img src="assets/img/ad/5.png" alt="img">
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>