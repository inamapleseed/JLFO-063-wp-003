
<?php
/*
 * Template Name: Template Blog Page
 */

?>

<?php get_header(); 
$cat_id = get_queried_object()->cat_ID;

?>

<div class="category_page" id="main-content">
<?//php echo do_shortcode('[et_pb_section global_module="411"][/et_pb_section]'); ?>
<?php if(get_field('banner_imagee', 'options')):?>
    <img src="<?php echo get_field('banner_imagee', 'options'); ?>" alt="banner"/>
<?php endif ?>
    <h2 style="text-align: center; padding: 50px 0 20px;">Newsroom</h2>
<div class="container">
<?php
global $wp;
$limit = 6;
$post_type = 'post'; 
// $post_type = get_post_type(); 
$post_taxonomy = 'category';
// $obj = get_queried_object();
// if($post_type == ''){
//     $post_taxonomy = $obj->taxonomy;
//     $post_type = get_post_types_by_taxonomy($post_taxonomy);
// }else{
//     $post_taxonomy = get_object_taxonomies( $post_type );
// }
// print_r($post_taxonomy );
// print_r($obj );
$page_name = '';

if($obj->label){
    $page_name = $obj->label;
}else{
    $page_name = $obj->name;
}

// $items_per_page = 20;
// $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$cur_term_id = get_queried_object()->term_id;

$paged = ( $_GET['pg'] ) ? $_GET['pg'] : 1;
$tax = array();
		
if($cur_term_id > 0) {
    $tax[] = array(
        'taxonomy' => $post_taxonomy,
        'field'    => 'term_id',
        'terms'    => $cur_term_id,
    );
}

// $terms = get_terms( 
//     array(
//         'taxonomy' => $post_taxonomy,
//         'hide_empty' => false,
//     ) 
// );

$args_taxonomy = array(
    'hide_empty'         => 1,
    'echo'               => 1,
    'taxonomy'      => $post_taxonomy,
    'hierarchical'  =>1,
    'show_count' => 0,
    'title_li' => ''
);

function add_class_wp_list_categories($wp_list_categories) {
        $pattern = '/<li class="/is';
        $replacement = '<li class="first ';
        return preg_replace($pattern, $replacement, $wp_list_categories);
}
add_filter('wp_list_categories','add_class_wp_list_categories');

//  $args = array(
//                                 'post_type'      => 'post',
//                                 'cat'            => $cat_id,
//                                 'post_status'    => 'publish',
//                                 'posts_per_page' => 10,
//                                 'orderby'        => 'date',
//                                 'order'          => $ordersort,
//                                 'paged' => $paged,
//                             );
                            
$args = array( 
    'post_type'      => $post_type,
     'cat'            => $cat_id,
    // 'posts_per_page' => $limit,
    'post_status'    => 'publish',
    // 'orderby'        => 'menu_order',
    'orderby'        => 'date',
    'order'          => 'DESC',
    // 'orderby'        => 'modified',
    // 'order'          => 'DESC',
    // 'tax_query'      => $tax,
    'paged'          => $paged
);

$news = new WP_Query( $args );

$args = array( 
    'post_type'      => $post_type,
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'orderby'        => 'modified',
    'order'          => 'DESC',
);
$upcoming = new WP_Query( $args );

