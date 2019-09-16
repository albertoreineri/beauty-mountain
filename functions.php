<?php

if ( ! function_exists( 'theme_setup' ) ) :

	// @since Themename 1.0
	
	function theme_setup() {
	   // Add theme support for document Title tag
	  add_theme_support( 'title-tag' );
	}
	
	endif; // theme_setup
	
	add_action('after_setup_theme', 'theme_setup' );

	if ( ! isset( $content_width ) ) {
		$content_width = 1100;
	}


add_theme_support( 'automatic-feed-links' ); 


/* CSS e JS */
function beauty_mountain_resources() {
	//CSS
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
	wp_enqueue_style( 'font-a','https://use.fontawesome.com/releases/v5.7.2/css/all.css','','','all');
	//wp_enqueue_style( 'font-a', get_template_directory_uri() . '/fonts/fontawesome/css/all.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'fixed-navbar', get_template_directory_uri() . '/css/fixed-navbar.css' );
	if(is_front_page()){
		wp_enqueue_style( 'owl-carousel1', get_template_directory_uri() . '/css/owl.carousel.min.css' );
		wp_enqueue_style( 'owl-carousel2', get_template_directory_uri() . '/css/owl.theme.default.min.css' );
	}
	wp_enqueue_style('style', get_stylesheet_uri());

	//JS
	//wp_enqueue_script( 'ajax-js', '//ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js', '','' ,true);
	wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-3.3.1.min.js', '','' ,true);
	wp_enqueue_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', '','' ,true);
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', '','' ,true);
	wp_enqueue_script( 'fixed-navbar-js', get_template_directory_uri() . '/js/fixed-navbar.js', '','' ,true);
	if(is_front_page()){
		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', '','' ,true);
	}
	
}
add_action('wp_enqueue_scripts', 'beauty_mountain_resources');

/*
// Aggiungere classe a <li>
function add_additional_class_on_li($classes, $item, $args) {
    if($args->add_li_class) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

// Aggiungere classe a <a>
function add_menu_link_class( $atts, $item, $args ) {
	if (property_exists($args, 'link_class')) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

// Aggiungere classe active a pagina corrente

function special_nav_class ($classes, $item) {
	if (in_array('current-menu-item', $classes) ){
		$classes[] = 'active ';
	}
	return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);


function add_class_to_href( $classes, $item ) {
    if ( in_array('current-menu-item', $item->classes) ) {
        $classes['class'] = 'nav-link active-link';
    }
    return $classes;
}
add_filter( 'nav_menu_link_attributes', 'add_class_to_href', 10, 2 );*/


// Custom Walker Class for Bootstrap Menu
add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

  function bootstrap_setup(){

    class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


      function start_lvl( &$output, $depth = 0, $args = array() ) {

        $indent = str_repeat( "\t", $depth );
        $output    .= "\n$indent<ul class=\"dropdown-menu\">\n";

      }

      function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'nav-item';


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ($args->walker->has_children)      ? ' class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : 'class="nav-link"';

        $item_output = $args->before;
        $item_output .= ($depth > 0) ? '<a class="dropdown-item"' . $attributes . '> ' : '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

    }

  }

endif;




add_action( 'after_setup_teme', 'cbm_theme_setup' );
function bm_theme_setup() {
    add_editor_style();
}


//Lunghezza excerpt
function the_excerpt_max_charlength($charlength) {
	$excerpt = strip_tags(get_the_content());

	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}

function home_page_3_button_lenght_content($content, $charlength){
	$excerpt = strip_tags($content);
	
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
	} else {
		echo $excerpt;
	}

}







