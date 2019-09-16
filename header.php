<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">

		<title><?php wp_title(); ?></title>
		
		<?php 
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>>

	<header>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" id="navbar">
			<div class="container" id="top-container">
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo (get_theme_mod('bm-logo-setting',get_template_directory_uri()."/images/logo.png")) ?>" height="67" alt="">
					<p class="navbar-text brand">
						<?php echo get_theme_mod('bm-logo-text-setting',''); ?>
					</p>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
					aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">

					<?php
					$args = array(
						'theme_location' => 'primary',
						'depth'      => 2,
						'container' => false,
						'menu_class' => 'navbar-nav ml-auto',
						'add_li_class'  => 'nav-item',
						'link_class'   => 'nav-link',
						'walker'     => new Bootstrap_Walker_Nav_Menu()

					);

					?>
					<?php wp_nav_menu($args); ?>
					
				</div>
			</div>
		</nav>
	</header>
