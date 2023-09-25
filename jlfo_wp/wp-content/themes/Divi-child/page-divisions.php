<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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

                        <div class="divisions-box">
                            <h2 class="text-center animate-up"><?php echo get_field('title');?></h2>
                            <p class="description"><?php echo get_field('description');?></p>

                            <?php $repeater = get_field('repeater'); ?>

                            <?php if($repeater): ?>
                                <div class="icon-div">
                                    <?php foreach($repeater as $i => $re): ?>
                                        <div class="animate-up">
                                            <a style="cursor: pointer;" class="sec_<?php echo $i+1; ?> <?php echo $re['link'] ? '' : 'navig'; ?>" data-target="#sec_<?php echo $i+1; ?>" <?php echo $re['link'] ? 'href="'.$re['link'].'"' : ''; ?> >
                                            <h5 style="text-align: center; cursor: pointer"><?php echo $re['icon_title22']; ?></h5>
                                            <img src="<?php echo $re['icon'];?>" alt="image"></a>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                            
                            <div id="sec_1" style="background: <?php echo get_field('background_color');?>" class="sec-1">
                                <div class="image animate-up">
                                    <img src="<?php echo get_field('main_image');?>" alt="image">
                                </div>

                                <div class="text animate-up" style="background: <?php echo get_field('background_color');?>" >
                                    <h2 style="color: <?php echo get_field('text_color');?>"><?php echo get_field('title_1');?></h2>

                                    <p style="color: <?php echo get_field('text_color');?>">
                                        <?php echo nl2br(get_field('description_1'));?>
                                    </p>
                                    <img style="background: #ececec" src="<?php echo get_field('icon1');?>" alt="image">
                                </div>r
								<div class="design"></div>
                            </div>
                            <!--  -->
                            <div id="" class="sec-2  animate-up">
                                <h2 class="text-center animate-up"><?php echo get_field('title_2');?></h2>

                                <div class="ferris-wrapper">
                                    <span class="ferri-base">
                                        <img src="<?php echo get_field('base_image');?>" alt="iamge">
                                    </span>
                                    <div class="wheel-wrapper">
                                        <div class="wheel">
                                            <img style="width: auto; margin: auto" src="<?php echo get_field('designframe');?>" alt="iamge">
                                            <?php $repeater2 = get_field('repeater2');  foreach($repeater2 as $re2): ?>
                                                <div class="cabin ">
                                                    <img src="<?php echo $re2['logo'];?>" alt="iamge">
                                                    <ul style="list-style-position: outside;  padding-top: 3px"><li><?php echo $re2['descriptionf'];?></li></ul>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
							<div id="" class="sec-3 <?php $repeater3 = get_field('repeater3'); $repeater3 ? '' : 'hidden'; ?>">
								<h2 class="text-center  animate-up"><?php echo get_field('title_3');?></h2>

								<div class="slider-3 animate-up">
									<?php foreach($repeater3 as $re3): ?>
										<div>
											<img src="<?php echo $re3['image3'];?>" alt="image">
											<h3><?php echo $re3['title3'];?></h3>
											<?php foreach($re3['description3'] as $text): ?>
												<li class="<?php $text['text'] ? '' : 'hidden'; ?>"><?php echo $text['text'];?></li>
											<?php endforeach ?>
										</div>
									<?php endforeach ?>
								</div>
							</div>
                            
                            <!--  -->
							<div id="sec_2" class="sec-4 <?php $repeater_4 = get_field('repeater_4'); echo $repeater_4 ? '' : 'hidden'; ?>">
								<?php $repeater_4 = get_field('repeater_4'); 
									foreach($repeater_4 as $i => $re4): 
								?>
									<div <?php echo $i == 1 ? 'id="sec_3"' : ''; ?> class=" animate-up s4-color <?php echo $i % 2 ? 'even' : 'odd'; ?>" style="background: <?php echo $re4['background_color4'];?>">
										<div class="texts" style="background: <?php echo $re4['background_color4'];?>">
											<h2 style="color: <?php echo $re4['textcolor'];?>"><?php echo $re4['title4'];?></h2>

											<p style="color: <?php echo $re4['textcolor'];?>"><?php echo $re4['description4'];?></p>
											<img class="<?php echo $re4['logo4b'] ? '' : 'hidden';?>" src="<?php echo $re4['logo4b'];?>" alt="logo">
										</div>

										<div class="image">
											<img src="<?php echo $re4['image4'];?>" alt="image">
										</div>
										<div class="design"></div>
									</div>
									
									<div class="s4-slider animate-up">
										<h2 class="text-center"><?php echo $re4['title4a'];?></h2>
										<div class="s4-slider<?php echo $i; ?>">
											<?php foreach($re4['repeater_featured'] as $re4): ?>
												<div>
													<div class="image-box"><img src="<?php echo $re4['image4a'];?>" alt="image"></div>

													<div class="text-box">
														<h3><a <?php echo $re4['url'] ? 'href="'.$re4['url'].'"' : ''; ?> target="_blank" ><?php echo $re4['title4b'];?></a></h3>

														<?php if($re4['description4b']): ?>
															<ul>
																<?php foreach($re4['description4b'] as $txt): ?>
																	<li><?php echo $txt['text4'];?></li>
																<?php endforeach ?>
															</ul>
														<?php endif ?>
													</div>
												</div>
											<?php endforeach ?>
										</div>
									</div>

									<script type="text/javascript">
										function initSlick<?php echo $i; ?>() {
										jQuery('.s4-slider<?php echo $i; ?>').slick({
										dots: false,
										infinite: true,
										speed: 500,
										arrows: true,
										pauseOnHover: false,
										autoplay: false,
										slidesToShow: 2,
										responsive: [
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
									initSlick<?php echo $i; ?>();
									</script>
								<?php endforeach ?>
							</div>
                        </div>
					</div> <!-- .entry-content -->

					<div class="to-top">
					    <img src="../wp-content/themes/Divi-child/img/to-top.png" alt="image" />
					</div>
				<script>
                     jQuery(".navig").on('click', function(){
                        let winWidth = jQuery(window).width();
                        let target = jQuery(this).data('target');
                        if(winWidth > 767) {
                            jQuery('html, body').animate({scrollTop: jQuery(target).offset().top - 100}, 'slow');
                        } else {
                            jQuery('html, body').animate({scrollTop: jQuery(target).offset().top - 110}, 'slow');
                        }
                    });
                     jQuery(".navig.sec_3").on('click', function(){
                        let winWidth = jQuery(window).width();
                        // let target = jQuery(this).data('target');
                        if(winWidth > 767) {
                            jQuery('html, body').animate({scrollTop: jQuery('#sec_3').offset().top - 220}, 'slow');
                        } else {
                            // jQuery('html, body').animate({scrollTop: jQuery('#sec_3').offset().top - 110}, 'slow');
                        }
                    });
                	jQuery(window).scroll(function () {
                		if (jQuery(this).scrollTop() > 200) {
                			jQuery('.to-top').addClass('visible');
                		}
                	});
        	
        			jQuery('.to-top').click(function(){
                        jQuery('html, body').animate({scrollTop: jQuery('#et-main-area').offset().top});
        			})
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
	jQuery(".animate-down").attr('data-aos', 'fade-down');
</script>
<script type="text/javascript">
  function initSlick() {
    jQuery('.slider-3').slick({
      dots: false,
      infinite: true,
      speed: 500,
      arrows: true,
      pauseOnHover: false,
      autoplay: false,
      slidesToShow: 2,
      responsive: [
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
<style>
    /* Variables */
 @keyframes ferri-wheel {
	 0% {
		 transform: rotate(0deg);
	}
	 100% {
		 transform: rotate(360deg);
	}
}
 @keyframes cabin {
	 0% {
		 transform: rotate(0deg);
	}
	 100% {
		 transform: rotate(-360deg);
	}
}
/* Layout */
 .ferris-wrapper {
	 position: relative;
	 width: 44rem;
     overflow: hidden;
	 height: 32rem;
	 margin: 40px auto calc(30px + (65 - 30) * (100vw - 320px) / (1920 - 320));
     padding-top: 40px;
}
 .ferris-wrapper:hover {
	/* Pause animation on Hover */
}
 .ferris-wrapper:hover .wheel, .ferris-wrapper:hover .cabin {
	 animation-play-state: paused;
}
 .ferri-base {
	 position: absolute;
	 width: 100%;
	 height: 19rem;
	 z-index: 9;
	 bottom: 0;
	 left: 0;
}

 .wheel-wrapper {
	 width: 27rem;
	 height: 27rem;
	 position: absolute;
	 left: 50%;
	 top: 50%;
	 transform: translate3d(-50%, -50%, 0);
	 z-index: 3;
}
 .wheel {
	 position: absolute;
	 left: 0;
	 top: 0;
	 right: 0;
	 bottom: 0;
	 border-radius: 50%;
	 /*animation: ferri-wheel 15s linear infinite;*/
}
.wheel > img {
    animation: ferri-wheel 15s linear infinite;
}
/* Cabin */
 .cabin {
	 width: 180px;
	 position: absolute;
	 background-color: #fff;
	 /*animation: cabin 15s linear infinite;*/
}
 .cabin:nth-of-type(1) {
    left: -16.5%;
    top: 40%;
}
 .cabin:nth-of-type(2) {
    right: 24%;
    top: -6.5%;
}
 .cabin:nth-of-type(3) {
    right: -23.5%;
    top: 40%;
}
 .cabin:nth-of-type(4) {
	 left: 30%;
	 top: -3%;
}
 .cabin:nth-of-type(5) {
	 left: 17%;
	 top: 7%;
}
 .cabin:nth-of-type(6) {
	 right: 17%;
	 top: 7%;
}
 .line {
	 position: absolute;
	 width: 50%;
	 height: 0.1rem;
	 left: 50%;
	 top: 50%;
	 background-color: #4d4d4d;
	 transform-origin: 0% 0%;
}
 .line:nth-of-type(2) {
	 transform: rotate(60deg);
}
 .line:nth-of-type(3) {
	 transform: rotate(120deg);
}
 .line:nth-of-type(4) {
	 transform: rotate(180deg);
}
 .line:nth-of-type(5) {
	 transform: rotate(240deg);
}
 .line:nth-of-type(6) {
	 transform: rotate(300deg);
}
 
</style>
<?php

get_footer();
