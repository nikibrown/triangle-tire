<?php

/**
 * ImportHelper.php
 *
 * @version 1.0
 * @date 6/18/17 11:40 AM
 * @package triangle
 */
class ImportHelper
{
	public static $all_options = array(
		//'Brand',
		'Product Code',
		'Tire Size',
		'Pattern',
		'Load Range',
		'Load Symbol',
		'Load/Speed',
		'Industry Code',
		'Pr',
		'PR',
		'Loading Index',
		'Speed Rating',
		'Speed Index',
		'Tread Depth [Mm]',
		'Tread Depth [in]',
		'Tread Depth [32Nds]',
		'Tread Depth [1/32in]',
		'Rim Width & Flange',
		'Rim Width',
		'Section Width [in]',
		'Section Width [mm]',
		'Overall Width [in]',
		'Overall Diameter [in]',
		'Overall Diameter [mm]',
		'Standard Rim',
		'Alternative Rim',
		'Overall Diameter [Mm]',
		'Single Max Load [Lbs]',
		'Max Load [Lbs]',
		'WEIGHT (lb)',
		'Dual Max Load [Lbs]',
		'Max Load [Kg]',
		'Pressure [Psi]',
		'Pressure [Kpa]',
		'Max Pressure [Psi]',
		'Tube',
		'Utqg',
		'UTQG',
		'Static Load Radius [in]',
		'Minimum Dual Spacing [in]',
		'TT/TL',
		'Tmph [T1]',
		'Tmph [T2]',
		'Tmph [T2A]',
		'Tmph [T2B]',
		'Tmph [T2C]',
		'Tmph [T2D]',
		'Tmph [T3]',
		'Compound Code',
		'Compound Description',
		'Application Characteristics',
		'Minimum Dual Spacing',
		'Static Load Radius',
		'Ply Rating',
		'Load Index',
		'PSI',
		'Features & Benefits',
		'Weight (Lbs)',
		'Ply Rating',
		'Load Index',
		'Tread Depth [32nds]',
		'Alternative Rim',
		'Section Width [in]',
	);


	/**
	 * @type array
	 */
	public static $mapped = [];

	/**
	 * @type
	 */
	protected $wpdb;

	public function __construct()
	{
		if ( !defined('ABSPATH') ) {
			/** Set up WordPress environment */
			require_once( '../../../../wp-load.php' );
		}
		global $wpdb;
		$this->wpdb = $wpdb;
	}


	/**
	 * @param $reader
	 * @return array
	 */
	public function deep_parse( $reader )
	{
		$headings = array();
		foreach( $reader as $position => $row )
		{
			foreach( $row as $k => $v )
			{
				$headings[$k] = ImportHelper::match_key( $v );
			}
			break;
		}

		$groups = array();

		$tires = array();
		$added = array();
		foreach( $reader as $k => $item )
		{
			if( $k == 0 )
			{
				continue;
			}

			foreach( $item as $position => $row )
			{
				if( empty( $row ) )
				{
					unset( $item[$position] );
					continue;
				}

				$item[$headings[$position]] = $row;
				unset( $item[$position] );
			}
			$added[] = $item;
		}

		//Loop the loop to match subtypes to types
		foreach( $added as $k => $v )
		{
			if( empty( $v['post_title'] ) )
			{
				continue;
			}
			$groups[$v['post_title']][] = $v;
		}
		unset( $added );

		//Now REloop to get the meta + core + taxonomy more logically grouped

		$types = $this->metakey_maps();

		$core_meta = array(
			'_prod_heading' => '_type_core_prod_heading',
			'_description' => '_type_core_description',
			'_warranty' => '_type_core_warranty',
			'_warranty_details' => '_type_core_warranty_details',
			'_featured' => '_type_core_featured',
		);

		$cleaned = array();
		foreach( $groups as $tire => $item )
		{
			$core = array();
			$core[$tire] = array(
				'post_type' => $item[0]['post_type'],
				'post_title' => $item[0]['post_title'],
				'post_author' => $item[0]['post_author'],
			);

			$items_core = array();
			$inner = array();
			$tax = array();

			foreach( $item as $items )
			{
				unset( $items['post_type'], $items['post_title'], $items['post_author'] );
				foreach( $items as $k => $v )
				{
					if( in_array( trim( $k ), $types['taxonomy'] ) )
					{
						if( !empty( $v ) )
						{
							$tax[trim( $k )] = array_filter( array_map( 'trim', explode( '/', $v ) ) );
						}
						unset( $items[$k] );
					}
					if( !in_array( trim( $k ), array_keys( $types['meta'] ) ) )
					{
						unset( $items[$k] );
					}
					if( trim( $k ) == '_description' )
					{
						$dat = array_filter( array_map( 'trim', explode( '∙', $v ) ) );
						if( empty( $dat ) )
						{
							continue;
						}
						$val = '<ul>';
						foreach( $dat as $d )
						{
							$val .= '<li>'. trim( $d ) .'</li>';
						}
						$val .= '</ul>';
						$items[$k] = trim( $val );
					}
				}

				if( !isset( $items['notation'] ) )
				{
					$items['_notation'] = array( 1 );
				}

				foreach( $items as $d => $i )
				{
					if( in_array( $d, array_keys( $core_meta ) ) )
					{
						$items_core[$core_meta[trim( $d )]] = $i;
						unset( $items[$d] );
						continue;
					}
				}

				$inner[] = $items;
			}

			$meta = array_merge( $items_core, array( '_type_data' => $inner ) );
			$cleaned[] = array(
				'core' => $core,
				'taxonomy' => $tax,
				'meta' => $meta,
			);
			unset( $groups[$tire] );
		}
		unset( $groups );

		return $cleaned;
	}


