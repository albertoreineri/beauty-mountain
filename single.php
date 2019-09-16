	
<?php

get_header(); ?>
	<!-- Carousel slides -->
    <div class="clearfix">
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner">
                <?php
                $img = get_the_post_thumbnail_url();
                if (!$img) {
                    $img = get_template_directory_uri()."/images/slides/1.jpg";
                }

                ?>
                <div class="carousel-item active bgcarousel-page"
				style="background-image: url(<?php echo $img ?>); width: 100%;">

                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row" style="height: 350px">
                            <div class="col 12" style="top:50%">
                                <div class="caption_carousel-page">
									<h1 class="animated bounceInDown"><?php the_title(); ?></h1>
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
                    <div class="row">
                        <div class="col-12">
							<?php
			
							if (have_posts()) :
								while (have_posts()) : the_post();

								if (get_post_format() == false) {
									get_template_part('content', 'single');
								} else {
									get_template_part('content', get_post_format());
								}
								//the_meta();

								endwhile;

								else :
									echo '<p>Nessun articolo trovato</p>';
								endif;
							
							?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
				<?php get_sidebar(); ?>
			</div>
        </div>
    </div>

<?php get_footer();

?>