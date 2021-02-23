<?php
/**
 * tire-detail-inner.php
 *
 * @version 1.0
 * @date 6/12/17 10:26 AM
 * @package triangle
 */
$this_type = get_post_type_object( get_post_type( get_the_ID() ) );
$this_label = $this_type->label;
$this_link = $this_type->rewrite['slug'];
$img = featured_image( get_the_ID(), 'full', get_bloginfo( 'template_url' ) .'/images/tr257.png' );
$hero_image = get_bloginfo( 'template_url' ) .'/images/passenger-tire-header.jpg';
$meta = get_post_meta( get_the_ID() );
$options = get_options();
$listed = array();
$skiplist = array(
	'_type_data_prod_heading',
	'_type_data_description',
	'_type_data_warranty',
	'_type_data_notation',
);
foreach( $meta as $k => $v )
{
	if( !in_array( $k, array_keys( $options ) ) )
	{
		continue;
	}
	if( in_array( $k, $skiplist ) || !isset( $options[$k] ) )
	{
		continue;
	}

	$listed[$options[$k]] = $v[0];
}
$cats = get_the_terms( get_the_ID(), 'categories' );
$catlist = array();
if( !empty( $cats ) )
{
	foreach( $cats as $c )
	{
		$catlist[] = $c->term_name;
	}
}

$notation = unserialize( $meta['_type_data_notation'][0] );
$notation = !empty( $notation ) ? $notation[0] : 1;
$notation = intval( $notation );
$prod_code = array(
	1 => '<li class="primary">&#9679;</li>',
	2 => '<li class="secondary">&#9679;</li>',
	3 => '<li class="third">&#9679;</li>',
);
?>
<div id="js-printblock">
	<div class="interiorbanner expanded row">
		<div class="large-12">
			<img src="<?php echo $hero_image; ?>" />
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
			<button class="button js-print" type="button" data-id="<?php echo get_the_ID(); ?>">Print</button> &nbsp; <button class="button js-email" type="button" data-id="<?php echo get_the_ID(); ?>">Email</button>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns divider"><hr></div>
	</div>
	<div class="tirelist productdetail row">
		<div class="medium-5 large-6 tiredetailcol columns">
			<div class="productimage text-center">
				<img src="<?php echo $img; ?>" />
			</div>
		</div>
		<div class="medium-7 large-6 columns">
			<div class="tireheaderwrap">
				<h2><?php the_title(); ?></h2>
				<div class="additionaltireinfo">
					<img src="<?php bloginfo( 'template_url' ); ?>/images/guarantee-icon.png">
					<?php
					if( isset( $meta['_type_data_warranty'] ) && !empty( $meta['_type_data_warranty'] ) )
					{
						?>
						<br>
						Warranty <span class="warrantymileage"><?php echo $meta['_type_data_warranty'][0]; ?></span>
						<?php
					}
					?>
				</div>
			</div>
			<div class="tireinfo">
				<?php
				if( isset( $meta['_type_data_prod_heading'] ) && !empty( $meta['_type_data_prod_heading'] ) )
				{
					echo '<h3>' . $meta['_type_data_prod_heading'][0] . '</h3>';
				}
				if( isset( $meta['_type_data_description'] ) && !empty( $meta['_type_data_description'] ) )
				{
					echo $meta['_type_data_description'][0];
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
					foreach( $listed as $heading => $value )
					{
						echo '<th width="150">' . $heading . '</th>';
					}
					?>
				</tr>
				</thead>
				<tbody>
				<tr>
					<?php
					foreach( $listed as $heading => $value )
					{
						if( $heading == 'Product Code' )
						{
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
										<td><?php echo $value; ?></td>
									</tr>
								</table>
							</td>
							<?php
						}
						else
						{
							echo '<td>' . $value . '</td>';
						}
					}
					?>
				</tr>
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
</div><!--end js-printblock-->