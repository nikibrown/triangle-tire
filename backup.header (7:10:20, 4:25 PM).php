<?php
/**
 * The template for the global header.
 * 
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
$favicon = get_option( 'project_favicon' );
if( $favicon == '' )
{
    $favicon = get_stylesheet_directory_uri() . '/images/favicon.ico';
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/foundation.css">
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/app.css">
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/custom.css">
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/print.css?v=<?php echo current_v(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.css">
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/sss.css">
    <link rel="stylesheet" href="https://use.typekit.net/moo1ezw.css">
    <script src="https://use.fontawesome.com/e83b344081.js"></script>

    <script type="text/javascript">
        var site_options = {
            base: '<?php bloginfo( 'home' ); ?>'
        };
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('class-name');?> >
<div id="triangle-overlay">
	<img src="<?php bloginfo( 'template_url' ); ?>/images/Triangle _spattern_overlay.png">
</div>
<div id="topheaderrow" class="hideonmobile expanded row">
	<div class="large-12 columns">
		<div class="row">
			<div class="large-12 columns">
				<?php
            wp_nav_menu( 
                    array(
                    'menu' => 'Primary Menu',
                    'depth' => 2,
                    'container' => false,
                    'menu_class' => 'dropdown menu secondary',
                    'walker' => new wp_bootstrap_navwalker()
                )
            );
            ?>
				<!--<ul class="dropdown menu secondary" data-dropdown-menu>
					<li><a href="<?php bloginfo( 'home' ); ?>/about">About Us</a></li>
					<li><a href="<?php bloginfo( 'home' ); ?>/support-center">Support Center</a></li>
					<li><a href="<?php bloginfo( 'home' ); ?>/contact">Contact Us</a></li>
					<li><a href="<?php bloginfo( 'home' ); ?>/find-a-dealer">Find a Dealer</a></li>
					<li><a href="#modal-text" class="searchbutton call-modal" title="Search" data-open="modal-text">Search</a></li>
					<li><?php pll_the_languages(array('show_flags' => 1, 'hide_current' => 1 )); ?></li>
				</ul>-->
				<section class="semantic-content reveal" id="modal-text" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-reveal>
					<div class="modal-inner">
						<div class="modal-content">
							<a class="close-button" data-close aria-label="Close modal" type="button">
  								<span aria-hidden="true">&times;</span>
							</a>
							<form class="form-inline" action="<?php bloginfo('home'); ?>/" method="get">
								<label>Search for: </label>
								<input class="form-control" type="text" name="s" value="<?php if (!get_search_query()) : echo ''; else : echo get_search_query(); endif; ?>" onfocus="if (this.value == 'search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'search';}" />
								<input type="submit" class="btn btn-default" value="Search" />
							</form>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
<div id="header" class="expanded row">
    <div class="large-12 no-print">
        <div id="mainheaderrow" class="row">
            <div class="hideonmobile medium-12 large-3 columns">
				<a class="logolink" href="<?php bloginfo( 'home' ); ?>"><img class="logo" src="<?php bloginfo( 'template_url' ); ?>/images/Triangle_logo_tag-WHT.png"></a>
            </div>
            <div class="medium-12 large-9 columns">
				<a class="hideondesktop logolink" href="<?php bloginfo( 'home' ); ?>"><img class="logo" src="<?php bloginfo( 'template_url' ); ?>/images/Triangle_logo_tag-WHT.png"></a>
                <div class="title-bar" data-responsive-toggle="example-animated-menu" data-hide-for="large">
                    <button class="menu-icon" type="button" data-toggle></button>
                </div>
                <div class="top-bar" id="example-animated-menu" data-equalizer>
                    <div class="top-bar-left" data-equalizer-watch>
                    		<?php
								wp_nav_menu( 
										  array(
										  'menu' => 'Tire Menu',
										  'depth' => 2,
										  'container' => false,
										  'menu_class' => 'dropdown menu main',
										  'walker' => new wp_bootstrap_navwalker()
									 )
								);
								?>
								<!--<a href="#modal-text" class="searchbutton call-modal" title="Search" data-open="modal-text">Search</a>-->
								
                        <!--<ul class="dropdown menu main" data-dropdown-menu>
                            <li><a href="<?php bloginfo( 'home' ); ?>/passenger-tires">Passenger / Light Truck / SUV Tires</a></li>
                            <li><a href="<?php bloginfo( 'home' ); ?>/truck-tires">Truck &amp; Bus Tires</a></li>
                            <li><a href="<?php bloginfo( 'home' ); ?>/offroad-tires">Off-The-Road Tires</a></li>
                        </ul>-->
                        
                        <?php
								wp_nav_menu( 
										  array(
										  'menu' => 'Primary Menu',
										  'depth' => 2,
										  'container' => false,
										  'menu_class' => 'hideondesktop dropdown menu secondary',
										  'walker' => new wp_bootstrap_navwalker()
									 )
								);
								?>
								
								<!--<ul class="hideondesktop dropdown menu secondary" data-dropdown-menu>
									<li><a href="<?php bloginfo( 'home' ); ?>/about">About Us</a></li>
									<li><a href="<?php bloginfo( 'home' ); ?>/support-center">Support Center</a></li>
									<li><a href="<?php bloginfo( 'home' ); ?>/contact">Contact Us</a></li>
									<li><a href="<?php bloginfo( 'home' ); ?>/find-a-dealer">Find a Dealer</a></li>
									<li><a href="#modal-text" class="searchbutton call-modal" title="Search" data-open="modal-text">Search</a></li>
								</ul>
								<a class="hideondesktop" href="#modal-text" class="searchbutton call-modal" title="Search" data-open="modal-text">Search</a>-->
								<ul class="mobilesocial">
									<li>
									<a href="https://business.facebook.com/TriangleTireUSA" target="_blank"><span class="fab fa-facebook"></span>  &nbsp; </a>
									</li>
									<li>
									<a href="http://twitter.com/TriangleTireUSA"><span class="fab fa-twitter"></span>  &nbsp; </a>
									</li>
									<li>
									<a href="https://www.instagram.com/triangletireusa"><span class="fab fa-instagram"></span>  &nbsp; </a>
									</li>
									<li>
									<a href="https://www.linkedin.com/company/triangle-tires-usa" target="_blank"><span class="fab fa-linkedin-in"></span>  &nbsp; </a>
									</li>
									<li>
									<a href="https://www.youtube.com/channel/UCLt9WPyKi39SWFDeA8tceyQ/about"><span class="fab fa-youtube"></span>  &nbsp; </a>
									</li>
									<li>
									<a href="http://tt.devbuilds.site/find-a-dealer"><span class="fas fa-map-marker-alt"></span>  &nbsp; </a>
									</li>
								</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>