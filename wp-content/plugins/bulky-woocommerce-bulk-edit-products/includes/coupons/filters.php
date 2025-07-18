<?php

namespace BULKY\Includes\Coupons;

defined( 'ABSPATH' ) || exit;

class Filters {

	protected static $instance = null;
	public $filter;
	protected $type = 'coupons';

	public function __construct() {
		$user_id      = get_current_user_id();
		$this->filter = get_transient( "vi_wbe_filter_{$this->type}_data_{$user_id}" );

		add_filter( 'posts_join', [ $this, 'add_filter_to_posts_join' ] );
		add_filter( 'posts_where', [ $this, 'add_filter_to_posts_where' ] );
		add_filter( 'woocommerce_coupon_data_store_cpt_get_coupons_query', [ $this, 'coupon_data_store_cpt_get_coupons_query' ], 10, 2 );
	}

	public static function instance() {
		return null == self::$instance ? self::$instance = new self : self::$instance;
	}

	public function set_args( $args ) {
		$filter = $this->filter;

		if ( empty( $filter ) ) {
			return $args;
		}

		if ( ! empty( $filter['id'] ) && strpos( $filter['id'], '-' ) === false ) {
			$args['post__in'] = explode( ',', str_replace( ' ', '', $filter['id'] ) );
		}

		$string_type = [ 'post_status' ];
		foreach ( $string_type as $key ) {
			if ( ! empty( $filter[ $key ] ) ) {
				$args[ $key ] = $filter[ $key ];
			}
		}

		if ( ! empty( $filter['discount_type'] ) ) {
			// @codingStandardsIgnoreLine
			$args['meta_query'][] = [ 'key' => 'discount_type', 'value' => $filter['discount_type'],'compare' => '=' ];
		}

		if ( ! empty( $filter['has_expire_date'] ) && 'yes' === $filter['has_expire_date'] ) {
			if ( ! empty( $filter['expiry_date_from'] ) ) {
				$args['meta_query'][] = [
					'key'     => 'date_expires',
					'value'   => strtotime( $filter['expiry_date_from'] ),
					'compare' => '>='
				];
			}

			if ( ! empty( $filter['expiry_date_to'] ) ) {
				$args['meta_query'][] = [
					'key'     => 'date_expires',
					'value'   => strtotime( $filter['expiry_date_to'] ),
					'compare' => '<='
				];
			}
		}

		if ( ! empty( $filter['amount_from'] ) ) {
			$args['meta_query'][] = [
				'key'     => 'coupon_amount',
				'value'   => $filter['amount_from'],
				'compare' => '>='
			];
		}

		if ( ! empty( $filter['amount_to'] ) ) {
			$args['meta_query'][] = [
				'key'     => 'coupon_amount',
				'value'   => $filter['amount_to'],
				'compare' => '<='
			];
		}

		if ( ! empty( $filter['allow_free_shipping'] ) ) {
			$args['meta_query'][] = [
				'key'     => 'free_shipping',
				'value'   => $filter['allow_free_shipping'],
				'compare' => '='
			];
		}

		$args['meta_query']['relation'] = 'AND';

		return $args;
	}

	public function coupon_data_store_cpt_get_coupons_query( $wp_query_args, $query_vars ) {
		if ( empty( $this->filter ) ) {
			return $wp_query_args;
		}

		if ( ! empty( $this->filter['operator'] ) ) {
			foreach ( $this->filter['operator'] as $meta_key => $operator ) {
				$value = $this->filter[ $meta_key ] ?? '';
				if ( is_array( $value ) ) {
					$value = array_filter( $value );
				}

				if ( empty( $value ) ) {
					continue;
				}

				$compare = 'or' == $operator ? 'IN' : 'NOT IN';

				$wp_query_args['meta_query'][] = [
					'key'     => $meta_key,
					'value'   => $this->filter[ $meta_key ],
					'compare' => $compare
				];
			}
		}

		if ( ! empty( $this->filter['behavior'] ) ) {
			foreach ( $this->filter['behavior'] as $meta_key => $behavior ) {
				$value = $this->filter[ $meta_key ] ?? '';
				if ( is_array( $value ) ) {
					$value = array_filter( $value );
				}

				if ( empty( $value ) ) {
					continue;
				}

				$compare = 'like' == $behavior ? 'LIKE' : ( 'exact' == $behavior ? '=' : 'NOT LIKE' );

				$wp_query_args['meta_query'][] = [
					'key'     => $meta_key,
					'value'   => $this->filter[ $meta_key ],
					'compare' => $compare
				];
			}
		}

		if ( ! empty( $wp_query_args['tax_query'] ) ) {
			$wp_query_args['tax_query']['relation'] = 'AND';
		}

		return $wp_query_args;
	}

