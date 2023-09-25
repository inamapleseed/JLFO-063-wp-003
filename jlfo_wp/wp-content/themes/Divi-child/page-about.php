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

                        <div class="about-box">
                            <div class="le-tabs">
                                <div class="le-tab" data-target="#sec2"><?php echo get_field('title_2'); ?></div>
                                <div class="le-tab" data-target="#team-con"><?php echo get_field('title_3'); ?></div>
                                <div class="le-tab" data-target="#partners"><?php echo get_field('partners_title'); ?></div>
                                <div class="le-tab" data-target="#timeline"><?php echo get_field('title5'); ?></div>
                            </div>

                            <div id="sec1" class="sec1 animate-up" style="background: <?php echo get_field('background_colora'); ?>">
                                <div class="images">
                                    <img src="<?php echo get_field('image_1'); ?>" alt="image">
                                    <img src="<?php echo get_field('image_2'); ?>" alt="image">
                                </div>

                                <div class="texts">
                                    <h2><?php echo get_field('title'); ?></h2>
                                    <p><?php echo get_field('description'); ?></p>
                                    <div class="boxes">
                                        <div class="b1 bb" style="background: <?php echo get_field('background_color_1'); ?>">
                                            <h5><?php echo get_field('text_1'); ?></h5>
                                            <h3><?php echo get_field('count_1'); ?></h3>
                                            <div></div>
                                            <h5><?php echo get_field('text_1b'); ?></h5>
                                            <h3><?php echo get_field('count_1b'); ?></h3>
                                        </div>
                                        <div class="b2 bb" style="background: <?php echo get_field('background_color_2'); ?>">
                                            <h5><?php echo get_field('text_2'); ?></h5>
                                            <h3><?php echo get_field('count_2'); ?></h3>
                                            <div></div>
                                            <h5><?php echo get_field('text_2b'); ?></h5>
                                            <h3 <?php echo strlen(get_field('count_2b')) > 5 ? 'style="font-size: calc(24px + (29 - 24) * (100vw - 320px) / (1920 - 320))"' : ''; ?>><?php echo get_field('count_2b'); ?></h3>
                                        </div>
                                        <style>
                                            .b2.bb::before {
                                                background: <?php echo get_field('background_color_2'); ?>;
                                            }
                                        </style>
                                    </div>
                                </div>
                                <div class="vertical"></div>
                            </div>
                            <!--  -->
                            <div id="sec2" class="sec2 animate-up">
                                <h2 class="text-center vert-d"><?php echo get_field('title_2'); ?></h2>
                                <div class="sdesc"><?php echo get_field('description_2'); ?></div>

                                <div class="outer" style="background-repeat: no-repeat; background: url('<?php echo get_field('background2'); ?>'); ">
                                    <div class="inner-cont">
                                        <?php $re1 = get_field('repeater_zi');
                                            foreach ($re1 as $r1):
                                        ?>
                                            <div class="inner">
                                                <img src="<?php echo $r1['icon']; ?>" alt="image">
                                                <?php echo $r1['title_icon']; ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="vertical"></div>
                            </div>
                            
                            <!--  -->
                            <div id="team-con" class="team-con animate-up" style="background: url('<?php echo get_field('background3'); ?>);">
                                <h2 class="vert-d text-center"><?php echo get_field('title_3'); ?></h2>
                                <p class="sdesc"><?php echo get_field('description3'); ?></p>

                                <h3 class="t-title"><?php echo get_field('management_title'); ?></h3>

                                <div class="mgt">
                                    <?php $re2 = get_field('management_team_repeater');
                                        foreach ($re2 as $i => $r2):
                                    ?>
                                        <div class="mgt-outer">
                                            <div class="img-box">
                                                <img src="<?php echo $r2['image_m']; ?>" alt="image">
                                                <div class="overlay">
                                                    <button data-toggle="modal" class="toggle-btn" data-target="#con<?php echo $i; ?>">Read More</button>
                                                </div>
                                            </div>
                                            <h3 class="namae"><?php echo $r2['name_m']; ?></h3>
                                            <?php if($r2['position_rep']): ?>
                                                <?php foreach($r2['position_rep'] as $pr): ?>
                                                    <h4 class="post"><?php echo $pr['position']; ?></h4>
                                                <?php endforeach?>
                                            <?php endif?>
                                            

                                        </div>
                                    <?php endforeach ?>
                                </div>

                                <h3 class="t-title"><?php echo get_field('team_title'); ?></h3>

                                <div class="teams">
                                    <?php $re3 = get_field('team_repeater');
                                        foreach ($re3 as $r3):
                                    ?>
                                        <div class="teammate">
                                            <img src="<?php echo $r3['image_t']; ?>" alt="image">
                                            <h3 class="namae"><?php echo $r3['name_t']; ?></h3>
                                            <h4 class="post"><?php echo $r3['position_t']; ?></h4>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="vertical"></div>
                            </div>
                            
                            <!--  -->
                            <div class="partners-con animate-up" id="partners">
                                <div class="vertical" style="border-color: #88AED0"></div>
                                <h2 class="vert-d text-center"><?php echo get_field('partners_title'); ?></h2>
                                <div class="sdesc"><?php echo get_field('description_partners'); ?></div>

                                <div class="content">
                                    <?php $reps = get_field('partners_repeater'); if($reps): foreach($reps as $repp): ?>
                                        <div class="partner">
                                            <div class="img-conn">
                                                <img src="<?php echo $repp['logo_p']; ?>" alt="image">
                                            </div>
                                            <h3><?php echo $repp['logo_title']; ?></h3>
                                            <div class="texts">
                                                <?php echo html_entity_decode($repp['description']); ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                                
                            </div>
                            
                            <!--  -->
                            <div class="timeline" id="timeline">
                                <h2 class="vert-d text-center"><?php echo get_field('title5'); ?></h2>
                                <p class="sdesc"><?php echo get_field('description5'); ?></p>

                                <div class="timeline-slider">
                                    <?php $time = get_field('repeatera');
                                        foreach ($time as $i => $t):
                                    ?>
                                        <div class="mgt-outer <?php echo $i % 2 ? 'even' : 'odd'; ?>">
                                            <div class="inner-slider up arr<?php echo count($t['content']); ?>">
                                                    <?php foreach($t['content'] as $c): ?>
                                                        <div>
                                                            <div class="image-con">
                                                                <img src="<?php echo $c['logo']; ?>" alt="image">
                                                            </div>
                                                            <p><?php echo $c['description_c']; ?></p>
                                                        </div>
                                                    <?php endforeach ?>
                                            </div>

                                            <div class="stem up"></div>
                                            <h3 style="box-shadow: 1px 0 0 #365649"><?php echo $t['year']; ?></h3>
                                            <div class="stem down"></div>

                                            <div class="inner-slider down arr<?php echo count($t['content']); ?>">
                                                <?php foreach($t['content'] as $c): ?>
                                                    <div>
                                                        <p><?php echo $c['description_c']; ?></p>
                                                        <div class="image-con">
                                                            <img src="<?php echo $c['logo']; ?>" alt="image">
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

					</div> <!-- .entry-content -->
					<div class="to-top">
					    <img src="../wp-content/themes/Divi-child/img/to-top.png" alt="image" />
					</div>
                <script>
                     jQuery(".le-tab").on('click', function(){
                        let winWidth = jQuery('window').width();
                        let target = jQuery(this).data('target');
                        if(winWidth > 767) {
                            jQuery('html, body').animate({scrollTop: jQuery(target).offset().top - 180}, 'slow');
                        } else {
                            jQuery('html, body').animate({scrollTop: jQuery(target).offset().top - 110}, 'slow');
                        }
                    });
                	jQuery(window).scroll(function () {
                		if (jQuery(this).scrollTop() > 200) {
                			jQuery('.to-top').addClass('visible');
                		}
                	});
                		
                    jQuery(".to-top").click(function() {
                        jQuery('html,body').animate({
                            scrollTop: jQuery("#et-main-area").offset().top},
                            'slow');
                    });

                </script>

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
  function initSlickss() {
    jQuery('.teams').slick({
      dots: false,
      infinite: true,
      speed: 500,
      arrows: true,
      pauseOnHover: false,
      autoplay: false,
      slidesToShow: 4,
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
          slidesToShow: 3
        }
       },
        {
        breakpoint: 767,
        settings: {
	      arrows: false,
	      autoplay: true,
          slidesToShow: 2
        }
      },
      ],
		prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/prev.png' alt='arrow'></div></div>",
		nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/next.png' alt='arrow'></div></div>",

    });
  }
  initSlickss();
