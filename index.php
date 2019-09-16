<?php

get_header(); ?>

<!-- Carousel slides -->
<div class="clearfix">
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner">
                <div class="carousel-item active bgcarousel-page"
                    style="background-image: url(<?php echo get_template_directory_uri() ?>/images/slides/1.jpg); width: 100%;">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row" style="height: 350px">
                            <div class="col 12" style="top:50%">
                                <div class="caption_carousel-page">
                                    <h1 class="animated bounceInDown">
										<?php

										if ( is_category() ) {
											single_cat_title();
										} elseif ( is_tag() ) {
											single_tag_title();
										} elseif ( is_author() ) {
											the_post();
											echo 'Author Archives: ' . get_the_author();
											rewind_posts();
										} elseif ( is_day() ) {
											echo 'Daily Archives: ' . get_the_date();
										} elseif ( is_month() ) {
											echo 'Monthly Archives: ' . get_the_date('F Y');
										} elseif ( is_year() ) {
											echo 'Yearly Archives: ' . get_the_date('Y');
										} else {
											echo 'Blog';
										}

										?>
									</h1>
                                    <p class="animated bounceInDown">
									<?php	
										if ( is_category() ) {
											echo category_description();
										} 
										?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-shadow"><img src="<?php echo get_template_directory_uri() ?>/images/banner-shadow.png" alt="Banner Shadow"></div>

	<div class="container mypage">
        <div class="row">
            <div class="col-lg-9">
                <div class="post">

				<?php
				if (have_posts()) :
					while (have_posts()) : the_post();

						get_template_part('content', get_post_format());

					endwhile;

					 
					
					$defaults = array(
						'before'           => '<p>' . __( 'Pages:', 'beauty-mountain' ),
						'after'            => '</p>',
						'link_before'      => '',
						'link_after'       => '',
						'next_or_number'   => 'number',
						'separator'        => ' ',
						'nextpagelink'     => __( 'Next page', 'beauty-mountain'),
						'previouspagelink' => __( 'Previous page', 'beauty-mountain' ),
						'pagelink'         => '%',
						'echo'             => 1
					);
				 
						wp_link_pages( $defaults );


					echo paginate_links();

					else :
						echo '<p>Nessun articolo presente in archivio</p>';
					endif;
				?>
				</div>
            </div>
            <div class="col-lg-3 sidebar">
				<?php get_sidebar(); ?>
            </div>
        </div>
    </div>



<?php get_footer();

?>