	public function add_filter_to_posts_join( $join ) {
		if ( empty( $this->filter ) ) {
			return $join;
		}

		$filter = $this->filter;

		if ( ! empty( $filter['has_expire_date'] ) && 'no' === $filter['has_expire_date'] ) {
			global $wpdb;
			$join .= " INNER JOIN {$wpdb->postmeta} ON ( {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id )";
		}

		unset( $this->filter );

		return $join;
	}

	public function add_filter_to_posts_where( $where ) {

		if ( empty( $this->filter ) ) {
			return $where;
		}

		global $wpdb;

		$filter = $this->filter;

		if ( ! empty( $filter['id'] ) && strpos( $filter['id'], '-' ) !== false ) {
			$ids      = array_filter( explode( '-', str_replace( ' ', '', $filter['id'] ) ) );
			$count_id = count( $ids );
			if ( 1 == $count_id ) {
				$id    = absint( $ids[0] );
				$where .= " AND {$wpdb->posts}.ID = {$id} ";
			} elseif ( 2 == $count_id ) {
				$start_id = absint( $ids[0] );
				$end_id   = absint( $ids[1] );

				if ( $start_id < $end_id ) {
					$where .= " AND {$wpdb->posts}.ID >= {$start_id} AND {$wpdb->posts}.ID <= {$end_id} ";
				} elseif ( $start_id > $end_id ) {
					$where .= " AND {$wpdb->posts}.ID >= {$end_id} AND {$wpdb->posts}.ID <= {$start_id} ";
				} else {
					$where .= " AND {$wpdb->posts}.ID = {$start_id} ";
				}
			}
		}

		if ( ! empty( $filter['post_date_from'] ) ) {
			$where .= " AND post_date >= '{$filter['post_date_from']}' ";
		}

		if ( ! empty( $filter['post_date_to'] ) ) {
			$where .= " AND post_date <= '{$filter['post_date_to']}' ";
		}

		$product_ids_from_range_type = $this->parse_type_range( $filter );
		if ( ! empty( $product_ids_from_range_type ) ) {
			$product_ids = -1 !== $product_ids_from_range_type ? implode( ',', $product_ids_from_range_type ) : '';
			$where       .= $product_ids ? " AND ( $wpdb->posts.ID IN($product_ids) )" : " AND (1=2)";
		}

		if ( ! empty( $filter['has_expire_date'] ) && 'no' === $filter['has_expire_date'] ) {
			$where .= " AND ( {$wpdb->postmeta}.meta_key = 'date_expires' AND ({$wpdb->postmeta}.meta_value is null OR {$wpdb->postmeta}.meta_value ='' ))";
		}

		$where .= $this->text_search();

		return $where;
	}

	public function parse_type_range( $filter ) {
		$product_ids = [];
		$flag        = 0;

		$fields = [
			[
				'from'    => 'regular_price_from',
				'to'      => 'regular_price_to',
				'metakey' => '_regular_price',
			],
		];

		foreach ( $fields as $field ) {
			if ( ! empty( $filter[ $field['from'] ] ) || ! empty( $filter[ $field['to'] ] ) ) {
				$flag ++;
				$found_ids   = $this->get_product_ids( $filter[ $field['from'] ], $filter[ $field['to'] ], $field['metakey'] );
				$product_ids = empty( $product_ids ) ? $found_ids : array_intersect( $product_ids, $found_ids );
			}
		}

		if ( $flag && empty( $product_ids ) ) {
			return - 1;
		}

		return array_values( array_unique( $product_ids ) );
	}

