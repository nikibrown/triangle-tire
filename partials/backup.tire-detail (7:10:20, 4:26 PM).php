<?php
/**
 * tire-detail.php
 *
 * @version 1.0
 * @date 6/11/17 7:06 AM
 * @package triangle
 */

$this_type = get_post_type_object( get_post_type( $post_ID ) );

$hide_warranty = $this_type->name == 'offroad_tires' ? true : false;
$this_label = $this_type->label;
$this_link = $this_type->rewrite['slug'];
$img = featured_image( $post_ID, 'full', get_bloginfo( 'template_url' ) .'/images/tr257.png' );
$hero_image = get_bloginfo( 'template_url' ) .'/images/passenger-tire-header.jpg';

$listed = array();
$pull = array(
	'_type_core_prod_heading',
	'_type_core_description',
	'_type_core_warranty',
	'_type_core_notation',
	'_type_data'
);
foreach( $pull as $p )
{
	$listed[$p] = get_post_meta( $post_ID, $p, true );
}

//Map the actual inner tire data
$output_tires = array();
$output_headings = array();
$possible = new ImportHelper();
$metamap = $possible->metakey_maps();
$keys = $metamap['meta'];

foreach( $listed['_type_data'] as $k => $v )
{
	foreach( $v as $i => $dat )
	{
		if( $i == '_notation' )
		{
			continue;
		}
		$output_headings[$i] = $keys[$i];
	}
	$output_tires[] = $v;
}


//Now kill any headings that have NO data
$remove = array();
$keep = array();
foreach( $output_tires as $value )
{
	foreach( $value as $key => $v )
	{
		if( ( $v != '' || !empty( $v ) ) )
		{
			unset( $remove[$key] );
			$keep[$key] = $key;
			continue;
		}
		$remove[$key] = $key;

	}
}

$remove = array_diff( $remove, $keep );

if( !empty( $remove ) )
{
	foreach( $remove as $r )
	{
		if( isset( $output_headings[$r] ) )
		{
			unset( $output_headings[$r] );
		}
	}
}


$order = array(
	'_productcode'
);
if( $this_type->name == 'truckbus_tires' )
{

	$order = array_merge( $order, array(
		'_tiresize',
		'_plyrating',
		'_loadindex',
		'_type_data_loadindex',
	) );
}

//make sure this order item exists to begin with
foreach( $order as $i => $o )
{
	if( !in_array( $o, array_keys( $output_headings ) ) )
	{
		unset( $order[$i] );
	}
}

$output_headings = array_merge( array_flip( $order ), $output_headings );


$catlist = array();
$all_taxonomies = $metamap['taxonomy'];

foreach( $all_taxonomies as $slug => $label )
{
	$cats = wp_get_post_terms( $post_ID, $slug, array("fields" => "all") );
	if( !empty( $cats ) )
	{
		foreach( $cats as $c )
		{
			//http://localhost/triangle/applications/underground-mining/
			$link = '<a href="'. get_bloginfo( 'home' ) .'/'. $c->taxonomy .'/'. $c->slug.'">'. $c->name .'</a>';
			$catlist[] = $link;
		}
	}

}
$prod_code = array(
	1 => '<li class="primary">&#9679;</li>',
	2 => '<li class="secondary">&#9679;</li>',
	3 => '<li class="third">&#9679;</li>',
);
$ids = array(
	$post_ID,
)
?>

