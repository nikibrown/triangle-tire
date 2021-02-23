<?php
/**
 * page-print.php
 * Template Name: Print Results Page
 *
 * @version 1.0
 * @date 5/21/18 10:12 AM
 * @package triangle
 */
$searching = false;
$pagelink = 'http://'. $_SERVER['HTTP_HOST'] .'/'. $_SERVER['REQUEST_URI'];
$qo = get_queried_object();

if( isset( $_GET['selection'] ) && !empty( $_GET['selection'] ) )
{
	$searching = true;
	global $query_string;
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$query_args = explode( "&", $query_string );
	$search_query = array();

	$search_query['post_type'] = array(
		'offroad_tires',
		'passenger_tires',
		'truckbus_tires',
		'trailer_tires',
	);
	$search_query['posts_per_page'] = -1;
	$search_query['paged'] = $paged;
	$search_query['post_status'] = 'publish';
	$search_query['post__in'] = $_GET['selection'];
	$search = new WP_Query( $search_query );
	global $wp_query;
	$total_results = $wp_query->post_count;
	$pagelink = 'http://'. $_SERVER['HTTP_HOST'] .'/'. $_SERVER['REQUEST_URI'];
}
else
{
	$total = $GLOBALS['wp_query']->post_count;
}
$all_cats = get_all_taxonomies();

$type = isset( $qo->name ) ? $qo->name : false;
//Backtrace to get the taxonomy from the term via the all_taxonomies list
if( isset( $qo->slug ) )
{
	$type = $qo->slug;
	foreach( $all_cats as $k => $t )
	{
		foreach( $t as $v => $i )
		{

			foreach( $i as $v )
			{
				if( $type == $v->slug )
				{
					$type = $k;
					break;
				}
			}
		}
	}

}
$qstring = ( $type !== false ) ? $qo->taxonomy . '/'. $qo->slug : null;

get_header();

$viewing_taxomy = false;
?>
	<div class="interiorbanner expanded row">
		<div class="large-12">
			<img src="<?php bloginfo( 'template_url' ); ?>/images/passenger-tire-header.jpg" >
		</div>
	</div>
	<div class="row">
		<div class="medium-7 large-9 columns">
			<h1>
				<?php if(is_month()) { ?>
					Browsing articles from "<strong><?php the_time('F, Y') ?></strong>"
				<?php } ?>
				<?php if(is_category()) { ?>
					Browsing articles in "<strong><?php $current_category = single_cat_title("", true); ?></strong>"
				<?php } ?>
				<?php if(is_tag()) { ?>
					Browsing articles tagged with "<strong><?php wp_title('',true,''); ?></strong>"
				<?php } ?>
				<?php if(is_author()) { ?>
					Browsing articles by "<strong><?php wp_title('',true,''); ?></strong>"
					<?php
				}
				if( is_post_type_archive() )
				{
					post_type_archive_title();
					$viewing_taxomy = post_type_archive_title( '', false );
				}

				if( is_tax( array( 'application', 'applications', 'categories', 'category', 'classification', 'equipment', 'feature', 'position' ) ) )
				{
					single_term_title();
					$viewing_taxomy = single_term_title( '', false );

				}
				?>

			</h1>
		</div>
		<div class="medium-5 large-3 columns emailprint">
			<a href="#" class="button<?php echo !$search ? ' js-init-batchprint' : ' js-print'; ?>">Print</a> &nbsp; <a href="#test" class="button js-replace-links" target="_top">Email</a>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns"><hr></div>
	</div>