</script>

<script type="text/javascript">
  function initTimeline() {
    jQuery('.timeline-slider').slick({
      dots: false,
      infinite: false,
      speed: 500,
      arrows: true,
      pauseOnHover: false,
      autoplay: false,
      slidesToShow: 5,
      responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4
        }
      },
      {
        breakpoint: 990,
        settings: {
	      autoplay: true,
          slidesToShow: 3,
            autoplaySpeed: 5000,
        }
       },
        {
        breakpoint: 767,
        settings: {
	      arrows: false,
	      autoplay: true,
          slidesToShow: 2,
        autoplaySpeed: 5000,
        }
      },
      ],
		prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/prev.png' alt='arrow'></div></div>",
		nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/next.png' alt='arrow'></div></div>",

    });
  }
  initTimeline();
</script>

<script type="text/javascript">
  function innerSlick() {
    jQuery('.inner-slider').slick({
      dots: true,
      infinite: true,
      speed: 500,
      arrows: true,
      pauseOnHover: false,
      autoplay: false,
      slidesToShow: 1,
        prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/prev.png' alt='arrow'></div></div>",
        nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><img src='../wp-content/themes/Divi-child/img/slicing/next.png' alt='arrow'></div></div>",

    });
  }
  innerSlick();
</script>

<div class="mgt-sup mgt" style="opacity: 0">
    <?php $re2 = get_field('management_team_repeater');
        foreach ($re2 as $i => $r2):
    ?>
        <div class="mgt-outer">
            <div class="modal fade" id="con<?php echo $i; ?>" >
                <div class="modal-content">
                    <div class="close-btn">&times;</div>

                    <div class="modal-body">
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo $r2['image_m2'] ? $r2['image_m2'] : $r2['image_m']; ?>" alt="image">
                            </div>

                            <div class="texts">
                                <h3 class="namae"><?php echo $r2['name_m']; ?></h3>
                                <h4 class="post"><?php echo nl2br($r2['position_m']); ?></h4>
                                <p><?php echo nl2br($r2['story_m']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    <?php endforeach ?>
</div>

<script>
    jQuery('.modal').hide();
    jQuery('.toggle-btn').click(function(){
        let target = jQuery(this).data('target');
        jQuery(target).show();
        jQuery('.mgt-sup.mgt').css('opacity', '1');
    })
    jQuery('.close-btn').click(function(){
        jQuery(this).parent().parent().hide();
    })
</script>

<?php

get_footer();