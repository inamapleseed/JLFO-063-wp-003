<?php
/***************************************************************************************/
/* Customized functions below */
function enqueue_parent_styles() {
    // wp_enqueue_style( 'slick-style', get_stylesheet_directory_uri().'/library/slick/slick.css' );
    // wp_enqueue_style( 'slick-theme-style', get_stylesheet_directory_uri().'/library/slick/slick-theme.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'layouts', get_stylesheet_directory_uri().'/css/layouts.css' );
    wp_enqueue_style( 'responsive', get_stylesheet_directory_uri().'/css/responsive.css' );
    wp_enqueue_style( 'mystylesheet', get_stylesheet_directory_uri().'/css/mystylesheet.css' );
    wp_enqueue_style( 'aos-css', get_stylesheet_directory_uri().'/vendors/aos/aos.css');

}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function custom_scripts_and_styles() {
    $path = get_stylesheet_directory_uri();
	
    // Custom Script
    wp_enqueue_script( 'script', $path.'/main.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'aos', $path.'/vendors/aos/aos.js', array( 'jquery' ), false, true );
    // wp_enqueue_script( 'slick', $path.'/library/slick/slick.min.js');

}
add_action( 'wp_enqueue_scripts', 'custom_scripts_and_styles', 20 );

// [get_layout layout="home_categories"]
function include_layouts( $args ) {
    $path    = get_stylesheet_directory_uri();
    $layout  = isset($args['layout'])? 'layouts/'.$args['layout'].'.php' : '';
    // $post_id = isset($args['post_id'])? $args['post_id'] : get_the_ID();
    // $post_type = isset($args['post_type'])? $args['post_type'] : '';
    // $field = isset($args['field'])? $args['field'] : '';
    $check_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . "{$layout}";

    ob_start();
    if(!empty($layout) && file_exists($check_file)){
        include $layout;
    }else{
        echo '<strong>Invalid Layout!</strong>';
    }
    return ob_get_clean();   
}

add_shortcode( 'get_layout', 'include_layouts' );


function register_my_menus() {
    register_nav_menus(
    array(
     'footer-2' => __( 'Footer 2' )
     )
     );
}
add_action( 'init', 'register_my_menus' );

if(function_exists('acf_add_options_page')) {
    acf_add_options_page();
    //acf_add_options_sub_page('Header & Footer');
    //acf_add_options_sub_page('Others');
}

function add_category_to_single($classes) {
    if (is_single() ) {
        global $post;
        foreach((get_the_category($post->ID)) as $category) {
            // add category slug to the $classes array
            $classes[] = $category->category_nicename;
        }
    }
    // return the $classes array
    return $classes;
}

add_filter('body_class','add_category_to_single');

function set_category_widget_parameters($args) {
    $args['exclude'] = '6';
    return $args;
}
add_filter('widget_categories_args','set_category_widget_parameters');

//Page Slug Body Class
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

function body_class_section($classes) {
    global $wpdb, $post;
    if (is_page()) {
        if ($post->post_parent) {
            $parent  = end(get_post_ancestors($current_page_id));
        } else {
            $parent = $post->ID;
        }
        $post_data = get_post($parent, ARRAY_A);
        $classes[] = $post_data['post_name'];
    }
    return $classes;
}
add_filter('body_class','body_class_section');

// function sb_et_builder_post_types( $post_types ) {
//    $post_types[] = 'food';

//    return $post_types;
// }
// add_filter( 'et_builder_post_types', 'sb_et_builder_post_types' );

function sb_et_pb_show_all_layouts_built_for_post_type() {
    return 'page';
}
add_filter( 'et_pb_show_all_layouts_built_for_post_type', 'sb_et_pb_show_all_layouts_built_for_post_type' );

function debug( $x ){
    echo '<pre>';
    var_dump($x);
    echo '</pre>';
}

if( !function_exists( 'plugin_prefix_unregister_post_type' ) ) {
    function plugin_prefix_unregister_post_type(){
        unregister_post_type( 'project' );
    }
}
add_action('init','plugin_prefix_unregister_post_type');

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

    if (empty($pagerange)) {
        $pagerange = 2;
    }

    /**
     * This first part of our function is a fallback
     * for custom pagination inside a regular loop that
     * uses the global $paged and global $wp_query variables.
     *
     * It's good because we can now override default pagination
     * in our theme, and use this function in default quries
     * and custom queries.
     */
    // global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    
    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if(!$numpages) {
            $numpages = 1;
        }
    }

    /**
     * We construct the pagination arguments to enter into our paginate_links
     * function.
     */
    //debug(parse_url(get_pagenum_link(1)));
    $url_parts = parse_url(get_pagenum_link(1));

    $pagination_args = array(
        // 'base'            => get_pagenum_link(1) . '%_%',
          'base'            => strtok($_SERVER["REQUEST_URI"], '?') . '%_%',
        // 'format'          => $url_parts['query'] != '' ? '&paged=%#%' : 'page/%#%',
        'format'          => '?pg=%#%',
        'total'           => $numpages,
        'current'         => $paged,
        'show_all'        => False,
        'end_size'        => 1,
        'mid_size'        => $pagerange,
        'prev_next'       => True,
        'prev_text'       => __('<i class="arrow"><</i>'),
        'next_text'       => __('<i class="arrow">></i>'),
        'type'            => 'plain',
        'add_args'        => false,
        'add_fragment'    => ''
    );


    
    $paginate_links = paginate_links($pagination_args);
    $result = '';
    if ($paginate_links) {
        $result .= "<nav class='custom-pagination'>";
        //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
        $result .= $paginate_links;
        $result .= "</nav>";
    }

    return $result;
}



?>
