<div class="col-lg-4">
    <div class="sidebar-area">
        <div class="widget widget-subscribe text-center">
            <h5>Đăng Ký Ngay</h5>
            <div class="widget-subscribe-details">
                <div class="thumb">
                    <img src="assets/img/icon/envelope.png" alt="img">
                </div>
                <h6>Đăng Ký Bản Tin Của Chúng Tôi</h6>
                <?php echo do_shortcode('[contact-form-7 id="5" title="Đăng ký nhận bản tin"]'); ?>
                <p>Nhận ngay thông báo về những tin tức mới nhất.</p>
            </div>
        </div>
        <div class="widget widget-social-area">
            <h5 class="widget-title">Social Media</h5>
            <ul>
            	<?php
                $content = get_field('sb_social', 'option');
                if(!empty($content) && count($content) > 0) : foreach ($content as $val) : ?>
                    <li class="<?php echo $val['class_css']; ?>"><a href="<?php echo $val['link']; ?>"><?php echo $val['icon']; ?><?php echo $val['title']; ?></a></li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
        <div class="widget widget-list">
            <h5 class="widget-title"><?php echo get_field('sb_new_title1', 'option'); ?></h5>
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' =>  5,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    =>  get_field('sb_new_cat1', 'option'),
                    ),
                ),
            );
            $post_tab_query = new WP_Query($args);
            if($post_tab_query->have_posts()): while($post_tab_query->have_posts()) : $post_tab_query->the_post(); ?>
                <div class="media-post-wrap media">
                    <div class="post-sb-thumb thumb-cover thumb">
                        <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                        <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
                    </div>
                    <div class="media-body">
                        <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 15, '...'); ?></a></h3>
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
            <a class="load-more-btn" href="<?php echo get_category_link(get_field('sb_new_cat1', 'option')); ?>">Xem Thêm</a>
        </div>
        <div class="widget widget-post">
            <h5 class="widget-title"><?php echo get_field('sb_new_title2', 'option'); ?></h5>
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' =>  2,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    =>  get_field('sb_new_cat2', 'option'),
                    ),
                ),
            );
            $post_tab_query = new WP_Query($args);
            if($post_tab_query->have_posts()): while($post_tab_query->have_posts()) : $post_tab_query->the_post(); ?>
                <div class="single-widget-post">
                    <div class="post-sb-thumb2 thumb-cover thumb">
                        <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                        <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 15, '...'); ?></a></h3>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
            <a class="load-more-btn" href="<?php echo get_category_link(get_field('sb_new_cat2', 'option')); ?>">Xem Thêm</a>
        </div>
        <div class="widget widget_tags">
            <h4 class="widget-title">Tags</h4>
            <div class="tagcloud">
                <?php 
                $args = array(
                    'hide_empty' => false,
                    'parent'     => 0,
                );
                $terms = get_terms('post_tag', $args );
                if(!empty($terms) && count($terms) > 0): foreach($terms as $term_val): ?>
                    <a href="<?php echo get_term_link((int)$term_val->term_id, 'post_tag'); ?>"><?php echo $term_val->name; ?></a>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>