// Theme setup
function beauty_mountain_setup() {
	
	// Navigation Menus
	register_nav_menus(array(
		'primary' => __( 'Primary Menu','beauty-mountain'),
	));
	
	// Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail', 180, 120, true);
	add_image_size('square-thumbnail', 80, 80, true);
	add_image_size('blog-thumbnail', 800, 420, true);
	add_image_size('home-carousel-thumbnail', 565, 318, true);
	add_image_size('banner-image', 920, 210, array('left', 'top'));
	
	// Add post type support
	add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme', 'beauty_mountain_setup');

// Add Widget Areas
function ourWidgetsInit() {
	
	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar1',
		'before_widget' => '<div class="sidebar-block">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 1',
		'id' => 'footer1',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 2',
		'id' => 'footer2',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 3',
		'id' => 'footer3',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar( array(
		'name' => 'Footer Area 4',
		'id' => 'footer4',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
	
}

add_action('widgets_init', 'ourWidgetsInit');

//------------------------------
//Appearance
//------------------------------




//Logo
function bm_logo($wp_customize) {

	$wp_customize->add_section('bm-logo-section', array(
		'title' => 'Logo',
		'priority' => 30,
	));

	$wp_customize->add_setting('bm-logo-setting', array(
		'default' => get_template_directory_uri() .'/images/logo.png',
		//'sanitize_callback' => 'bm-logo-setting'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bm-logo-control', array(
		'label' => 'Img Logo',
		'section' => 'bm-logo-section',
		'settings' => 'bm-logo-setting',

	)));

	$wp_customize->add_setting('bm-logo-text-setting', array(
		'default' => 'Logo Text',
		//'sanitize_callback' => 'bm-logo-text-setting'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-logo-text-control', array(
		'label' => 'Text Logo',
		'section' => 'bm-logo-section',
		'settings' => 'bm-logo-text-setting',
	)));
	
}

add_action('customize_register','bm_logo');


// Add Slider images
function bm_header_slider($wp_customize) {

	$wp_customize->add_section('bm-header-slider-section', array(
		'title' => 'Header',
		'priority' => 30,

	));

	//Photo 1
	$wp_customize->add_setting('bm-header-slider-image1', array(
		'default' => get_template_directory_uri()."/images/slides/1.jpg",
		//'sanitize_callback' => 'bm-header-slider-image1'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bm-header-slider-image-control1', array(
		'label' => 'Slide 1',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-image1',
	)));

	$wp_customize->add_setting('bm-header-slider-headline1', array(
		'default' => 'Example header title',
		//'sanitize_callback' => 'bm-header-slider-headline1'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-header-slider-headline-control1', array(
		'label' => 'Title',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-headline1',
	)));

	$wp_customize->add_setting('bm-header-slider-text1', array(
		'default' => 'Example header subtitle',
		//'sanitize_callback' => 'bm-header-slider-text1'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-header-slider-text-control1', array(
		'label' => 'Subtitle',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-text1',
	)));
	
	//Photo 2
	$wp_customize->add_setting('bm-header-slider-image2', array(
		'default' => '',
		//'sanitize_callback' => 'bm-header-slider-image2'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bm-header-slider-image-control2', array(
		'label' => 'Slide 2',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-image2',
	)));

	$wp_customize->add_setting('bm-header-slider-headline2', array(
		'default' => 'Example header title',
		//'sanitize_callback' => 'bm-header-slider-headline2'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-header-slider-headline-control2', array(
		'label' => 'Title',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-headline2',
	)));

	$wp_customize->add_setting('bm-header-slider-text2', array(
		'default' => 'Example header subtitle',
		//'sanitize_callback' => 'bm-header-slider-text2'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-header-slider-text-control2', array(
		'label' => 'Subtitle',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-text2',
	)));

	//Photo 3
	$wp_customize->add_setting('bm-header-slider-image3', array(
		'default' => '',
		//'sanitize_callback' => 'bm-header-slider-image3'
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bm-header-slider-image-control3', array(
		'label' => 'Slide 3',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-image3',
	)));

	$wp_customize->add_setting('bm-header-slider-headline3', array(
		'default' => 'Example header title',
		//'sanitize_callback' => 'bm-header-slider-headline3'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-header-slider-headline-control3', array(
		'label' => 'Title',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-headline3',
	)));

	$wp_customize->add_setting('bm-header-slider-text3', array(
		'default' => 'Example header subtitle',
		//'sanitize_callback' => 'bm-header-slider-text3'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-header-slider-text-control3', array(
		'label' => 'Subtitle',
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-text3',
	)));


	//Color slider text
	$wp_customize->add_setting('bm-header-slider-text-color-setting', array(
		'default' => '#FFFFFF',
		'transport' => 'refresh',
		//'sanitize_callback' => 'bm-header-slider-text-color-setting'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bm-header-slider-text-color-control', array(
		'label' => __('Slider text color', 'beauty-mountain'),
		'section' => 'bm-header-slider-section',
		'settings' => 'bm-header-slider-text-color-setting'
	)));
}

