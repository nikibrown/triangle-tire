<?php
/**
 * page-become-a-dealer.php
 * Template Name: Sidebar
 * @version 1.0
 * @date 6/10/17 9:16 PM
 * @package triangle
 */
get_header();
// Start the loop.
    while ( have_posts() ) : the_post();
    	$img = featured_image( $post->ID, 'full');
		$gallery = get_post_gallery( $post->ID, false );
		//$gallery = array_unique( $gallery );
		$ids = explode( ",", $gallery['ids'] );
		$pics = array();
		if( !empty( $ids ) )
		{
			foreach( $ids as $id )
			{
				$pics[] = wp_get_attachment_url( $id );
			}
			$pics = array_unique( $pics );
		}
		$pics = array_filter( $pics );
?>

	<?php
	if( !empty( $img ) || !empty( $pics ) )
	{
	?>
		<div class="interiorbanner expanded row">
			<div class="large-12">
				<?php
				if( !empty( $pics ) )
				{
					echo '<div class="js-gallery" style="height: 300px; max-height: 300px; overflow: hidden;">';
						foreach( $pics as $g )
						{
							echo '<img src="'. $g .'" />';
						}
					echo '</div>';
				}
				else
				{
					echo '<img src="'.$img.'" />';
				}
				?>
			</div>
		</div>
	<?php
	}
	?>
	<div class="row">
		<div class="medium-12 columns">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns divider"><hr></div>
	</div>
	<div class="row">
		<div class="medium-8 large-9 columns">
			<?php
			$post_content_without_shortcodes = wpautop( preg_replace ( '/\[gallery(.*?)\]/s' , '' , $post->post_content ) );
			echo $post_content_without_shortcodes;
			?>
			<?php the_field('shortcodes'); ?>
		</div>
		<div class="medium-4 large-3 columns">
			<div class="sidebar">
				<p><span class="bolder">Triangle Tire USA</span><br>
				117 Seaboard Lane, Suite F100<br>
				Franklin, TN 37067<br>
				Tel: 888-847-3745<br>
				Fax: 615-610-5051<br>
				<span class="wordbreak"><a class="smallertext" href="mailto:customerservice@triangletireus.com" target="_blank">customerservice@triangletireus.com</a></span><br>
			</div>
		</div>
	</div>
	 <?php

        // End the loop.
    	endwhile;
    ?>
<?php
get_footer();
