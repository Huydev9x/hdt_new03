<?php get_header(); 
$post_type = 'post';
$taxonomy = 'category';
$current_term_id = get_queried_object_id();
$term = get_term((int)$current_term_id, $taxonomy); ?>
<div class="blog-area pd-top-50 pd-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
            	<div class="block-tax-head section-title section-title-3">
                    <div class="row">
                    	<div class="col-sm-12">
                    		<h1 class="tax-title title"><?php echo $term->name; ?></h1>
                    	</div>
                    </div>
                    <div class="block-breakcrumb">
					    <?php if ( function_exists('yoast_breadcrumb') ){yoast_breadcrumb('','');} ?>
					</div>
                </div>
	                
                <?php
	            global $current;
	            $record_per_page = 10;
	            $offset = ( $current - 1 ) * $record_per_page;
	            $total = ceil(wp_count_posts('post')->publish / $record_per_page);
	            $args = array(
	                'post_type'  => $post_type,
	                'posts_per_page' => $record_per_page,
	                'page' => $current,
	                'offset' => $offset,
	                'tax_query' => array(
	                    array(
	                        'taxonomy' => $taxonomy,
	                        'field'    => 'id',
	                        'terms'    => $current_term_id,
	                    ),
	                ),
	            );
	            $archive_post_query = new WP_Query( $args );
	            if ( $archive_post_query->have_posts() ) : while ( $archive_post_query->have_posts() ) : $archive_post_query->the_post(); ?>
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
	            <?php endwhile; wp_reset_postdata(); else: ?>
	               <p class="empty-content">Bài viết đang cập nhật...</p> 
	            <?php endif; ?>
                <div class="pagination">
		            <?php
		            $big = 999999999;
		            echo paginate_links(array(
		                'base' => @add_query_arg('paged', '%#%'),
		                'format' => '?paged=%#%',
		                'current' =>  $current,
		                'total' => $archive_post_query->max_num_pages,
		                'prev_text' => __('&laquo;'),
		                'next_text' => __('&raquo;'),
		                'mid_size' => 3
		            )); ?>
		        </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div> 

<?php get_footer(); ?>