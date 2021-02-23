<?php
/**
 * The template for displaying:
 *.archives, category pages, search results, etc...
 *
 * Template Name: Tire Results
 * @package WordPress
 * @subpackage wpcustom
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
					$order = array(
						'application',
						'feature',
						'position',
					);
					//make sure this order item exists to begin with
					foreach( $order as $i => $o )
					{
						if( !in_array( $o, array_keys( $all_cats[$type] ) ) )
						{
							unset( $order[$i] );
						}
					}

					$all_cats[$type] = array_merge( array_flip( $order ), $all_cats[$type] );
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
		$ids = array();
		if( !$searching )
		{
			$row_count = 0;
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();

					$ids[] = get_the_ID();
					$meta_heading = get_post_meta( get_the_ID(), '_type_data_prod_heading', true );
					$meta_desc = get_post_meta( get_the_ID(), '_type_data_description', true );
					$meta_warranty = get_post_meta( get_the_ID(), '_type_data_warranty', true );
					$img = featured_image( get_the_ID(), 'medium', get_bloginfo( 'template_url' ) .'/images/passenger-tire-example.png' );

					$open = '';
					if( $row_count % 2 == 0 && $row_count > 0 )
					{
						echo PHP_EOL . '</div><div class="tirelist row">' . PHP_EOL;
					}

					?>
					<div class="medium-6 large-6 small-12 columns">
						<div class="tiresearch">
							<img src="<?php echo $img; ?>" class="interiortireimage">
							<div class="guarantee">
								<?php
								if( get_post_type( get_the_ID() ) != 'offroad_tires' )
								{
									echo '<img src="'. get_bloginfo( 'template_url' ).'/images/guarantee-icon.png">';
								}
								?>
							</div>
						</div>
						<div class="tiretitle text-center">
							<h2>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>
						</div>
						<div class="tireinfo">
							<?php
							if( $meta_heading != '' )
							{
								echo '<h3>' . $meta_heading . '</h3>';
							}
							if( $meta_desc != '' )
							{
								echo $meta_desc;
							}
							?>
						</div>
						<div class="printemailspecs text-center">
							<!--<button class="button js-addtoprint" type="button" data-id="<?php echo get_the_ID(); ?>" data-link="<?php the_permalink(); ?>">Print/Email</button>-->
							<a href="<?php the_permalink(); ?>"><button class="button" type="button">View Specs</button></a>
							<a href="<?php bloginfo( 'home' ); ?>/warranties">
								<button class="button" type="button">
									Warranty<?php if( $meta_warranty != '' ) echo ' <span class="warrantymileage">'. $meta_warranty . '</span>'; ?>
								</button>
							</a>
						</div>
					</div>

					<?php
					$row_count++;

				endwhile;
			else:
				//no posts found ?>
				<h2>Sorry, no results found for your search. Try <a href="#" class="js-nav-search--trigger">searching again</a>.</h2>
				<?php
			endif;
		}
		else
		{
			echo '<div id="js-printblock" class="js-instantprint">';
			while ( $search->have_posts() ) : $search->the_post();
				$post_ID = $post->ID;
				$skip_header = true;
				include( __DIR__ . '/partials/tire-detail.php' );
			endwhile;
			wp_reset_postdata();
			echo '</div>';
		}
        ?>
	</div>

<?php
get_footer();
