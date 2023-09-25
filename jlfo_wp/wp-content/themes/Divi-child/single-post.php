<?php get_header(); ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="single_news">
	<?php echo do_shortcode('[et_pb_section global_module="411"][/et_pb_section]'); ?>
		<div class="container">

			<div class="single_news_10">
			    <?php if(get_field('article_image')): ?>
    				<div class="img-container" style="background-image: url('<?= get_field('article_image');?>');" ></div>
                <?php endif ?>

				<div class="text-container">
					<h4 class="fs36"><?php the_title(); ?></h4>
					<div class="date"><?php echo get_the_date( 'd M Y' ); ?></div>
					<div class="content-container">
    					<?//php the_content(); ?>
    					<?php echo get_field('artdescription'); ?>
					</div>
					
					<?php if(get_field('pdf22')):?>
    					<?php foreach(get_field('pdf22') as $pdf):?>
        					<div style="display: flex; align-items: center">
        					    <img style="max-width: 30px" src="../wp-content/uploads/2021/12/icons8-pdf-48.png" alt="pdf" /><a href="<?php echo $pdf['pdf']; ?>" download><?php echo $pdf['titlepdf']; ?></a>
        					</div>
    					<?php endforeach?>
					<?php endif?>
					
					<div class="btn-container">
						<div class="share-container">
							<span>Share</span>
							<div class="addthis_inline_share_toolbox"></div>
							<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5fd98f1872ad1fd5"></script>
						</div>

						<div class="clearfix"></div>
					</div>

				</div>


                <div class="review-container">
                <?php
						if ( ( comments_open() || get_comments_number() ) && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) ) {
							comments_template( '', true );
						}
					?>
                </div>
               
				
			</div>
		</div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    
<style>
    @media (min-width: 768px) {
        .single_news > .container > div {
            width: 80%;
            margin: auto;
        }
        .img-container {
            width: 40%;
             padding-bottom: 24%;   
        }
    }
    @media (max-width: 767px) {
        /*.single_news > .container > div {*/
        /*    width: 80%;*/
        /*    margin: auto;*/
        /*}*/
        .img-container {
            width: 100%;
             padding-bottom: 60%;   
        }
    }
</style>

<?php get_footer(); ?>