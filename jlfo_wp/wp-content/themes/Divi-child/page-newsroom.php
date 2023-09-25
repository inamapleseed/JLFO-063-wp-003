
<?php
/*
 * Template Name: Template Blog Page
 */

?>

<?php get_header(); 
$cat_id = get_queried_object()->cat_ID

?>

<div><img style="width: 100%; " src="<?php echo get_field('banner_imagee'); ?>" alt="banner"/></div>


<?php

if(isset($_GET['order-sort'])){
    $ordersort = $_GET['order-sort'];
}
else{
    $ordersort = 'DESC';
}

//Protect against arbitrary paged values
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$args = array(
    'post_type'      => 'post',
    'CAT'            => $CAT_ID,
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => $ordersort,
    'paged' => $paged,
);

$promotion_articles = new WP_Query( $args );
if($promotion_articles->have_posts()) :
    ?>
    <div id="main-content">
        <div class="container">
            <?php 
            if($_GET){
            	$page_number = $_GET['page-number'];
            	$ordersort = $_GET['order-sort'];
            }
            else{
            	$page_number = 6;
            	$ordersort = 'DESC';
            }
            $categories = get_categories();
            //$category_link = get_category_link( $category_id );
            
            $args = array(
            	'show_option_none' => __( 'Select category', 'textdomain' ),
            	'show_count'       => 0,
            	'orderby'          => 'name',
            	'echo'             => 0,
            );
            $select  = wp_dropdown_categories( $args );
            $replace = "<select$1 onchange='return this.form.submit()'>";
            $select  = preg_replace( '#<select([^>]*)>#', $replace, $select );
            ?>
            
            <div class="container_left" id="filter-groups">
                <div class="content category" id="side-categories">
            		<div class="parentt "><span>Category</span> <div>+</div></div>
                    <div class="childcon hidden">
                        <style>.childcon.hidden {
                        display: none !important</style>
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
            	</form>
            </div>
            
            <script type="text/javascript">
                /* dropdown sorting */
                function sortOrder() {
                
                	document.getElementById('dropdown-sort').submit();
                }
            </script>
            <div class="container_right custom-grid">                   
                <?php 
                while ( $promotion_articles->have_posts() ) : $promotion_articles->the_post(); 
                    $thumbanil = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full' );
                    ?>
    
                    <div class="events-container">
                        <div class="events">
                            <div style="display: flex" class="li-container news-block boxes out-<?php echo get_the_date( 'Y' ); ?>">
                                
                                <div class="image">
                                    <img src="<?=$thumbanil;?>">
                                </div>
                                <div class="info">
                                    <h4 class="title"><a href="<?php the_permalink();?>" ><?php the_title();?></a></h4>
                                    <div class="date"><?php echo get_the_date( 'd F Y' ); ?></div>
                                    <p><?php the_excerpt(); ?></p>
        		    				<a href="<?php echo get_the_permalink();?>" class="btn btn-primary">Read More<i class="la la-arrow-right"></i></a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
    
            <div class="paginate_links">
                    <?php
                $big = 999999999; // need an unlikely integer
    
                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $promotion_articles->max_num_pages,
                    'prev_text'          => __( '<' ),
                    'next_text'          => __( '>' ),
                ) );
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<script>
    jQuery('.childcon > div > div > li').css('color', 'transparent');
    jQuery('.childcon > div > div > li').css('transform', 'translateY(-10px)');
    jQuery('.childcon.hidden').hide();
    jQuery('#side-categories .parentt').click(function(){
	    jQuery('#side-categories .childcon').toggle();
	    jQuery('#side-categories .childcon').removeClass('hidden');
        
    });
    
    jQuery('.archives .year').hide();
    jQuery('.archives .parentt').click(function(){
	    jQuery('.archives .year').toggle();
        
    });
    jQuery('.current-cat').parent().parent().parent().show();
    jQuery('.current-cat').css('font-weight', '600');
    // 
</script>
<style>
    .parentt {
	    background: #88AED0;
	    cursor: pointer;
        color: white;
        padding: 8px 15px;
        /*margin-bottom: 10px;*/
        display: flex;
        justify-content: space-between;
    }
</style>

<?php get_footer(); ?>