	public function get_product_ids( $from, $to, $meta_key ) {
		global $wpdb;

		$from = floatval( ! empty( $from ) ) ? $from : 0;
		$to   = floatval( ! empty( $to ) ) ? $to : PHP_INT_MAX;

		$query = "SELECT posts.ID FROM {$wpdb->posts} AS posts
                    LEFT JOIN {$wpdb->postmeta} AS postmeta ON ( posts.ID = postmeta.post_id )
                    WHERE posts.post_type IN ('product','product_variation')
                    AND postmeta.meta_key = '{$meta_key}' AND postmeta.meta_value BETWEEN {$from} AND {$to}";

		return $this->get_parent_product_from_query( $query );
	}

	public function get_product_ids_from_sale_schedule( $from, $to ) {
		global $wpdb;

		$from = floatval( ! empty( $from ) ) ? strtotime( $from ) : 0;
		$to   = floatval( ! empty( $to ) ) ? strtotime( "tomorrow {$to}" ) - 1 : PHP_INT_MAX;

		$query = "SELECT posts.ID FROM {$wpdb->posts} AS posts INNER JOIN {$wpdb->postmeta} AS postmeta ON ( posts.ID = postmeta.post_id )  
					INNER JOIN {$wpdb->postmeta} AS mt1 ON ( posts.ID = mt1.post_id ) 
					WHERE 1=1  AND (( postmeta.meta_key = '_sale_price_dates_from' AND CAST(postmeta.meta_value AS SIGNED) BETWEEN {$from} AND {$to} )
       								 OR ( mt1.meta_key = '_sale_price_dates_to'  AND CAST(mt1.meta_value AS SIGNED) BETWEEN {$from} AND {$to})) 
    				AND posts.post_type  IN ('product','product_variation')  GROUP BY posts.ID ";

		return $this->get_parent_product_from_query( $query );
	}

	public function get_parent_product_from_query( $query ) {
		global $wpdb;
		//phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching,WordPress.DB.PreparedSQL.NotPrepared
		$all_products = $wpdb->get_results( $query, ARRAY_N );
		$all_products = array_column( $all_products, 0 );

		return $this->get_final_parent_products( $all_products );
	}

	public function get_final_parent_products( $all_product_ids ) {
		if ( ! empty( $all_product_ids ) ) {
			global $wpdb;
			$string_all_products = implode( ',', $all_product_ids );
			$_query              = "SELECT posts.post_parent FROM {$wpdb->posts} AS posts WHERE posts.ID IN ({$string_all_products}) AND posts.post_parent > 0";
			$variable_products   = $wpdb->get_results( $_query, ARRAY_N ); //phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching,WordPress.DB.PreparedSQL.NotPrepared
			$variable_products   = array_column( $variable_products, 0 );
			$product_ids         = array_merge( $variable_products, $all_product_ids );
		}

		return $product_ids ?? [];
	}

	public function text_search() {
		$items = array_map( function ( $key ) {
			return [
				'type'     => $key,
				'value'    => $this->filter[ $key ] ?? '',
				'behavior' => $this->filter['behavior'][ $key ] ?? '',
			];
		}, [ 'post_title', 'post_content', 'post_excerpt', 'post_name' ] );

		if ( empty( $items ) || ! is_array( $items ) ) {
			return '';
		}

		$where = '';

		foreach ( $items as $item ) {
			if ( ! $item['value'] && 'empty' !== $item['behavior'] ) {
				continue;
			}

			$type  = $item['type'];
			$value = sanitize_text_field( wp_specialchars_decode( trim($item['value']  ) ) );

			$query = '';
			switch ( $item['behavior'] ) {
				case 'empty':
					$query .= "{$type} =''";
					break;

				case 'exact':
					$query .= "{$type} ='{$value}'";
					break;

				case 'not':
					$query .= "{$type} NOT LIKE '%{$value}%'";
					break;

				case 'begin':
					$query .= "{$type} REGEXP '^{$value}'";
					break;

				case 'end':
					$query .= "{$type} REGEXP '{$value}$'";
					break;

				default:
					$query .= "{$type} LIKE '%{$value}%'";
					break;
			}

			if ( $query ) {
				$where .= " AND ($query)";
			}
		}

		return $where;
	}
}