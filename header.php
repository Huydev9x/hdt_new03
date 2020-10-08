<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<base href="<?php echo get_template_directory_uri(); ?>/"/>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php
global $current;
$content_robots = 'index, follow';
if($current > 1) $content_robots = 'noindex, follow'; ?>
<meta name="robots" content="<?php echo $content_robots; ?>" />
<meta name="revisit-after" content="1 days" />
<?php if (is_search()) { ?><meta name="robots" content="noindex, nofollow" /><?php } ?>
<?php if(is_home()): ?>
<meta name="description" content="<?php echo get_field('meta_description', 'option'); ?>"/>
<meta name="keywords" content="<?php echo get_field('meta_keyword', 'option'); ?>"/>
<title><?php echo get_field('home_title', 'option'); ?></title>
<?php else: ?>
<title><?php wp_title(); ?></title>
<?php endif; ?>
<?php wp_head(); ?>
<link rel="shortcut icon" href="<?php echo get_field('favicon', 'option'); ?>">
<link rel="stylesheet" href="assets/css/vendor.css">
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="assets/css/responsive.css">
<?php echo get_field('code_header', 'option'); ?>
</head>
<body <?php body_class(); ?>>
<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<div class="topbar-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7 align-self-center">
                <div class="topbar-left text-md-left text-center">
                    <span><?php the_time('F j, Y'); ?></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 text-md-right text-center">
                <div class="topbar-right">
                    <ul class="social-area">
                        <?php
                        $i = 0;
                        $content = get_field('social_cn', 'option');
                        if(!empty($content) && count($content) > 0) : foreach ($content as $val) : $i++; ?>
                            <li><a class="<?php if($i % 2 == 0) echo 'bg-gray'; ?>" href="<?php echo $val['link']; ?>"><?php echo $val['icon']; ?></a></li>
                        <?php endforeach; endif; $i = 0; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="adbar-area d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 align-self-center">
            	<?php if(is_home()): ?>
            		<h1 class="logo text-md-left text-center">
            			<span style="display: none;"><?php bloginfo('name'); ?></span>
	                    <a class="main-logo" href="<?php echo get_option('home'); ?>">
	                        <img src="<?php echo get_field('logo', 'option'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"/>
	                    </a>
	                </h1>
	            <?php else: ?>
	                <h2 class="logo text-md-left text-center">
            			<span style="display: none;"><?php bloginfo('name'); ?></span>
	                    <a class="main-logo" href="<?php echo get_option('home'); ?>">
	                        <img src="<?php echo get_field('logo', 'option'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"/>
	                    </a>
	                </h2>
	            <?php endif; ?>
            </div>
            <div class="col-md-8 text-md-right text-center">
                <a href="<?php echo get_field('banner_header_link', 'option'); ?>" class="adbar-right">
                    <img src="<?php echo get_field('banner_header', 'option'); ?>" alt="Banner header"/>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="navbar-area">
    <nav class="navbar navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo d-lg-none d-block">
                    <a class="main-logo" href="<?php echo get_option('home'); ?>"><img src="<?php echo get_field('logo', 'option'); ?>" alt="<?php bloginfo('name'); ?>"/></a>
                </div>
                <button class="menu toggle-btn d-block d-lg-none" data-target="#miralax_main_menu" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="nav-right-part nav-right-part-mobile">
                <a class="search header-search" href="#"><i class="fa fa-search"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="miralax_main_menu">
                <?php
                if ( has_nav_menu( 'header_main_menu' ) ) {
                    wp_nav_menu( array( 'theme_location' => 'header_main_menu', 'container' => '', 'menu_class' => 'navbar-nav menu-open',  ) );
                } ?>
            </div>
            <div class="nav-right-part nav-right-part-desktop">
                <a class="search header-search" href="#"><i class="fa fa-search"></i></a>
            </div>
        </div>
    </nav>
</div>