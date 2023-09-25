<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<div id="main-content" class="">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( ! $is_page_builder_used ) : ?>

    <?php
        $thumb = '';

        $width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

        $height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
        $classtext = 'et_featured_image';
        $titletext = get_the_title();
        $alttext = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
        $thumbnail = get_thumbnail( $width, $height, $classtext, $alttext, $titletext, false, 'Blogimage' );
        $thumb = $thumbnail["thumb"];

        if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
            print_thumbnail( $thumb, $thumbnail["use_timthumb"], $alttext, $width, $height );
    ?>

    <?php endif; ?>

        <div class="entry-content">
            <?php
                the_content();

                if ( ! $is_page_builder_used )
                    wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
            ?>

            <div class="home-box">
                <div class="slideshow">
                    <?php $sliders = get_field('slider_repeater'); 
                        foreach($sliders as $slider): 
                    ?>
                    <div class="slideshow-inner">
                        <div class="description">
                            <div class="title" style="text-shadow: 2px 2px black" data-speed="0.8"><?php echo html_entity_decode($slider['banner_title']); ?></div>
                            <div class="desc" data-speed="0.8" style="text-shadow: 2px 2px black" ><?php echo html_entity_decode($slider['banner_description']); ?></div>
                        </div>
                        <?php if($slider['image_video'] == "Image"): ?>
                            <?php if($slider['image']): ?>
                                <img data-speed="0.2" src="<?php echo $slider['image']; ?>" alt="image" class="desktop">
                            <?php endif ?>
                            <?php if($slider['mobile_image']): ?>
                                <img src="<?php echo $slider['mobile_image']; ?>" alt="image" class="mobile">
                            <?php endif ?>
                        <?php else: ?>
                            <?php if($slider['video']): ?>
                                <div class="video" >
                                    <video autoplay muted="true" id="wideo" width="" height="" class="vid_no_margin">    
                                        <source src="<?php echo $slider['video']; ?>" type="video/mp4" />    
                                    </video>    
                                    <style>    
                                        .vid_no_margin{    
                                            margin: -10px 0;    
                                        }    
                                    </style> 

                                    <!--<script>-->
                                    <!--    var aud = document.getElementById("wideo");-->
                                    <!--    aud.onended = function() {-->
                                    <!--      aud.style.opacity = '0';-->
                                    <!--    };-->
                                    <!--</script>-->
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div> <!-- .entry-content -->

    <?php
        if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
    ?>

    </article> <!-- .et_pb_post -->

<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->
<script>
	if(navigator.userAgent.match(/Trident\/7\./)) {
		document.body.addEventListener("mousewheel", function() {
			event.preventDefault();
			var wd = event.wheelDelta;
			var csp = window.pageYOffset;
			window.scrollTo(0, csp - wd);
		});
	}

	jQuery(window).on('load', function(){
		
		AOS.init({
			duration: 1000
		});
	});	

	jQuery(".animate-up").attr('data-aos', 'fade-up');
</script>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script type="text/javascript">
  function initSlick() {
    jQuery('.slideshow').slick({
      dots: false,
      infinite: true,
      speed: 500,
      arrows: false,
      pauseOnHover: false,
      autoplay: false,
      slidesToShow: 1,
		prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><img src='wp-content/themes/Divi-child/img/slicings/general/left1.png'/></div></div>",
		nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><img src='wp-content/themes/Divi-child/img/slicings/general/right1.png'/></div></div>",

    });
  }
  initSlick();
</script>

<?php

get_footer();
