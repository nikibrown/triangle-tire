<?php
/**
 * The template for the navigation items loaded into header.
 * 
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php bloginfo('url')?>"><?php bloginfo('name'); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <?php
            wp_nav_menu( 
                    array(
                    'menu' => 'top_menu',
                    'depth' => 2,
                    'container' => false,
                    'menu_class' => 'nav navbar-nav',
                    'walker' => new wp_bootstrap_navwalker()
                )
            );
            ?>
        </div><!--/.nav-collapse -->
    </div>
</nav>