<?php
if( isset( $all_cats[$type] ) && !empty( $all_cats[$type] ) )
{
	?>
	<div class="row filter">
		<div class="small-12 columns">
			Filter by:
			<div class="row">
				<?php
				$avail = 12;
				$used = 0;
				$output_options = '';
				$lab_switch = array(
					'classification' => 'classifications',
				);
				foreach( $all_cats[$type] as $lab => $items )
				{
					$lab = isset( $lab_switch[$lab] ) ? $lab_switch[$lab] : $lab;
					$output_options .= '<div class="small-12 medium-3 columns">
							<label>
								<select class="js-change-view">
									<option value="">All '. ucwords( $lab ) .'</option>';
					foreach( $items as $i )
					{
						$sel = ( $qstring == $i->taxonomy . '/'. $i->slug ) ? ' selected="selected"' : '';
						$output_options .= '<option value="'. $i->taxonomy . '/'. $i->slug . '"'.$sel.'>' . $i->name .'</option>';
					}

					$output_options .= '</select>
							</label>
						</div>';
					$used = $used+3;
				}

				echo $output_options;
				if( $used < $avail )
				{
					echo '<div class="medium-'. ( $avail - $used ) .' columns"></div>';
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
?>

	<div class="row">
		<div class="large-12 columns divider"></div>
	</div>
	<div class="tirelist row">
		<?php
		$graphic_category = '';
		echo '<div id="js-printblock" class="js-instantprint">';
		echo '<div id="header" class="expanded print-bgcolor" style="display: none;">
			<a class="logolink" href="#"><img class="logo" src="'. get_bloginfo( 'template_url' ).'/images/logo.png"></a>
		</div>';
		while ( $search->have_posts() ) : $search->the_post();
			$post_ID = $post->ID;
			$skip_header = true;
			$graphic_category = $post->post_type;
            $printing = true;
			include( __DIR__ . '/partials/tire-detail.php' );
		endwhile;
		wp_reset_postdata();

		$bg_image = 'passengertire.jpg';

		switch( $graphic_category )
		{
			case 'truckbus_tires':
				$bg_image = 'commercial_footer.jpg';
			break;
			case 'passenger_tires':
				$bg_image = 'pcr_footer.jpg';
			break;
			case 'trailer_tires':
				$bg_image = 'st_radial_footer.jpg';
			break;
			case 'offroad_tires':
			default:
				$bg_image = 'otr_footer.jpg';
			break;
			//commercial_footer.jpg
			//otr_footer.jpg
			//st_radial_footer.jpg
			//pcr_footer.jpg
		}
		?>
		<!--- Print dealer info and tire type image here -->

		<div class="row expanded print-footer" style="background-color: #3d3c3a !important; display: none; width: 100% !important;">
			<div class="medium-8 small-6 columns" style="padding: 0 !important; margin: 0 !important; background-color: #434342 !important;">
				<img class="print-footer-img" src="<?php bloginfo( 'template_url' ); ?>/images/footers/<?php echo $bg_image; ?>">
			</div>
			<div class="medium-4 small-6 columns text-right" style="padding: 20px 40px !important; color: #fff !important; background-color: #3d3c3a !important;">
				<p style="margin-bottom: 10px !important; font-size: 17px !important; line-height: 1.2em !important; color: #fff !important;">

					<span style="font-size: 18px !important; color: #fff !important; font-weight: bold !important;">
						<?php echo isset( $_GET['business']['name'] ) ? triangle_stripslashes( $_GET['business']['name'] ) : '&nbsp;'; ?>
					</span><br>
					<?php
					echo ( isset( $_GET['business']['address'] ) ? triangle_stripslashes( $_GET['business']['address'] ) : '&nbsp;' ) .'<br />';
					$addr = '';
					if( isset( $_GET['business']['city'] ) && !empty( $_GET['business']['city'] ) )
					{
						$addr .= triangle_stripslashes( $_GET['business']['city'] );
					}
					if( isset( $_GET['business']['state'] ) && !empty( $_GET['business']['state'] ) )
					{
						$addr .= ( !empty( $addr ) ? ', ' : '' ) .triangle_stripslashes( $_GET['business']['state'] );
					}
					if( isset( $_GET['business']['zip'] ) && !empty( $_GET['business']['zip'] ) )
					{
						$addr .= ' '. triangle_stripslashes( $_GET['business']['zip'] );
					}
					echo !empty( $addr ) ? $addr .'<br />' : '&nbsp;<br />';
					echo isset( $_GET['business']['phone'] ) && !empty( $_GET['business']['phone'] ) ? triangle_stripslashes( $_GET['business']['phone'] ) : '&nbsp;';
					echo '</p>';
					echo '<p style="margin-bottom: 0px !important; color: #fff !important; font-size: 17px !important; line-height: 1.2em !important;">'. isset( $_GET['business']['email'] ) ? triangle_stripslashes( $_GET['business']['email'] ) : '&nbsp;' .'</p>';
					?>
			</div>
		</div>

		<!--- End print dealer info and tire type image -->
		<?php
		echo '</div>';
		?>
	</div>

	<form class="js-printitems" method="get" action="">
		<?php
		if( isset( $ids ) && !empty( $ids ) )
		{
			foreach( $ids as $i )
			{
				echo '<input type="hidden" name="selection[]" value="'. $i .'" />';
			}
		}
		?>
	</form>
<?php
get_footer();