	/**
	 * @param array $records
	 * @return array
	 */
	public function import( array $records )
	{
		$maps = $this->metakey_maps();

		$returns = array();
		foreach( $records as $record )
		{
			$returns[] = $this->add_record( $record, $maps['core'], $maps['taxonomy'], $maps['meta'] );
		}
		return $returns;
	}


	/**
	 * @param array $record
	 * @param array $parser_core_fields
	 * @param array $parser_taxonomy_fields
	 * @param array $parser_meta_fields
	 * @return bool|int|WP_Error
	 */
	public function add_record( array $record, $parser_core_fields = array(), $parser_taxonomy_fields = array(), $parser_meta_fields = array() )
	{
		if( empty( $record ) )
		{
			return false;
		}


		$add_core = array();
		foreach( $record['core'] as $k )
		{
			foreach( $k as $i => $v )
			{
				$add_core[$i] = $v;
			}
			break;
		}

		$add_meta = $record['meta'];
		$add_tax = $record['taxonomy'];

		if( empty( $add_core ) )
		{
			return false;
		}

		if( !empty( $add_tax ) )
		{
			$added_taxonomies = array();
			$taxonomies = get_taxonomies();

			foreach( $add_tax as $values )
			{
				foreach( $values as $v )
				{
					foreach ( $taxonomies as $tax_type_key => $taxonomy )
					{
						// If term object is returned, break out of loop. (Returns false if there's no object)
						if ( $term_object = get_term_by( 'slug', $v, $taxonomy ) )
						{
							$added_taxonomies[$term_object->taxonomy][] = $term_object->term_id;
							break;
						}
					}
				}
			}
		}


		$defaults = array(
			'comment_status'	=>	'closed',
			'ping_status'		=>	'closed',
			'post_status'		=>	'publish',
			'post_type'		=>	'post',
			'meta_input' => $add_meta,
		);
		$item = array_merge( $defaults, $add_core );

		//return $item;

		$exists = null; //get_page_by_title( $item['post_title'], OBJECT, $item['post_type'] );
		if( is_null( $exists ) )
		{
			$post_id = wp_insert_post( $item );
		}
		else
		{
			$item['post_id'] = $exists->ID;
			wp_update_post( $item );
			$post_id = $exists->ID;
		}

		if( isset( $added_taxonomies ) && !empty( $added_taxonomies ) )
		{
			foreach( $added_taxonomies as $taxonomy => $value )
			{
				wp_set_post_terms( $post_id, $value, $taxonomy );
			}
		}

		return $post_id;
	}


	/**
	 * @return array
	 */
	public function metakey_maps()
	{
		if( empty( self::$mapped ) )
		{
			$parser_core_fields = array(
				'post_title' => 'Tire Name',
				'post_author' => 'Author',
				'post_type' => 'Import Type',

			);

			$parser_taxonomy_fields = array(
				'category' => 'Category', //passenger
				'categories' => 'Categories', //passenger
				'passenger_size' => 'Tire Size',

				'application' => 'Application', //Truck & Bus Tires
				'position' => 'Position', //Truck & Bus Tires
				'feature' => 'Feature', //Truck & Bus Tires
				'tb_size' => 'Tire Size',

				'applications' => 'Applications', //Off-The-Road Tire
				'classification' => 'Classification', //Off-The-Road Tire
				'equipment' => 'Equipment', //Off-The-Road Tire
				'of_size' => 'Tire Size',
                'radialbias' => 'Type',
			);

			$parser_meta_fields = array(
				'prod_heading' => 'heading',
				'description' => 'description',
				'warranty' => 'warranty',
				'warranty_details' => 'warranty details',
				'featured' => 'Featured Product?',
				'notation' => 'notation',
			);
			foreach( $parser_meta_fields as $k => $v )
			{
				$parser_meta_fields[self::keypend( $k )] = trim( strtoupper( $v ) );
				unset( $parser_meta_fields[$k] );
			}

			foreach( self::$all_options as $k => $v )
			{
				$parser_meta_fields[self::keypend( $v )] = trim( strtoupper( $v ) );
			}
			//$all_meta_fields = array_map( array( $this, 'keypend' ), self::$all_options );
			//$parser_meta_fields = array_merge( $parser_meta_fields, $all_meta_fields );

			$all_parser_fields = array_merge( $parser_core_fields, $parser_taxonomy_fields, $parser_meta_fields );
			
			self::$mapped = array(
				'core' => $parser_core_fields,
				'taxonomy' => $parser_taxonomy_fields,
				'meta' => $parser_meta_fields,
				'all' => $all_parser_fields,
			);
			
			return self::$mapped;
		}


		return self::$mapped;
	}


	public static function keypend( $input )
	{
		return '_' . strtolower( trim( preg_replace( '/[^A-Za-z0-9_]+/', '', $input ) ) );
	}


	/**
	 * @param $input
	 * @return string
	 */
	public static function match_key( $input )
	{
		$item = new self;
		$maps = $item->metakey_maps();


		$input = trim( $input );
		if( in_array( $input, array_values( $maps['core'] ) ) )
		{
			$find = array_flip( $maps['core'] );
			return $find[$input];
		}

		if( in_array( strtoupper( $input ), array_values( $maps['meta'] ) ) )
		{
			$find = array_flip( $maps['meta'] );
			return $find[strtoupper( $input )];
		}

		return $input;

	}

}