add_action('customize_register','bm_header_slider');

//3 button section
function bm_3utton($wp_customize) {

	$wp_customize->add_section('bm-3button-section', array(
		'title' => __('3 Button','beauty-mountain'),
		'priority' => 40,
	));

	//Color slider text
	$wp_customize->add_setting('bm-3button-bgcolor-setting', array(
		'default' => '#7ab7d3',
		'transport' => 'refresh',
		//'sanitize_callback' => 'bm-3button-bgcolor-setting'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bm-3button-bgcolor-control', array(
		'label' => __('Background color', 'beauty-mountain'),
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-bgcolor-setting'
	)));


	//3 button
	$wp_customize->add_setting('bm-3button-image-setting1', array(
		//'sanitize_callback' => 'bm-3button-image-setting1'
	));

	$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'bm-3button-image-control1', array(
		'label' => 'Image 1',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-image-setting1',
		'width' => 80,
		'height' => 80,
		'description' => '<hr>'
	)));

	$wp_customize->add_setting('bm-3button-icon-setting1', array(
		'default' => 'fas fa-binoculars',
		//'sanitize_callback' => 'bm-3button-icon-setting1'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-3button-icon-control1', array(
		'label' => 'Icon 1',
		'description' => 'If you want to use an icon remove the image and insert the <a href="https://fontawesome.com/icons?d=gallery" target="_blank">FontAwesome</a> class below.',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-icon-setting1',
		'type' => 'text',
	)));

	$wp_customize->add_setting('bm-3button-page-setting1', array(
		//'sanitize_callback' => 'bm-3button-page-setting1'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-3button-page-control1', array(
		'label' => 'Page Link 1',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-page-setting1',
		'type' => 'dropdown-pages'
	)));




	$wp_customize->add_setting('bm-3button-image-setting2', array(
		//'sanitize_callback' => 'bm-3button-image-setting2'
	));

	$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'bm-3button-image-control2', array(
		'label' => 'Image 2',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-image-setting2',
		'width' => 80,
		'height' => 80,
		'description' => '<hr>'
	)));

	$wp_customize->add_setting('bm-3button-icon-setting2', array(
		'default' => 'fas fa-campground',
		//'sanitize_callback' => 'bm-3button-icon-setting2'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-3button-icon-control2', array(
		'label' => 'Icon 2',
		'description' => 'If you want to use an icon remove the image and insert the <a href="https://fontawesome.com/icons?d=gallery" target="_blank">FontAwesome</a> class below.',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-icon-setting2',
		'type' => 'text',
	)));

	$wp_customize->add_setting('bm-3button-page-setting2', array(
		//'sanitize_callback' => 'bm-3button-page-setting2'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-3button-page-control2', array(
		'label' => 'Page Link 2',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-page-setting2',
		'type' => 'dropdown-pages'
	)));




	$wp_customize->add_setting('bm-3button-image-setting3', array(
		//'sanitize_callback' => 'bm-3button-image-setting3'
	));

	$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'bm-3button-image-control3', array(
		'label' => 'Image 3',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-image-setting3',
		'width' => 80,
		'height' => 80,
		'description' => '<hr>'
	)));

	$wp_customize->add_setting('bm-3button-icon-setting3', array(
		'default' => 'fas fa-camera-retro',
		//'sanitize_callback' => 'bm-3button-icon-setting3'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-3button-icon-control3', array(
		'label' => 'Icon 3',
		'description' => 'If you want to use an icon remove the image and insert the <a href="https://fontawesome.com/icons?d=gallery" target="_blank">FontAwesome</a> class below.',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-icon-setting3',
		'type' => 'text',
	)));

	$wp_customize->add_setting('bm-3button-page-setting3', array(
		//'sanitize_callback' => 'bm-3button-page-setting3'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-3button-page-control3', array(
		'label' => 'Page Link 3',
		'section' => 'bm-3button-section',
		'settings' => 'bm-3button-page-setting3',
		'type' => 'dropdown-pages'
	)));
	
}
add_action('customize_register','bm_3utton');