<?php if( !isset( $skip_header ) ) { ?>
<div class="js-printblock">
	<div class="interiorbanner expanded row no-print">
		<div class="large-12">
			<?php
				if( get_post_type() == 'offroad_tires' ) {

					echo '<img src="https://triangletireus.com/wp-content/themes/triangle-new/images/OTR_banner.jpg">';

				} elseif ( get_post_type() == 'truckbus_tires' ) {

					echo '<img src="https://triangletireus.com/wp-content/themes/triangle-new/images/TBR_banner.jpg">';
					
				} elseif ( get_post_type() == 'passenger_tires' ) {

					echo '<img src=" https://triangletireus.com/wp-content/themes/triangle-new/images/passenger-tire-header.jpg">';
				}
			?>
		</div>
	</div>
	<div class="row">
		<div class="medium-7 large-9 columns">
			<h1>
				<a href="<?php bloginfo( 'home' ); ?>/<?php echo $this_link; ?>">
					<?php echo $this_label; ?>
				</a>
			</h1>
		</div>
		<div class="medium-5 large-3 columns emailprint no-print">
			<button class="button js-init-batchprint" type="button" data-id="<?php echo $post_ID; ?>">Print</button> &nbsp; <a href="mailto:?subject=<?php echo sanitize_title( get_the_title( $post_ID ) ); ?>&body=<?php echo urlencode(get_the_permalink( $post_ID ) . "%0D%0A%0D%0A" ) ?>" class="button" target="_top" data-id="<?php echo $post_ID; ?>">Email</a>

		</div>
	</div>
	<div class="row">
		<div class="large-12 columns divider"><hr></div>
	</div>
	<?php } ?>
	<div class="tirelist productdetail row" data-equalizer>
		<div class="medium-4 large-4 tiredetailcol columns" data-equalizer-watch>
			<div class="productimage text-center">
				<img src="<?php echo $img; ?>" />
			</div>
		</div>
		<div class="medium-8 large-8 columns" data-equalizer-watch>
			<div class="tireheaderwrap">
				<h2><?php the_title(); ?></h2>
				<?php if( !$hide_warranty ) { ?>
				<div class="additionaltireinfo">
					<img src="<?php bloginfo( 'template_url' ); ?>/images/guarantee-icon.png">
					<?php
					if( isset( $listed['_type_core_warranty'] ) && !empty( $listed['_type_core_warranty'] ) )
					{
						?>
						<br>
						Warranty <span class="warrantymileage"><?php echo $listed['_type_core_warranty']; ?></span>
						<?php
					}
					?>
				</div>
				<?php } ?>
			</div>
			<div class="tireinfo">
				<?php
				if( !empty( $catlist ) )
				{
					echo '<i>'. implode( ' &#8226; ', $catlist ) .'</i><br />';
				}
				if( isset( $listed['_type_core_prod_heading'] ) && !empty( $listed['_type_core_prod_heading'] ) )
				{
					echo '<h3>' . $listed['_type_core_prod_heading'] . '</h3>';
				}
				if( isset( $listed['_type_core_description'] ) && !empty( $listed['_type_core_description'] ) )
				{
					echo $listed['_type_core_description'];
				}
				?>
			</div>
		</div>
	</div>
	<div class="row tablerow">
		<div class="large-12 tablewrap">
			<table class="text-center table-scroll" cellspacing=0>
				<thead>
				<tr>
					<?php
					foreach( $output_headings as $type => $val )
					{
						echo '<th width="150">' . $val . '</th>';
					}
					?>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach( $output_tires as $tire )
				{
					echo '<tr>';
					foreach( $output_headings as $type => $val )
					{
						$out = isset( $tire[$type] ) ? $tire[$type] : 'N/A';

						if( $type == '_productcode' )
						{
							$notation = $tire['_notation'][0];
							?>
							<td>
								<table class="productcodemenu" cellspacing=0>
									<tr>
										<td>
											<ul class="vertical">
												<?php
												foreach( range( 1, $notation ) as $i )
												{
													echo isset( $prod_code[$i] ) ? $prod_code[$i] : '';
												}
												?>
											</ul>
										</td>
										<td><?php echo $out; ?></td>
									</tr>
								</table>
							</td>
							<?php
						}
						else
						{
							echo '<td>';
							echo $out;
							echo '</td>';
						}
					}
					echo '</tr>';
				}
				?>
				</tbody>
			</table>
		</div>
		<div class="menu-fade">
			<i class="fa fa-chevron-right" aria-hidden="true"></i>
		</div>
	</div>
	<div class="row">
		<div class="large-12 footerlegend">
			<span class="primary">&#9679;</span> <span class="legend">  &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp; primary notation</span><br>
			<span class="secondary">&#9679;</span> <span class="legend">  &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp; secondary notation</span><br>
			<span class="third">&#9679;</span> <span class="legend">  &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp; third notation</span>
		</div>
	</div>
<?php if( !isset( $skip_header ) ) { ?>
</div><!--end js-printblock-->
<?php } ?>