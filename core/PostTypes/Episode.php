<?php
/**
 * Handles the 'episode' custom post type.
 *
 * @package RM_PODCAST\PostTypes
 */

namespace RM_PODCAST\PostTypes;

use RM_PODCAST\Base\BaseController;

/**
 * Class Episode.
 */
class Episode extends BaseController {

	/**
	 * The post type slug.
	 *
	 * @var string
	 */
	private string $post_type = 'episode';

	/**
	 * Defines the meta fields for the Episode post type.
	 *
	 * @var array
	 */
	private array $episode_fields = array();

	/**
	 * Episode constructor.
	 */
	public function __construct() {
		// Constructor is deliberately left empty to prevent premature translation loading.
	}

	/**
	 * Register the necessary hooks.
	 *
	 * @return void
	 */
	public function register(): void {
		add_action( 'init', array( $this, 'define_fields' ), 5 );
		add_action( 'init', array( $this, 'register_post_type' ), 10 );
		add_action( 'init', array( $this, 'register_meta_fields' ), 10 );
	}

	/**
	 * Defines the structure of the meta fields.
	 * * Must be public to be hooked into the init action.
	 *
	 * @return void
	 */
	public function define_fields() {
		$this->episode_fields = array(
			'id'                  => array(
				'label'    => __( 'Episode ID', 'matt-mission-core' ),
				'type'     => 'integer',
				'sanitize' => 'intval',
				'group'    => 'general',
			),
			'youtube_id'          => array(
				'label'    => __( 'YouTube Video ID', 'matt-mission-core' ),
				'type'     => 'string',
				'sanitize' => 'sanitize_text_field',
				'group'    => 'general',
			),
			'youtube_url'         => array(
				'label'    => __( 'YouTube URL', 'matt-mission-core' ),
				'type'     => 'string',
				'sanitize' => 'esc_url_raw',
				'group'    => 'general',
			),
			'youtube_description' => array(
				'label'    => __( 'YouTube Description', 'matt-mission-core' ),
				'type'     => 'string',
				'sanitize' => 'wp_kses_post',
				'group'    => 'general',
			),
			'youtube_date'        => array(
				'label'    => __( 'YouTube Date', 'matt-mission-core' ),
				'type'     => 'string',
				'sanitize' => 'sanitize_text_field',
				'group'    => 'general',
			),
		);
	}

	/**
	 * Register the 'episode' custom post type.
	 *
	 * @return void
	 */
	public function register_post_type() {
		$labels = array(
			'name'          => _x( 'Episodes', 'Post type general name', 'matt-mission-core' ),
			'singular_name' => _x( 'Episode', 'Post type singular name', 'matt-mission-core' ),
			'menu_name'     => _x( 'Episodes', 'Admin Menu text', 'matt-mission-core' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array(
				'slug'       => 'episodes',
				'with_front' => true,
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 22,
			'supports'           => array( 'title', 'editor', 'revisions', 'thumbnail', 'custom-fields' ),
			'taxonomies'         => array( 'podcast-type-category' ),
			'menu_icon'          => 'dashicons-tag',
			'show_in_rest'       => true,
			'template'           => array(
				array(
					'stackable/video-popup',
					array(),
					array(
						array( 'stackable/icon', array() ),
						array( 'stackable/image', array() ),
					),
				),
				array(
					'core/heading',
					array(
						'level' => 2,
					),
				),
				array(
					'core/paragraph',
					array(),
				),
			),
		);

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register meta fields for the REST API.
	 *
	 * @return void
	 */
	public function register_meta_fields() {
		foreach ( $this->episode_fields as $field_key => $details ) {
			register_post_meta(
				$this->post_type,
				'mattonmission_' . $field_key,
				array(
					'show_in_rest' => true,
					'single'       => true,
					'type'         => $details['type'],
				)
			);
		}
	}
}