//About us page
function bm_aboutus_home($wp_customize) {
	$wp_customize->add_section('bm-aboutus-home', array(
		'title' => __('About us', 'beauty-mountain'),
		'priority' => 50,
	));


	$wp_customize->add_setting('bm-aboutus-home-setting', array(
		//'sanitize_callback' => 'bm-aboutus-home-setting3'
	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-aboutus-home-control', array(
		'label' => 'About us page',
		'section' => 'bm-aboutus-home',
		'settings' => 'bm-aboutus-home-setting',
		'type' => 'dropdown-pages'
	)));

}
add_action('customize_register','bm_aboutus_home');


//Parallax
function bm_parallax_home($wp_customize) {

	$wp_customize->add_section('bm-parallax-home', array(
		'title' => __('Parallax', 'beauty-mountain'),
		'priority' => 60,
	));


	$wp_customize->add_setting('bm-parallax-home-image-setting',array(
		'default' => get_template_directory_uri()."/images/parallax.jpg",
		//'sanitize_callback' => 'bm-parallax-home-image-setting'

	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bm-parallax-home-image-control', array(
		'label' => 'Parallax image',
		'section' => 'bm-parallax-home',
		'settings' => 'bm-parallax-home-image-setting',

	)));


	$wp_customize->add_setting('bm-parallax-home-text-setting', array(
		'default' => 'Example parallax text',
		//'sanitize_callback' => 'bm-parallax-home-text-setting'

	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-parallax-home-text-control', array(
		'label' => 'Parallax text',
		'section' => 'bm-parallax-home',
		'settings' => 'bm-parallax-home-text-setting',
	)));

	$wp_customize->add_setting('bm-parallax-home-link-setting', array(
		'default' => '',
		//'sanitize_callback' => 'bm-parallax-home-link-setting'

	));

	$wp_customize->add_control(new WP_Customize_control($wp_customize, 'bm-parallax-home-link-control', array(
		'label' => 'Parallax Link',
		'section' => 'bm-parallax-home',
		'settings' => 'bm-parallax-home-link-setting',
	)));
}
add_action('customize_register','bm_parallax_home');

//Home post carousel
function bm_home_carousel($wp_customize){

	$wp_customize->add_section('bm-home-carousel-section', array(
		'title' => __('Post Carousel','beauty-mountain'),
		'priority' => 70,
	));

	$wp_customize->add_setting('bm-home-carousel-setting', array(
		'default' => '#000',
		'transport' => 'refresh',
		//'sanitize_callback' => 'bm-home-carousel-setting'

	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bm-home-carousel-control', array(
		'label' => __('Text color', 'beauty-mountain'),
		'section' => 'bm-home-carousel-section',
		'settings' => 'bm-home-carousel-setting'
	)));

	$wp_customize->add_setting('bm-home-carousel-hover-setting', array(
		'default' => '#3c5e65',
		'transport' => 'refresh',
		//'sanitize_callback' => 'bm-home-carousel-hover-setting'

	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bm-home-carousel-hover-control', array(
		'label' => __('Hover color', 'beauty-mountain'),
		'section' => 'bm-home-carousel-section',
		'settings' => 'bm-home-carousel-hover-setting'
	)));
}
add_action('customize_register','bm_home_carousel');

//Footer
function bm_footer($wp_customize) {

	$wp_customize->add_section('bm-footer-section', array(
		'title' => __('Footer','beauty-mountain'),
		'priority' => 80,
	));

	//Color slider text
	$wp_customize->add_setting('bm-footer-setting', array(
		'default' => '#7ab7d3',
		'transport' => 'refresh',
		//'sanitize_callback' => 'bm-footer-setting'

	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bm-footer-control', array(
		'label' => __('Background color', 'beauty-mountain'),
		'section' => 'bm-footer-section',
		'settings' => 'bm-footer-setting'
	)));

}
add_action('customize_register','bm_footer');