?>

    <div class="container_left" id="filter-groups">

        <div class="content category" id="side-categories">
    		<div class="parentt "><span>Category</span> <div>+</div></div>
            <div class="childcon">
				<div style="padding-left: 15px;margin-bottom: 5px">
					<div class="item level-1 <?php if ($category->slug == $category_slug) { ?>active<?php } ?>" >
                        <?php echo wp_list_categories( $args_taxonomy ); ?>
					</div> 
				</div>
			</div>
        </div>

		<div class="custom-filters-archives custom-filters">

			<div class="archives">
				<div class="parentt" ><span>Archives</span> <div>+</div></div>
                <?php
                global $wpdb;

                $limit = 0;
                $year_prev = null;
                // $months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,	YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date DESC");
                $months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,	YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY year DESC,  month DESC");

                foreach($months as $month) :

                    $year_current = $month->year;
                    
                    if ($year_current != $year_prev)
                    {
                        if($year_current != date('Y'))
                        {
                        ?>
                            </ul>
                        <?php
                        }
                        ?>

                        <div class="year">
                            <a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/"><?php echo $month->year; ?></a>
                        </div>	
                        <ul class='list-group'>			
                    <?php 
                    } 
                    ?>
                    
                    <?php 
                    $year_prev = $year_current;

                endforeach; 
                ?>
                </ul>
			</div>				
		</div>
		<!--end-->


    </div>

    <style>
        .wywidden {
            display: none;
        }
        .wywow {
            display: flex;
        }
    </style>
    <div class="container_right custom-grid">
        <div class="events-container">
            <div class="events">
                <?php if( $news->have_posts() ):?>
                    <?php while ($news->have_posts()) : $news->the_post();
                        ?>
                            <div class="li-container news-block wywidden boxes y<?php echo get_the_date( 'Y' ); ?>">
                                <div class="image">
        		    				<div class="wrapper">
        		    					<a href="<?php echo get_the_permalink();?>"><img src="<?=get_the_post_thumbnail_url(get_the_ID(),'full') ? get_the_post_thumbnail_url(get_the_ID(),'full') : get_field('article_image');?>" class="img-responsive" alt="<?php echo get_the_title();?>"></a>
        		    				</div>
                                </div>
            
                                <div class="info">
                                    <h4 class="title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="date"><?php echo get_the_date( 'd F Y' ); ?></div>
                                    <p><?php the_excerpt(); ?></p>
        		    				<div class="description">
        		    					<?php echo $description;?>
        		    				</div>
        		    				<a href="<?php echo get_the_permalink();?>" class="btn btn-primary">Read More<i class="la la-arrow-right"></i></a>
                                </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ;?>
                <p>There is not any News at the moment</p>
                <?php endif; wp_reset_query(); ?>
            </div>
        </div>
                                <script>
                                    var url = jQuery(location).attr('href');
                                    let parts = url.split("/");
                                    let last_part = '.y' + parts[parts.length-2];
                                    // alert(last_part);
                                    jQuery(last_part).addClass('wywow');
                                </script>
        <div class="pg-div"><?php echo custom_pagination($news->max_num_pages, "", $paged); ?></div>
    </div>
</div>
</div>

<script>
    jQuery('#side-categories .childcon').hide();
    jQuery('#side-categories .parentt').click(function(){
	    jQuery('#side-categories .childcon').toggle();
        
    });
    
    jQuery('.archives .year').hide();
    jQuery('.archives .parentt').click(function(){
	    jQuery('.archives .year').toggle();
        
    });
    jQuery('.current-cat').parent().parent().parent().show();
    jQuery('.current-cat').css('font-weight', '600');
</script>
<style>
    .parentt {
	    background: #88AED0;
	    cursor: pointer;
        color: white;
        padding: 8px 15px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
    }
</style>
<script type="text/javascript"> 
// jQuery(document).ready(function($){ 

// $( ".newscontainer .category > ul > li" ).each(function( index ) {
//     if ( $(this).children('ul').length > 0 ) {
//         $(this).children('a').append("<div class='caret'></div>");
//     }



// });

// $( document ).on( "click", ".category .caret", function(event) {
//         // event.stopImmediatePropagation();
//         event.preventDefault();
//         event.stopPropagation();
//         $(this).parents('li').toggleClass('active');
//   });



// $( ".newscontainer .archive-container" ).each(function( index ) {
//     if ( $(this).children('ul').length > 0 ) {
//         $(this).children('.year').append("<div class='caret'></div>");
//     }
// });

// $( document ).on( "click", ".archive-container .caret", function(event) {
//         // event.stopImmediatePropagation();
//         event.preventDefault();
//         event.stopPropagation();
//         $(this).parents('.archive-container').toggleClass('active');
//   });
// });
</script>

<?php get_footer(); ?>