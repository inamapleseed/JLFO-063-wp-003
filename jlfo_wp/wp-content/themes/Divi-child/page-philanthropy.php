<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content" class="philanthropy">

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

                        <div class="philanthropy-box">
                            <div>
                                <h2 style="padding: 0"><?php echo get_field('page_title'); ?></h2>
                                <p class="description"><?php echo get_field('page_description'); ?></p>

                                <?php if(get_field('icon_logo')): ?>
                                    <div class="logo">
                                        <a target="_blank" href="<?php echo get_field('icon_url'); ?>">
                                            <img src="<?php echo get_field('icon_logo'); ?>" alt="img">
                                        </a>
                                    </div>
                                <?php endif ?>

                                <?php $rep = get_field('icon_text_repeater'); 
                                    if($rep): ?>
                                    <div class="icons">
                                        <?php foreach($rep as $re): ?>
                                            <div class="icon-rep" style="background: <?php echo get_field('background_color'); ?>">
                                                <img src="<?php echo $re['icon_1']; ?>" alt="<?php echo $re['title_1']; ?>">
                                                <p><?php echo $re['title_1']; ?></p>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>
                            </div>

                            <div class="section-2">
                                <h2><?php echo get_field('title_2'); ?></h2>
                                <p class="description"><?php echo get_field('description_2'); ?></p>


                                <?php $rep2 = get_field('content'); 
                                    if($rep2): ?>
                                        <div class="content">
                                            <?php foreach($rep2 as $re2): ?>
                                                <div class="content-rep" style="background: <?php echo get_field('background_color'); ?>">
                                                    <img src="<?php echo $re2['image3']; ?>" alt="<?php echo $re2['title3']; ?>">

                                                    <div class="texts">
                                                        <h4><a <?php echo $re2['url2'] ? 'href="'.$re2['url2'].'"' : ''; ?> target="_blank" ><?php echo $re2['title3']; ?></a></h4>

                                                        <?php foreach($re2['description_32'] as $rr):?>
                                                            <li><?php echo nl2br($rr['desc22']); ?></li>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                <?php endif ?>
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
	jQuery(".right-con").attr('data-aos', 'fade-left');
</script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
  function initSlick() {
    jQuery('.content').slick({
      dots: false,
      infinite: true,
      speed: 500,
      arrows: true,
      pauseOnHover: false,
      autoplay: false,
      slidesToShow: 3,
      responsive: [
      {
        breakpoint: 1023,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 990,
        settings: {
	      arrows: false,
	      autoplay: true,
          slidesToShow: 2
        }
       },
        {
        breakpoint: 767,
        settings: {
	      arrows: false,
	      autoplay: true,
          slidesToShow: 1
        }
      },
      ],
		prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/prev.png' alt='arrow'></div></div>",
		nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/next.png' alt='arrow'></div></div>",

    });
  }
  initSlick();
</script>

<?php

get_footer();