// Customize Appearance Option
function beauty_mountain_customize_register($wp_customize) {

	$wp_customize->add_section('bm_standard_colors', array(
		'title' => __('Standard Colors', 'beauty-mountain'),
		'priority' => 20,
	));


	$wp_customize->add_setting('bm_link_color', array(
		'default' => '#FFF',
		'transport' => 'refresh',
		//'sanitize_callback' => 'bm_link_color'

	));
	$wp_customize->add_setting('bm_link_color_hover', array(
		'default' => '#3c5e65',
		'transport' => 'refresh',
		//'sanitize_callback' => 'bm_link_color_hover'

	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bm_link_color_control', array(
		'label' => __('Link Color', 'beauty-mountain'),
		'section' => 'bm_standard_colors',
		'settings' => 'bm_link_color'
	)));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bm_link_color_hover_control', array(
		'label' => __('Link Color Hover', 'beauty-mountain'),
		'section' => 'bm_standard_colors',
		'settings' => 'bm_link_color_hover'
	)));


}

add_action('customize_register','beauty_mountain_customize_register');

//Output Customize CSS
function beauty_mountain_customize_css() { ?>

	<style type="text/css">
		a:link,
		a:visited {
			color: <?php echo get_theme_mod('bm_link_color') ?>;
		}

		.navbar .navbar-nav .nav-link {
			color: <?php echo get_theme_mod('bm_link_color') ?>;
		}

		.navbar-text{
			color: <?php echo get_theme_mod('bm_link_color') ?> !important;
		}

		h3:before{
			background: <?php echo get_theme_mod('bm_link_color_hover') ?>;
		}
		h3:after{
			background: <?php echo get_theme_mod('bm_link_color_hover') ?>;
		}




		a:hover,
		a:focus {
			color: <?php echo get_theme_mod('bm_link_color_hover') ?>;
		}

		.button-home a:hover{
			color: <?php echo get_theme_mod('bm_link_color_hover') ?>;
		}

		.button-user-post-home:hover{
			color: <?php echo get_theme_mod('bm_link_color_hover') ?>;
		}
		footer a:hover{
			text-decoration: none;
			color: <?php echo get_theme_mod('bm_link_color_hover') ?>;
		}
		.navbar .navbar-nav .nav-link:hover {
			color: <?php echo get_theme_mod('bm_link_color_hover') ?>;
		}
		.navbar-text:hover{
			color: <?php echo get_theme_mod('bm_link_color_hover') ?>!important;
		}
		.post .readmore a:hover{
			color:<?php echo get_theme_mod('bm_link_color_hover') ?>;
		}
		.post .tag a:hover{
			color:<?php echo get_theme_mod('bm_link_color_hover') ?>;
		}
		button, input[type="button"], input[type="reset"], input[type="submit"] {
			background:<?php echo get_theme_mod('bm_link_color_hover') ?>;
		}
		.sidebar-block ul li a:hover{
			color:<?php echo get_theme_mod('bm_link_color_hover') ?>;
		}


		/* Slider text color */
		.caption_carousel h5{
			color: <?php echo get_theme_mod('bm-header-slider-text-color-setting') ?>!important;
		}

		.caption_carousel p{
			color: <?php echo get_theme_mod('bm-header-slider-text-color-setting') ?>!important;
		}

		/*3button section*/
		.banner-button-home{
			background-color: <?php echo get_theme_mod('bm-3button-bgcolor-setting') ?>;
		}

		/* Post Carousel */
		.home-carousel-link {
			color:<?php echo get_theme_mod('bm-home-carousel-setting') ?> !important;
		}
		.home-carousel-link:hover {
			color:<?php echo get_theme_mod('bm-home-carousel-hover-setting') ?> !important;
		}

		/*Footer*/
		footer{
			background-color:<?php echo get_theme_mod('bm-footer-setting') ?>
		}
	</style>

<?php
}

add_action('wp_head','beauty_mountain_customize_css');


// Lunghezza excerpt 
function custom_excerpt_length() {
	return 10;
}
add_filter('excerpt_length', 'custom_excerpt_length');


