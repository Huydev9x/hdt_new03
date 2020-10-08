<!-- footer area start -->
<footer class="footer-area">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <h5 class="widget-title"><?php echo get_field('footer_menu_title1', 'option'); ?></h5>
                    <div class="widget widget_link">
                        <?php
                        if ( has_nav_menu( 'footer_menu1' ) ) {
                            wp_nav_menu( array( 'theme_location' => 'footer_menu1', 'container' => '',  ) );
                        } ?>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <h5 class="widget-title"><?php echo get_field('footer_menu_title2', 'option'); ?></h5>
                    <div class="widget widget_link">
                        <?php
                        if ( has_nav_menu( 'footer_menu2' ) ) {
                            wp_nav_menu( array( 'theme_location' => 'footer_menu2', 'container' => '',  ) );
                        } ?>
                    </div>
                </div>
                <div class="col-xl-2 offset-xl-1 col-md-4 col-sm-6">
                    <h5 class="widget-title"><?php echo get_field('footer_menu_title3', 'option'); ?></h5>
                    <div class="widget widget_link">
                        <?php
                        if ( has_nav_menu( 'footer_menu3' ) ) {
                            wp_nav_menu( array( 'theme_location' => 'footer_menu3', 'container' => '',  ) );
                        } ?>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <h5 class="widget-title"><?php echo get_field('footer_menu_title4', 'option'); ?></h5>
                    <div class="widget widget_link">
                        <?php
                        if ( has_nav_menu( 'footer_menu4' ) ) {
                            wp_nav_menu( array( 'theme_location' => 'footer_menu4', 'container' => '',  ) );
                        } ?>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                    <div class="widget widget_post_list">
                        <h5 class="widget-title">Có Thể Bạn Quan Tâm</h5>
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'orderby' => 'rand',
                        );
                        $post_footer_query = new WP_Query($args);
                        if($post_footer_query->have_posts()): while($post_footer_query->have_posts()) : $post_footer_query->the_post(); ?>
                            <div class="media-post-wrap media">
                                <div class="post-footer-thumb thumb-cover thumb">
                                    <?php $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
                                    <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"/>
                                </div>
                                <div class="media-body">
                                    <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 7, '...'); ?></a></h3>
                                    <div class="meta">
                                        <div class="date">
                                            <?php the_time('j F'); ?>
                                        </div>
                                        <div class="author">
                                            <?php the_author(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;  wp_reset_postdata(); endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 align-self-center">
                    <div class="footer-logo">
                        <img src="<?php echo get_field('footer_logo', 'option'); ?>" alt="Logo Footer"/>
                    </div>
                    <?php
                    if ( has_nav_menu( 'footer_menu5' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'footer_menu5', 'container' => '', 'menu_class' => 'footer_menu',  ) );
                    } ?>
                </div>
                <div class="col-xl-4 col-lg-5 text-lg-right">
                    <?php echo do_shortcode('[contact-form-7 id="130" title="Đăng ký footer"]'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 align-self-center">
                    <?php
                    if ( has_nav_menu( 'footer_menu6' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'footer_menu6', 'container' => '', 'menu_class' => 'privacy-menu',  ) );
                    } ?>
                </div>
                <div class="col-xl-3 col-lg-6 text-lg-center align-self-center">
                    <p><?php echo get_field('copyright', 'option'); ?></p>
                </div>
                <div class="col-xl-4 text-xl-right text-xl-center">
                    <ul class="social-area social-area-2">
                        <?php
                        $content = get_field('social_cn', 'option');
                        if(!empty($content) && count($content) > 0) : foreach ($content as $val) : $i++; ?>
                            <li><a href="<?php echo $val['link']; ?>"><?php echo $val['icon']; ?></a></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->

<!-- search popup area start -->
<div class="search-popup" id="search-popup">
    <form class="search-form" action="<?php echo get_the_permalink(131); ?>" method="get">
        <div class="form-group">
            <input name="sn" type="text" class="form-control" placeholder="Tìm kiếm...">
        </div>
        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
    </form>
</div>
<!-- //. search Popup -->
<div class="body-overlay" id="body-overlay"></div>

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-double-up"></i></span>
</div>
<!-- back to top area end -->
<?php wp_footer(); ?>
<script src="assets/js/vendor.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/main.js"></script>
<?php echo get_field('code_footer', 'option'); ?>
</body>
</html>