<?php

get_header(); ?>

	<!-- Carousel slides -->
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner ">
            
                <div class="carousel-item active bgcarousel"
                    style="background-image: url(<?php echo (get_theme_mod('bm-header-slider-image1',get_template_directory_uri()."/images/slides/1.jpg")) ?>); width: 100%;">
                    <div class="overlay"></div>
                    <div class="caption_carousel">
                        <h5 class=" animated bounceInDown"><?php echo get_theme_mod('bm-header-slider-headline1','Mountain is what we love'); ?></h5>
                        <p class=" animated bounceInDown"><?php echo wpautop(get_theme_mod('bm-header-slider-text1','Never stop walking, never stop breathing')); ?>
                        </p>
                    </div>
                </div>

                <?php 
                if (get_theme_mod('bm-header-slider-image2') <> ""){
                    ?>
                    <div class="carousel-item bgcarousel"
                        style="background-image: url(<?php echo (get_theme_mod('bm-header-slider-image2')) ?>); width: 100%;">
                        <div class="overlay"></div>
                        <div class="caption_carousel">
                            <h5 class=" animated bounceInLeft"><?php echo get_theme_mod('bm-header-slider-headline2'); ?></h5>
                            <p class=" animated bounceInLeft"><?php echo wpautop(get_theme_mod('bm-header-slider-text2')); ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php 
                if (get_theme_mod('bm-header-slider-image3') <> ""){
                    ?>
                    <div class="carousel-item bgcarousel"
                        style="background-image: url(<?php echo (get_theme_mod('bm-header-slider-image3')) ?>); width: 100%;">
                        <div class="overlay"></div>
                        <div class="caption_carousel">
                            <h5 class=" animated bounceInRight"><?php echo get_theme_mod('bm-header-slider-headline3'); ?></h5>
                            <p class=" animated bounceInRight"><?php echo wpautop(get_theme_mod('bm-header-slider-text3')); ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            
            <?php 
            if (get_theme_mod('bm-header-slider-image2') <> ""){
                ?>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <?php
            }
            ?>
        </div>
	<div class="banner-shadow"><img src="<?php echo get_template_directory_uri() ?>/images/banner-shadow.png" alt="Banner Shadow"></div>
	

	 <!-- 3 button -->
	 <div class="banner-button-home">
        <div class="container">
            <div class="row text-center">
                
                <?php
                    for ($i = 1; $i <= 3; $i++){                    
                    $my_id = get_theme_mod('bm-3button-page-setting'.$i.'');
                    $post_id_5369 = get_post($my_id);
                    $content = $post_id_5369->post_content;
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(']]>', ']]>', $content);
                    ?>

                <div class="col-lg-4 button-home">
                    <a href="<?php the_permalink($my_id); ?>">
                        <div class="button-icon">

                            <?php
                            $img = get_theme_mod('bm-3button-image-setting'.$i.'','');
                            if ($img === "") {
                                $img = '<i class="'. get_theme_mod('bm-3button-icon-setting'.$i.'','fas fa-camera-retro') .' fa-4x"></i>' ;
                            }else{
                                $img = '<img src="'. wp_get_attachment_url(get_theme_mod('bm-3button-image-setting'.$i.'')) . '" height="80">';
                            }
                            echo $img;
                            ?>

                        </div>
                        <h3>&nbsp;<?php echo get_the_title($my_id); ?></h3>
                        <p><?php echo (home_page_3_button_lenght_content($content,100)); ?></p>
                    </a>
                </div>
                    <?php
                    }
                ?>
                
            </div>
        </div>
    </div>


    <!-- Pagina chi siamo -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row about">
                <?php 
                    $my_id = get_theme_mod('bm-aboutus-home-setting');
                    $post_id_5369 = get_post($my_id);
                    $img = get_the_post_thumbnail($my_id);
                    $content = $post_id_5369->post_content;
                    $imgbg= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id_5369),'large' );
                    ?>
                    <?php if($img <> ""){ 
                        ?>

                        <div class="col-sm-4 about-img" style="background-image:url(<?php echo $imgbg[0] ?>);">
                        
                        </div>

                    <?php
                    } ?>
                    
                    <div class="col-sm-<?php if($img ===""){ echo "12";}else{echo "8";} ?>">
                        <h2><?php echo get_the_title(get_theme_mod('bm-aboutus-home-setting')); ?></h2>
                        <?php echo $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!-- Parallax -->
	<div class="parallax" style="background-image: url(<?php echo (get_theme_mod('bm-parallax-home-image-setting', get_template_directory_uri()."/images/parallax.jpg")) ?>); width: 100%;">
        <div class="text">
            <p>
                    <a href="<?php echo get_theme_mod('bm-parallax-home-link-setting') ?>" class="link-poesia">
                        <span class="poesia">&nbsp;<?php echo get_theme_mod('bm-parallax-home-text-setting','Don\'t stop the adventure'); ?></span>
                    </a>
            </p>
        </div>
	</div>
	
  <!-- Pagina con post carousel -->
  <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center pagina-home">
                <h2>Last news</h2>

                <div class="owl-carousel owl-theme" style="padding-top:40px;">
                <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();

                            ?>
                            <div class="item">
                                <a href="<?php the_permalink(); ?>" class="home-carousel-link">
                                <?php 
                                    $var = get_the_post_thumbnail_url ();

                                    if($var <> ""){
                                    ?>
                                            <img src="<?php echo get_the_post_thumbnail_url('','home-carousel-thumbnail'); ?>" class="img-fluid" style="width:100%">
                                        <?php
                                    }else{
                                        ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/images/noimage.jpg" class="img-fluid" style="width:100%">
                                        <?php
                                    }
                                    ?>
                                    <h4>
                                        <?php the_title(); ?>
                                    </h4>
                                    <?php the_excerpt() ?>
                                    
                                </a>
                            </div>

                            <?php

                        endwhile;

                        else :
                            echo '<p>Nessun articolo presente in archivio</p>';
					endif;
				?>
                    
                </div>
            </div>
        </div>
    </div>

	<?php get_footer();

?>