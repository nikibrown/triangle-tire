<?php
/**
 * The template for the navigation items loaded into footer.
 * 
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
?>
<footer class="footer">
    <div class="container">
        <?php
        //Initialize the footer menu.
        //This must exist in wp-admin/nav-menus.php to show up
        $defaults = array(
            'menu'            => 'footer_navigation',
            'container'       => 'div',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
        );
        wp_nav_menu( $defaults );
        
        ?>
    </div>
</footer>