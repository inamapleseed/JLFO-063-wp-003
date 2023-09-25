<?php /* Template Name: Articles Template */

get_header();

$page_id = 700;

?>

<?php if(get_field('banner_imagee', $page_id)){?>
	<div class="page-banner">
		<img src="<?php echo get_field('banner_imagee', $page_id);?>" class="img-responsive visible-xs" alt="<?php echo get_the_title();?>">
	</div>
<?php } ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="single_news">
	<?php echo do_shortcode('[et_pb_section global_module="411"][/et_pb_section]'); ?>
		<div class="container">

			<div class="">
				 <!--<div class="img-container" style="background-image: url('');" ></div> -->
				<div class="text-container">
				    <?php if(get_field('article_image')): ?>
                        <img class="img-hlf" style="margin: auto auto 20px; width: auto;" src="<?php echo get_field('article_image'); ?>" alt="image"/>
                        <style>
                            @media (min-width: 768px) {
                                .img-hlf {
                                    max-width: 50%;   
                                }
                            }
                        </style>
                    <?php endif ?>
					<h4 class="fs36"><?php the_title(); ?></h4>
					<div class="date"><?php echo get_the_date( 'd F Y' ); ?></div>
					<div class="content-container">
    					<?php the_content(); ?>
    					<?php echo get_field('artdescription'); ?>
					</div>
					
					<?php $pf = get_field('pdf22'); if($pf): ?>
    					<div class="pdf" style="margin-top: 20px">
    					    <?php foreach($pf as $pdf): ?>
        					    <?php if($pdf['pdf']): ?>
            					    <div style="display: flex; flex-wrap: wrap; align-items: center">
            					        <img style="max-width: 30px; " src="../../../../../demo-jlfo/wp-content/uploads/2021/12/icons8-pdf-48.png" alt="pdf"/><a target="_blank" href="<?php echo $pdf['pdf']; ?>"><?php echo $pdf['titlepdf']; ?></a>
            					        <!--<embed src="<?php echo $pdf['pdf']; ?>#toolbar=0" type="application/pdf"></a>-->
            					    </div>
            					<?php endif?>
    					    <?php endforeach?>
    					</div>
    				<?php endif ?>
					
					<div class="btn-container">
						<div class="share-container" style="display: flex !important; flex-wrap: wrap; align-items: center; ">
							<span>Share</span><div><?php echo do_shortcode('[Sassy_Social_Share]');?></div>
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


<?php get_footer(); ?>