<?php

/**
 * Pro Widget Filters
 *
 * This file is used to modify the widgets in the Layers.
 *
 * @package Layers
 * @since Layers 1.0
 */
class Layers_Pro_Widget_Filters {

	private static $instance;

	/**
	 * Get Instance creates a singleton class that's cached to stop duplicate instances
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
			self::$instance->init();
		}
		return self::$instance;
	}

	/**
	 * Construct empty on purpose
	 */
	private function __construct() {}

	/**
	 * Init behaves like, and replaces, construct
	 */
	public function init(){

		$this->layers_meta = wp_get_theme( 'layerswp' );

		/**
		* Features supported by Layers 1.5.0
		*/

		if ( !version_compare( $this->layers_meta->get( 'Version' ), '1.5.0', '<' ) ) {

			/**
			 * Add Heading-Type to the Fonts elements.
			 */

			if ( !version_compare( $this->layers_meta->get( 'Version' ), '1.6.5', '<' ) ) {
				$font_key = 'header_excerpt';
			} else {
				$font_key = 'fonts';
			}

			// Showcase
			add_filter( 'layers_design_bar_' . $font_key . '_project_elements', array( $this, 'add_heading_type_controls' ), 10, 2 );

			// Showcase
			add_filter( 'layers_design_bar_fonts_product_elements', array( $this, 'add_heading_type_controls' ), 10, 2 );
			add_filter( 'layers_design_bar_fonts_product-categories_elements', array( $this, 'add_heading_type_controls' ), 10, 2 );
			add_filter( 'layers_design_bar_fonts_product-slider_elements', array( $this, 'add_heading_type_controls' ), 10, 2 );

			/**
			 * Add Advanced-Button-Styling to the Design-Bar components.
			 */
			$widget_element_keys = array(
				// Layers 
				'slide_widget_slide',
				'column_widget_column',
				'post_widget',

				// Layers Pro
				'cta_widget_cta',
				'accordion_widget',
				'tabs_widget',
				'post_carousel_widget',
				'social_widget_social',

				// Showcase
				'showcase_widget',
			);

			foreach( $widget_element_keys as $we_key ){
				add_filter( 'layers_' . $we_key . '_design_bar_components' , array( $this, 'add_button_controls' ), 10, 3 );
			}
		
			/**
			* Add Video BG controls
			**/
			add_filter( 'layers_design_bar_background_slide_item_elements' , array( $this, 'add_slider_controls' ), 10, 2 );
			add_action( 'layers_before_slider_widget_item_inner' , array( $this, 'apply_slider_controls' ), 10, 3 );

			/**
			* Add Parallax to Each Standard Design Bar Background
			**/
			$widget_element_keys = array(

				// Layers
				'column',
				'project',
				'column_item',
				'map',
				'post',
				'slide_item',

				// Layers Pro
				'layers-pro-accordion',
				'layers-pro-call-to-action',
				'layers-pro-post-carousel',
				'layers-pro-post-carousel',
				'layers-pro-social-icons',
				'layers-pro-tabs',
			);

			foreach( $widget_element_keys as $we_key ){
				add_filter( 'layers_design_bar_background_' . $we_key . '_elements' , array( $this, 'add_background_parallax_controls' ), 10, 2 );
			}

			$widget_container_keys = array(

				// Layers
				'slider_widget_item',
				'content_widget_container',
				'content_widget_item',
				'contact_widget_container',
				'post_widget_container',

				// Showcase
				'project_widget_container',

				// Layers Pro
				'post_carousel_widget_container',
				'tabs_widget_container',
				'cta_widget_container',
				'social_widget_container',
				'accordian_widget_container',
			);

			foreach( $widget_container_keys as $w_key ){
				add_action( 'layers_' . $w_key . '_class' , array( $this, 'apply_widget_parallax_controls' ), 10, 3 );
			}
		}

		/**
		* Features supported by Layers 1.6.1
		*/

		if( !version_compare( $this->layers_meta->get( 'Version' ), '1.6.1', '<' ) ) {

			$widget_advanced_keys = array(

				// Layers
				'column',
				'column_item',
				'project',
				'map',
				'post',
				'slide',

				// Layers Pro
				'layers-pro-accordion',
				'layers-pro-call-to-action',
				'layers-pro-post-carousel',
				'layers-pro-post-carousel',
				'layers-pro-social-icons',
				'layers-pro-tabs',
			);

			foreach( $widget_advanced_keys as $we_key ){
				add_filter( 'layers_design_bar_advanced_' . $we_key . '_elements' , array( $this, 'add_mobile_display_controls' ), 10, 2 );
			}

			$widget_advanced_container_keys = array(

				// Layers
				'slider_widget_container',
				'content_widget_container',
				'content_widget_item',
				'contact_widget_container',
				'post_widget_container',

				// Showcase
				'project_widget_container',

				// Layers Pro
				'post_carousel_widget_container',
				'tabs_widget_container',
				'cta_widget_container',
				'social_widget_container',
				'accordian_widget_container',
			);

			foreach( $widget_advanced_container_keys as $w_key ){
				add_action( 'layers_' . $w_key . '_class' , array( $this, 'apply_mobile_display_controls' ), 10, 3 );
			}

		}

		/**
		* Features supported by Layers 1.6.6
		*/
		if ( version_compare( $this->layers_meta->get( 'Version' ), '1.6.6', '>' ) ) {

			/**
			* Add Header Controls
			*/
			$widget_header_keys = array(

				// Layers
				'column',
				'column_item',
				'post',
				'map',
				'slide_item',

				// Showcase
				'project',

				// Layers Pro
				'layers-pro-accordion',
				'layers-pro-call-to-action',
				'layers-pro-post-carousel',
				'layers-pro-post-carousel',
				'layers-pro-social-icons',
				'layers-pro-tabs',
			);

			foreach( $widget_header_keys as $we_key ){
				add_filter( 'layers_design_bar_header_excerpt_' . $we_key . '_elements' , array( $this, 'add_header_excerpt_controls' ), 10, 2 );
			}

			$widget_header_keys = array(

				// Layers
				'slide',
				'column',
				'map',
				'post',

				// Showcase
				'project',

				// Layers Pro
				'layers-pro-accordion',
				'layers-pro-call-to-action',
				'layers-pro-post-carousel',
				'layers-pro-post-carousel',
				'layers-pro-social-icons',
				'layers-pro-tabs',
			);

			foreach( $widget_header_keys as $we_key ){
				add_filter( 'layers_widget_' . $we_key . '_inline_css', array( $this, 'apply_header_controls' ), 10, 3 );
			}
			
			/** 
			* Add Advanced Background controls
			*/
			add_filter( 'layers_background_component_args', array( $this, 'add_background_controls' ), 10, 6 );
			

			/**
			* Add Advanced Post Column Controls
			*/
			$widget_post_column_keys = array(

				// Layers
				'post',

				// Layers Pro
				'layers-pro-post-carousel',

				// StoreKit
				'product-categories',
				'product'
			);
			foreach( $widget_post_column_keys as $wpc_key ){

				add_filter( 'layers_' . $wpc_key . '_component_args', array( $this, 'add_post_column_controls' ), 10, 3 );
			}

			/**
			 * Add Featured-Image-Size to the Feature-Image elements.
			 */
			add_filter( 'layers_design_bar_featuredimage_slide_item_elements' , array( $this, 'add_featured_image_controls' ), 10, 2 );
			add_filter( 'layers_design_bar_featuredimage_column_item_elements' , array( $this, 'add_featured_image_controls' ), 10, 2 );
			add_filter( 'layers_design_bar_featuredimage_layers-pro-tabs_elements' , array( $this, 'add_featured_image_controls' ), 10, 2 );

			$widget_featured_image_keys = array(

				// Layers
				'slide',
				'column',

				// Layers Pro
				'layers-pro-tabs',
			);

			foreach( $widget_featured_image_keys as $we_key ){
				add_filter( 'layers_widget_' . $we_key . '_inline_css', array( $this, 'apply_featured_image_controls' ), 10, 3 );
			}

			/**
			 * Add Animations to the Advanced Design-Bar components.
			 */
			$widget_animation_keys = array(

				// Layers
				'map',
				'column',
				'post',
				'slide',

				// Layers Pro
				'layers-pro-accordion',
				'layers-pro-call-to-action',
				'layers-pro-post-carousel',
				'layers-pro-social-icons',
				'layers-pro-tabs',
			);

			foreach ($widget_animation_keys as $we_key ) {
				add_filter('layers_design_bar_advanced_'. $we_key .'_elements', array($this, 'add_animation_controls'), 10, 3);
			}

			add_action( 'wp_ajax_no_priv_layers_pro_get_font_options', array( $this, 'layers_pro_get_font_options' ) );
			add_action( 'wp_ajax_layers_pro_get_font_options', array( $this, 'layers_pro_get_font_options' ) );

		}
	}


	public function layers_pro_get_font_options(){
		$fonts = array();

		foreach( layers_get_google_font_options() as $key => $font ){
		
			if( FALSE !== strpos( $font, $_POST[ 'term' ] ) || '' == $key || '' == $_POST[ 'term' ] ){
			
				$fonts[ $key ] = $font; 
		
			}
		}
		die( json_encode( $fonts ) );
	}

	/**
	* Add Advanced Header Elements
	*/
	public function add_header_excerpt_controls( $elements, $widget ){
		
		if( 'column_item' == $widget->args['widget_id'] ){

			$fs_defaults = array(
				'header' => array(
					'' => '',
					'small' => 15,
					'medium' => 20,
					'large' => 28,
				),
				'excerpt' => array(
					'' => '',
					'small' => 13,
					'medium' => 15,
					'large' => 20,
				),
			);

		} else {
			
			$fs_defaults = array(
				'header' => array(
					'' => '',
					'small' => 25,
					'medium' => 30,
					'large' => 40,
				),
				'excerpt' => array(
					'' => '',
					'small' => 15,
					'medium' => 20,
					'large' => 25,
				),
			);

		}

		$new_elements = array();

		$elements['fonts-size']['type'] = 'hidden';
		$elements['fonts-size']['class'] = 'layers-hide';

		unset( $elements['fonts-size-start'] );
		unset( $elements['fonts-size']['label'] );
		unset( $elements['fonts-size-end'] );
		
		if( isset( $widget->values['fonts']['size'] ) )
			$fs = $widget->values['fonts']['size'];
		else
			$fs = '';


		foreach( $elements as $key => $element ){

			$new_elements[ $key ] = $element;

			if( 'fonts-header-style-start' == $key ){
				$new_elements['fonts-heading-type'] = array(
					'type' => 'select-icons',
					'name' => $widget->get_layers_field_name( 'fonts', 'heading-type' ),
					'id' => $widget->get_layers_field_id( 'fonts', 'heading-type' ),
					'value' => ( isset( $widget->values['fonts']['heading-type'] ) ) ? $widget->values['fonts']['heading-type'] : NULL,
					'options' => array(
						'h1' => array( 'name' => __( 'H1', 'layerswp' ), 'class' => 'icon-heading-1', 'data' => '' ),
						'h2' => array( 'name' => __( 'H2', 'layerswp' ), 'class' => 'icon-heading-2', 'data' => '' ),
						'h3' => array( 'name' => __( 'H3', 'layerswp' ), 'class' => 'icon-heading-3', 'data' => '' ),
						'h4' => array( 'name' => __( 'H4', 'layerswp' ), 'class' => 'icon-heading-4', 'data' => '' ),
						'h5' => array( 'name' => __( 'H5', 'layerswp' ), 'class' => 'icon-heading-5', 'data' => '' ),
						'h6' => array( 'name' => __( 'H6', 'layerswp' ), 'class' => 'icon-heading-6', 'data' => '' ),
					),
					'class' => 'layers-icon-group-inline layers-icon-group-inline-outline',
				);
			}

			if( 'fonts-color' == $key ){

				 if( isset( $category_ids ) && '' != $category_ids ){
					foreach ( explode( ',', $category_ids ) as $category_id ) {

						$term = get_term( $category_id, $this->taxonomy );

						$select_terms[] = array( 'id' => $term->term_id, 'text' => esc_attr( $term->name ) );
					}
				} 

				$new_elements['header-text-size'] = array(
					'type' => 'inline-numbers-fields',
					'label' => '',
					'name' => $widget->get_layers_field_name( 'header-text-size' ),
					'id' => $widget->get_layers_field_id( 'header-text-size' ),
					'value' => ( isset( $widget->values['header-text-size'] ) ) ? $widget->values['header-text-size'] : array( 'font-size' => $fs_defaults['header'][$fs] ),
					'fields' => array(
						'font-size' => 'Size',
						'line-height' => 'Line Height',
						'letter-spacing' => 'Spacing',
					),
					// 'input_class' => 'inline-fields-flush',
				);
				$new_elements['header-font-weight'] = array(
					'type' => 'select-icons',
					'label' => '',
					'name' => $widget->get_layers_field_name( 'header-font-weight' ),
					'id' => $widget->get_layers_field_id( 'header-font-weight' ),
					'value' => ( isset( $widget->values['header-font-weight'] ) ) ? $widget->values['header-font-weight'] : NULL,
					'options' => array(
						'lighter' => array( 'name' => __( 'Light', 'layerswp' ), 'class' => 'icon-font-weight-light', 'data' => '' ),
						'normal' => array( 'name' => __( 'Normal', 'layerswp' ), 'class' => 'icon-font-weight-normal', 'data' => '' ),
						'bold' => array( 'name' => __( 'Bold', 'layerswp' ), 'class' => 'icon-font-weight-bold', 'data' => '' ),
					),
					'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-icon-group-inline-flexible',
				);

				$new_elements['header-font-style'] = array(
					'type' => 'select-icons',
					'label' => '',
					'group' => array(
						'header-font-style-italic' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'header-font-style', 'italic' ),
							'id' => $widget->get_layers_field_id( 'header-font-style', 'italic' ),
							'value' => ( isset( $widget->values['header-font-style']['italic'] ) ) ? $widget->values['header-font-style']['italic'] : NULL,
							'options' => array(
								'italic' => array(
									'class' => 'icon-font-italic',
									'data' => ''
								),
							),
						),
						'header-font-style-underline' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'header-font-style', 'underline' ),
							'id' => $widget->get_layers_field_id( 'header-font-style', 'underline' ),
							'value' => ( isset( $widget->values['header-font-style']['underline'] ) ) ? $widget->values['header-font-style']['underline'] : NULL,
							'options' => array(
								'underline' => array(
									'class' => 'icon-font-underline',
									'data' => ''
								),
							),
						),
						'header-font-style-strikethrough' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'header-font-style', 'strikethrough' ),
							'id' => $widget->get_layers_field_id( 'header-font-style', 'strikethrough' ),
							'value' => ( isset( $widget->values['header-font-style']['strikethrough'] ) ) ? $widget->values['header-font-style']['strikethrough'] : NULL,
							'options' => array(
								'strikethrough' => array(
									'class' => 'icon-font-strike-through',
									'data' => ''
								),
							),
						),
						'header-font-style-uppercase' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'header-font-style', 'uppercase' ),
							'id' => $widget->get_layers_field_id( 'header-font-style', 'uppercase' ),
							'value' => ( isset( $widget->values['header-font-style']['uppercase'] ) ) ? $widget->values['header-font-style']['uppercase'] : NULL,
							'options' => array(
								'uppercase' => array(
									'class' => 'icon-font-text-transform',
									'data' => ''
								),
							),
						),
					),
					'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-icon-group-inline-flexible',
				);
			}

			if( 'fonts-excerpt-color' == $key ){
				
				$new_elements['excerpt-text-size'] = array(
					'type' => 'inline-numbers-fields',
					'label' => '',
					'name' => $widget->get_layers_field_name( 'excerpt-text-size' ),
					'id' => $widget->get_layers_field_id( 'excerpt-text-size' ),
					'value' => ( isset( $widget->values['excerpt-text-size'] ) ) ? $widget->values['excerpt-text-size'] : array( 'font-size' => $fs_defaults['excerpt'][$fs] ),
					'fields' => array(
						'font-size' => 'Size',
						'line-height' => 'Line Height',
						'letter-spacing' => 'Spacing',
					),
					// 'input_class' => 'inline-fields-flush',
				);

				$new_elements['excerpt-font-weight'] = array(
					'type' => 'select-icons',
					'label' => '',
					'name' => $widget->get_layers_field_name( 'excerpt-font-weight' ),
					'id' => $widget->get_layers_field_id( 'excerpt-font-weight' ),
					'value' => ( isset( $widget->values['excerpt-font-weight'] ) ) ? $widget->values['excerpt-font-weight'] : NULL,
					'options' => array(
						'light' => array( 'name' => __( 'Light', 'layerswp' ), 'class' => 'icon-font-weight-light', 'data' => '' ),
						'normal' => array( 'name' => __( 'Normal', 'layerswp' ), 'class' => 'icon-font-weight-normal', 'data' => '' ),
						'bold' => array( 'name' => __( 'Bold', 'layerswp' ), 'class' => 'icon-font-weight-bold', 'data' => '' ),
					),
					'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-icon-group-inline-flexible',
				);

				$new_elements['excerpt-font-style'] = array(
					'type' => 'select-icons',
					'label' => '',
					'group' => array(
						'excerpt-font-style-strikethrough' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'excerpt-font-style', 'strikethrough' ),
							'id' => $widget->get_layers_field_id( 'excerpt-font-style', 'strikethrough' ),
							'value' => ( isset( $widget->values['excerpt-font-style']['strikethrough'] ) ) ? $widget->values['excerpt-font-style']['strikethrough'] : NULL,
							'options' => array(
								'strikethrough' => array(
									'class' => 'icon-font-strike-through',
									'data' => ''
								),
							),
						),
						'excerpt-font-style-uppercase' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'excerpt-font-style', 'uppercase' ),
							'id' => $widget->get_layers_field_id( 'excerpt-font-style', 'uppercase' ),
							'value' => ( isset( $widget->values['excerpt-font-style']['uppercase'] ) ) ? $widget->values['excerpt-font-style']['uppercase'] : NULL,
							'options' => array(
								'uppercase' => array(
									'class' => 'icon-font-text-transform',
									'data' => ''
								),
							),
						),
					),
					'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-icon-group-inline-flexible',
				);

			}
		}

		// Add elements
		$replace_elements['fonts-align-start'] = $new_elements['fonts-align-start'];
		$replace_elements['fonts-align'] = $new_elements['fonts-align'];
		$replace_elements['fonts-align-end'] = $new_elements['fonts-align-end'];

		unset( $new_elements['fonts-align-start'] );
		unset( $new_elements['fonts-align'] );
		unset( $new_elements['fonts-align-end'] );


		return $new_elements + $replace_elements;
	}

	public function apply_header_controls( $inline_css, $widget, $instance ) {

		if( empty( $widget ) || empty( $instance ) ) return $inline_css;

		$header_css = array();
		$excerpt_css = array();

		$inline_header_css = '';
		$inline_excerpt_css = '';
		
		if( isset( $instance[ 'slides' ] ) ||  isset( $instance[ 'columns' ] ) ||  isset( $instance[ 'tabs' ] ) ||  isset( $instance[ 'accordions' ] ) ){
			
			if( isset( $instance[ 'columns' ] ) ){
				$slides_or_columns = $instance[ 'columns' ];
				$header_selectors = '.media .media-body .heading';
				$excerpt_selectors = '.media .media-body .excerpt';
			} else if( isset( $instance[ 'slides' ] ) ){
				$slides_or_columns = $instance[ 'slides' ];
				$header_selectors = '.section-title .heading';
				$excerpt_selectors = '.section-title .excerpt';
			} else if( isset( $instance[ 'tabs' ] ) ){
				$slides_or_columns = $instance[ 'tabs' ];
				$header_selectors = '.media .media-body .heading';
				$excerpt_selectors = '.media .media-body .excerpt';
			} else if( isset( $instance[ 'accordions' ] ) ){
				$slides_or_columns = $instance[ 'accordions' ];
				$header_selectors = '.media .media-body .heading';
				$excerpt_selectors = '.media .media-body .excerpt';
			}

			foreach( $slides_or_columns as $slide_column_key => $item_intance ){
				
				$header_css = $this->translate_text_styling( $widget, $item_intance );

				if( !empty( $header_css ) ){
					$inline_header_css .= layers_inline_styles( "#{$widget->id}-{$slide_column_key}", array( 'selectors' => array( $header_selectors ), 'css' => $header_css ) );
				}

				$excerpt_css = $this->translate_text_styling( $widget, $item_intance, 'excerpt' );

				if( !empty( $excerpt_css ) ){
					$inline_excerpt_css .= layers_inline_styles( "#{$widget->id}-{$slide_column_key}", array( 'selectors' => array( $excerpt_selectors ), 'css' => $excerpt_css ) );
				}

			}
		}
				
		$header_css = $this->translate_text_styling( $widget, $instance, 'header' );

		if( !empty( $header_css ) ){
			$inline_header_css .= layers_inline_styles( "#$widget->id", array( 'selectors' => array( ' .section-title .heading' ), 'css' => $header_css ) );
		}
				
		$excerpt_css = $this->translate_text_styling( $widget, $instance, 'excerpt' );

		if( !empty( $excerpt_css ) ){
			$inline_header_css .= layers_inline_styles( "#$widget->id", array( 'selectors' => array( ' .section-title div' ), 'css' => $excerpt_css ) );
		}

		if( '' != $inline_header_css )
			$inline_css .= $inline_header_css;

		if( '' != $inline_excerpt_css )
			$inline_css .= $inline_excerpt_css;

		return $inline_css;
	}

	public function translate_text_styling( $widget = array(), $instance = array(), $type = 'header'){
		
		if( empty( $widget )  || empty( $instance ) ) return;

		global $wp_customize;

		$text_css = array();
		
		if( NULL != $widget->check_and_return( $instance, 'design', $type . '-text-size', 'font-size' ) ){
			$text_css[ 'font-size' ] = $widget->check_and_return( $instance, 'design', $type . '-text-size', 'font-size' ) . 'px'; 
		}

		if( NULL != $widget->check_and_return( $instance, 'design', $type . '-text-size', 'line-height' ) ){

			$text_css[ 'line-height' ] = $widget->check_and_return( $instance, 'design', $type . '-text-size', 'line-height' ) . 'px';
		}

		if( NULL != $widget->check_and_return( $instance, 'design', $type . '-text-size', 'letter-spacing' ) ){

			$text_css[ 'letter-spacing' ] = $widget->check_and_return( $instance, 'design', $type . '-text-size', 'letter-spacing' ) . 'px';

		}

		if( NULL != $widget->check_and_return( $instance, 'design', $type . '-font-weight' ) ){

			$text_css[ 'font-weight' ] = $widget->check_and_return( $instance, 'design', $type . '-font-weight' );

		}

		if( NULL != $widget->check_and_return( $instance, 'design', 'header-text-size', $type . '-font-style', 'italic' ) ){
			
			$text_css[ 'font-style' ] = 'italic';

		}

		// Text Decoration has two possible properties, so we need to deal with that in a specific way

		$text_css[ 'text-decoration' ] = '';
		
		if( NULL != $widget->check_and_return( $instance, 'design', $type . '-font-style', 'underline' ) ){

			$text_css[ 'text-decoration' ] .= 'underline ';
		}

		if( NULL != $widget->check_and_return( $instance, 'design', $type . '-font-style', 'strikethrough' ) ){
			
			$text_css[ 'text-decoration' ] .= 'line-through';

		}
		
		if( '' == $text_css[ 'text-decoration' ] ) unset( $text_css[ 'text-decoration' ] );

		if( NULL != $widget->check_and_return( $instance, 'design', $type . '-font-style', 'uppercase' ) ){
			
			$text_css[ 'text-transform' ] = 'uppercase';

		}

		return $text_css;
	}

	/**
	* Add Content Widget - Featured Image Size.
	*/
	public function add_featured_image_controls( $elements, $widget ){

		$new_elements = array();

		foreach( $elements as $key => $element ){

			$new_elements[ $key ] = $element;

			if( 'imageratios' == $key ){


				if( isset( $widget->values['featuredimage-size'] ) && is_array( $widget->values['featuredimage-size']  ) ) {
				
					$featuredimage_values = $widget->values['featuredimage-size'];
				
				} else if ( isset( $widget->values['featuredimage-size'] ) && !is_array( $widget->values['featuredimage-size'] ) ){
				
					$image_size_width = $widget->values['featuredimage-size'];
					$featuredimage_values = array( 'width' => $image_size_width );

				} else{
					$featuredimage_values = '';
				}

				$new_elements['featuredimage-size'] = array(
					'type' => 'inline-numbers-fields',
					'label' => __( 'Max Image Size (px)', 'layerswp' ),
					'name' => $widget->get_layers_field_name( 'featuredimage-size' ),
					'id' => $widget->get_layers_field_id( 'featuredimage-size' ),
					'value' => $featuredimage_values,
					'fields' => array(
						'width' => 'Width',
						'height' => 'Height',
						'radius' => 'Radius',
					),
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'featuredimage' ),
						'show-if-value' => '',
						'show-if-operator' => '!==',
					)
				);

				$new_elements['open-lightbox'] = array(
					'type' => 'checkbox',
					'label' => __( 'Open Image in Lightbox', 'layerswp' ),
					'name' => $widget->get_layers_field_name( 'open-lightbox' ),
					'id' => $widget->get_layers_field_id( 'open-lightbox' ),
					'value' => ( isset( $this->values['open-lightbox'] ) ) ? $this->values['open-lightbox'] : NULL,
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'featuredimage' ),
						'show-if-value' => '',
						'show-if-operator' => '!==',
					)
				);
			}
		}

		return $new_elements;
	}


	public function apply_featured_image_controls( $inline_css, $widget, $instance ) {

		if( empty( $widget ) || empty( $instance ) ) return $inline_css;
	
		$inline_image_css = '';

		$header_css = array();
		$excerpt_css = array();

		if( isset( $instance[ 'slides' ] ) || isset( $instance[ 'columns' ] )  || isset( $instance[ 'tabs' ] ) ){
			
			if( isset( $instance[ 'columns' ] ) ){
				$slides_or_columns = $instance[ 'columns' ];
				$img_selector = '.media .media-image img';
				$container_selector = '.media .media-image';
			} else if( isset( $instance[ 'tabs' ] ) ){
				$slides_or_columns = $instance[ 'tabs' ];
				$img_selector = '.media .media-image img';
				$container_selector = '.media .media-image';
			} else if( isset( $instance[ 'slides' ] ) ){
				$slides_or_columns = $instance[ 'slides' ];
				$img_selector = '.container .image-container img';
				$container_selector = '.container .image-container ';
			}

			foreach( $slides_or_columns as $slide_column_key => $item_instance ){
				
				$image_css = array();

				if( isset( $item_instance['design']['featuredimage-size'] ) && is_array(  $item_instance['design']['featuredimage-size'] ) ) {

					$size_values = $item_instance['design']['featuredimage-size'];

					if( isset( $size_values['width'] ) && '' != $size_values['width'] ){
						$image_css[ 'height' ] = 'auto';
						$image_css[ 'max-width' ] = $size_values['width'] . 'px';
					}

					if( isset( $size_values['height'] ) && '' != $size_values['height'] ){
						$image_css[ 'width' ] = 'auto';
						$image_css[ 'max-height' ] = $size_values['height'] . 'px';
					}

					if( isset( $size_values['radius'] ) && '' != $size_values['radius'] ){
						$image_css[ 'border-radius' ] = $size_values['radius'] . 'px';
					}

				} else if ( isset( $item_instance['featuredimage-size'] ) ) {
					$image_css[ 'height' ] = 'auto';  
					$image_css[ 'max-width' ] = $item_instance['featuredimage-size'] . 'px';
					
				} else {

					continue;
				}

				if( !empty( $image_css ) ){
					$inline_image_css .= layers_inline_styles( "#{$widget->id}-{$slide_column_key}", array( 'selectors' => array( $img_selector ), 'css' => $image_css ) );
				}

			}

			if( '' != $inline_image_css )
				$inline_css .= $inline_image_css;

		}

		return $inline_css;
	}

	/**
	* Add Content Widget, Slider Widget - Heading Type.
	*/
	public function add_heading_type_controls( $elements, $widget ){

		$new_elements = array();

		foreach( $elements as $key => $element ){

			if( isset( $elements[ 'fonts-align-start' ] ) ) {
				$use_key = 'fonts-align-start';
			} else {
				$use_key = 'fonts-align';
			}


			if( $use_key == $key ) {

				if( 'fonts-align-start' == $use_key){
					$new_elements['fonts-heading-type-start'] = array(
						'label' => __( 'Heading Type'),
						'type' => 'group-start'
					);
				}

				$new_elements['fonts-heading-type'] = array(
					'type' => 'select-icons',
					'label' => __( 'Heading Type', 'layerswp' ),
					'name' => $widget->get_layers_field_name( 'fonts', 'heading-type' ),
					'id' => $widget->get_layers_field_id( 'fonts', 'heading-type' ),
					'value' => ( isset( $widget->values['fonts']['heading-type'] ) ) ? $widget->values['fonts']['heading-type'] : NULL,
					'options' => array(
						'h1' => array( 'name' => __( 'H1', 'layerswp' ), 'class' => 'icon-heading-1', 'data' => '' ),
						'h2' => array( 'name' => __( 'H2', 'layerswp' ), 'class' => 'icon-heading-2', 'data' => '' ),
						'h3' => array( 'name' => __( 'H3', 'layerswp' ), 'class' => 'icon-heading-3', 'data' => '' ),
						'h4' => array( 'name' => __( 'H4', 'layerswp' ), 'class' => 'icon-heading-4', 'data' => '' ),
						'h5' => array( 'name' => __( 'H5', 'layerswp' ), 'class' => 'icon-heading-5', 'data' => '' ),
						'h6' => array( 'name' => __( 'H6', 'layerswp' ), 'class' => 'icon-heading-6', 'data' => '' ),
					),
					'class' => 'layers-icon-group-inline layers-icon-group-inline-outline',
				);

				if( 'fonts-align-start' == $use_key){
					$new_elements['fonts-heading-type-end'] = array(
						'type' => 'group-end'
					);
				}

				// If we are using the accordion interface, remove the label from the heading type
				if( 'fonts-align-start' == $use_key){
					unset( $new_elements['fonts-heading-type']['label'] );
				}
			}

			$new_elements[ $key ] = $element;


		}

		return $new_elements;
	}


	/**
	* Parallax Background Element
	*/
	public function add_background_parallax_controls( $elements, $widget = array()  ){

		if( empty( $widget ) ) return $elements;

		$new_elements = array();

		foreach( $elements as $key => $element ){

			$new_elements[ $key ] = $element;

			if( 'background-position' == $key ){

				unset(  $new_elements[ 'background-parallax' ] );

				$new_elements[ 'background-parallax' ] = array(
					'type' => 'checkbox',
					'label' => __( 'Parallax', 'layers-pro' ),
					'name' => $widget->get_layers_field_name( 'background', 'parallax' ),
					'id' => $widget->get_layers_field_id( 'background', 'parallax' ),
					'value' => ( isset( $widget->values['background']['parallax'] ) ) ? $widget->values['background']['parallax'] : NULL,
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'image' ),
						'show-if-value' => '',
						'show-if-operator' => '!==',
					)
				);
			}

		}

		return $new_elements;
	}


	/**
	* Mobile Display Elements
	*/
	public function add_mobile_display_controls( $elements, $widget = array()  ){

		if( empty( $widget ) ) return $elements;

		$new_elements = array();

		foreach( $elements as $key => $element ){

				$new_elements[ 'hide-start'] = array(
					'type' => 'group-start',
					'label' => __( 'Hide on Certain Devices', 'layerswp' ),
				);
				$new_elements[ 'hide' ] = array(
					'type' => 'select-icons',
					'group' => array(
						'hide-desktop' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'hide', 'desktop' ),
							'id' => $widget->get_layers_field_id( 'hide', 'desktop' ),
							'value' => ( isset( $widget->values['hide']['desktop'] ) ) ? $widget->values['hide']['desktop'] : NULL,
							'options' => array(
								'desktop' => array(
									'class' => 'icon-desktop',
									'data' => ''
								),
							),
						),
						'hide-tablet' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'hide', 'tablet' ),
							'id' => $widget->get_layers_field_id( 'hide', 'tablet' ),
							'value' => ( isset( $widget->values['hide']['tablet'] ) ) ? $widget->values['hide']['tablet'] : NULL,
							'options' => array(
								'tablet' => array(
									'class' => 'icon-tablet',
									'data' => ''
								),
							),
						),
						'hide-phone' => array(
							'type' => 'select-icons',
							'name' => $widget->get_layers_field_name( 'hide', 'phone' ),
							'id' => $widget->get_layers_field_id( 'hide', 'phone' ),
							'value' => ( isset( $widget->values['hide']['phone'] ) ) ? $widget->values['hide']['phone'] : NULL,
							'options' => array(
								'phone' => array(
									'class' => 'icon-phone',
									'data' => ''
								),
							),
						),

					),
					'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-span-12',
				);
				$new_elements[ 'hide-end'] = array(
					'type' => 'group-end',
				);
				$new_elements[ 'hide-end'] = array(
					'type' => 'group-end',
				);

			$new_elements[ $key ] = $element;

		}
		
		return $new_elements;
	}




	/**
	* Mobile Display Classes
	*/
	public function apply_mobile_display_controls( $container_class, $widget_this = array(), $instance = array() ){

		// Fallback incase there is no widget or item variables to work with
		if( empty( $widget_this ) || empty( $instance ) ) return $container_class;

		// Get the mobile fallback
		$hide = $widget_this->check_and_return( $instance, 'design', 'hide' );

		if( is_array( $hide ) ){
			foreach( $hide as $h ){
				$container_class[] = 'hide-' . $h;
			}
		}

		return $container_class;

	}

	/**
	* Slider Background Elements
	*/

	public function add_slider_controls( $elements, $widget ){

		$new_elements = array();

		foreach( $elements as $key => $element ){

			$new_elements[ $key ] = $element;

			if( 'background-image-end' == $key ){
				
				$new_elements[ 'background-video-start' ] = array(
					'type' => 'group-start',
					'label' => __( 'Background Video', 'layers-pro' )
				);

				$new_elements[ 'background-video-type' ] = array(
					'type' => 'select',
					'name' => $widget->get_layers_field_name( 'background', 'video-type' ),
					'id' => $widget->get_layers_field_id( 'background', 'video-type' ),
					'value' => ( isset( $widget->values['background']['video-type'] ) ) ? $widget->values['background']['video-type'] : NULL,
					'options' => array(
						'' => __( '-- Choose --', 'layers-pro' ),
						'self-hosted' => __( 'Self Hosted', 'layers-pro' ),
						'youtube' => __( 'YouTube', 'layers-pro' ),
						'vimeo' => __( 'Vimeo', 'layers-pro' ),
					)
				);
				$new_elements[ 'background-video-mp4' ] = array(
					'type' => 'upload',
					'label' => __( 'Background MP4', 'layers-pro' ),
					'button_label' => __( 'Choose MP4 File', 'layers-pro' ),
					'name' => $widget->get_layers_field_name( 'background', 'video-mp4' ),
					'id' => $widget->get_layers_field_id( 'background', 'video-mp4' ),
					'value' => ( isset( $widget->values['background']['video-mp4'] ) ) ? $widget->values['background']['video-mp4'] : NULL,
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'video-type' ),
						'show-if-value' => 'self-hosted'
					)
				);
				$new_elements[ 'background-video-youtube' ] = array(
					'type' => 'text',
					'label' => __( 'YouTube URL', 'layers-pro' ),
					'name' => $widget->get_layers_field_name( 'background', 'video-youtube' ),
					'id' => $widget->get_layers_field_id( 'background', 'video-youtube' ),
					'value' => ( isset( $widget->values['background']['video-youtube'] ) ) ? $widget->values['background']['video-youtube'] : NULL,
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'video-type' ),
						'show-if-value' => 'youtube'
					)
				);
				$new_elements[ 'background-video-vimeo' ] = array(
					'type' => 'text',
					'label' => __( 'Vimeo URL', 'layers-pro' ),
					'name' => $widget->get_layers_field_name( 'background', 'video-vimeo' ),
					'id' => $widget->get_layers_field_id( 'background', 'video-vimeo' ),
					'value' => ( isset( $widget->values['background']['video-vimeo'] ) ) ? $widget->values['background']['video-vimeo'] : NULL,
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'video-type' ),
						'show-if-value' => 'vimeo'
					)
				);
				
				$new_elements[ 'background-video-end' ] = array(
					'type' => 'group-end'
				);
			}
		}

		return $new_elements;
	}

	/**
	* Add Advanced Background controls
	*/
	public function add_background_controls( $args, $key, $type, $this_args, $values, $widget ){
		
		$new_elements = array();

		// Set Elements
		unset( $args[ 'elements' ][ 'background-color' ] );
		$elements = $args[ 'elements' ];

		foreach( $args[ 'elements' ] as $e_key => $e_details ){
			
			// Add existing element to array
			$new_elements[ $e_key ] = $e_details;

			if( 'background-color-start' == $e_key ){
				
				$new_elements[ 'background-style' ] = array(
					'type'  => 'select',
					'label' => '',
					'choices' => array(
						'solid' => __( 'Solid', 'layers-pro' ),
						'transparent' => __( 'Transparent', 'layers-pro' ),
						'gradient' => __( 'Gradient', 'layers-pro' ),
					),
					'default'  => 'solid',
					'name' => $widget->get_layers_field_name( 'background', 'style' ),
					'id' => $widget->get_layers_field_id( 'background', 'style' ),
					'value' => ( isset( $values['background']['style'] ) ) ? $values['background']['style'] : 'solid',
				);

				$new_elements[ 'background-color' ] = array(
					'type' => 'color',
					'label' => __( 'Background Color', 'layers-pro' ),
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'style' ),
						'show-if-value' => 'solid',
					),
					'name' => $widget->get_layers_field_name( 'background', 'color' ),
					'id' => $widget->get_layers_field_id( 'background', 'color' ),
					'value' => ( isset( $values['background']['color'] ) ) ? $values['background']['color'] : NULL,
				);

				$new_elements[ 'background-gradient-start-color' ] = array(
					'type' => 'color',
					'label' => __( 'Gradient Start Color', 'layers-pro' ),
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'style' ),
						'show-if-value' => 'gradient',
					),
					'name' => $widget->get_layers_field_name( 'background', 'gradient-start-color' ),
					'id' => $widget->get_layers_field_id( 'background', 'gradient-start-color' ),
					'value' => ( isset( $values['background']['gradient-start-color'] ) ) ? $values['background']['gradient-start-color'] : NULL,
				);

				$new_elements[ 'background-gradient-end-color' ] = array(
					'type' => 'color',
					'label' => __( 'Gradient End Color', 'layers-pro' ),
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'style' ),
						'show-if-value' => 'gradient',
					),
					'name' => $widget->get_layers_field_name( 'background', 'gradient-end-color' ),
					'id' => $widget->get_layers_field_id( 'background', 'gradient-end-color' ),
					'value' => ( isset( $values['background']['gradient-end-color'] ) ) ? $values['background']['gradient-end-color'] : NULL,
				);

				$new_elements[ 'background-gradient-direction' ] = array(
					'type' => 'range',
					'label' => __( 'Gradient Angle', 'layers-pro' ),
					'min' => '0',
					'max' => '360',
					'step' => '1',
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'background', 'style' ),
						'show-if-value' => 'gradient',
					),
					'name' => $widget->get_layers_field_name( 'background', 'gradient-direction' ),
					'id' => $widget->get_layers_field_id( 'background', 'gradient-direction' ),
					'value' => ( isset( $values['background']['gradient-direction'] ) ) ? $values['background']['gradient-direction'] : NULL,
				);
			}

		}

		// Merge new controls
		$args[ 'elements' ] = $new_elements;

		return $args;
	}

	/**
	* Add Advanced Background controls
	*/
	public function add_post_column_controls( $args, $key, $type, $this_args, $values, $widget ){
		
		$new_elements = array();

		// Set Elements
		unset( $args[ 'elements' ][ 'column-background-color' ] );
		$elements = $args[ 'elements' ];

		foreach( $args[ 'elements' ] as $e_key => $e_details ){
			
			// Add existing element to array
			$new_elements[ $e_key ] = $e_details;

			if( 'column-background-start' == $e_key ){

				$new_elements[ 'column-background-style'] = array(
					'type'  => 'select',
					'choices' => array(
						'solid' => __( 'Solid', 'layers-pro' ),
						'transparent' => __( 'Transparent', 'layers-pro' ),
						'gradient' => __( 'Gradient', 'layers-pro' ),
					),
					'default'  => 'solid',
					'name' => $widget->get_layers_field_name( 'column', 'background', 'style' ),
					'id' => $widget->get_layers_field_id( 'column', 'background', 'style' ),
					'value' => ( isset( $values['column']['background']['style'] ) ) ? $values['column']['background']['style'] : 'solid',
				);

				$new_elements[ 'column-background-color' ] = array(
					'type' => 'color',
					'label' => __( 'Background Color', 'layers-pro' ),
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'column', 'background', 'style' ),
						'show-if-value' => 'solid',
					),
					'name' => $widget->get_layers_field_name( 'column-background-color' ),
					'id' => $widget->get_layers_field_id( 'columns-background-color' ),
					'value' => ( isset( $values['column-background-color'] ) ) ? $values['column-background-color'] : NULL
				);

				$new_elements[ 'column-background-gradient-start-color' ] = array(
					'type' => 'color',
					'label' => __( 'Gradient Start Color', 'layers-pro' ),
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'column', 'background', 'style' ),
						'show-if-value' => 'gradient',
					),
					'name' => $widget->get_layers_field_name( 'column', 'background', 'gradient-start-color' ),
					'id' => $widget->get_layers_field_id( 'column', 'background', 'gradient-start-color' ),
					'value' => ( isset( $values['column']['background']['gradient-start-color'] ) ) ? $values['column']['background']['gradient-start-color'] : NULL,
				);

				$new_elements[ 'column-background-gradient-end-color' ] = array(
					'type' => 'color',
					'label' => __( 'Gradient End Color', 'layers-pro' ),
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'column', 'background', 'style' ),
						'show-if-value' => 'gradient',
					),
					'name' => $widget->get_layers_field_name( 'column', 'background', 'gradient-end-color' ),
					'id' => $widget->get_layers_field_id( 'column', 'background', 'gradient-end-color' ),
					'value' => ( isset( $values['column']['background']['gradient-end-color'] ) ) ? $values['column']['background']['gradient-end-color'] : NULL,
				);

				$new_elements[ 'column-background-gradient-direction' ] = array(
					'type' => 'range',
					'label' => __( 'Gradient Angle', 'layers-pro' ),
					'min' => '0',
					'max' => '360',
					'step' => '1',
					'data' => array(
						'show-if-selector' => '#' . $widget->get_layers_field_id( 'column', 'background', 'style' ),
						'show-if-value' => 'gradient',
					),
					'name' => $widget->get_layers_field_name( 'column', 'background', 'gradient-direction' ),
					'id' => $widget->get_layers_field_id( 'column', 'background', 'gradient-direction' ),
					'value' => ( isset( $values['column']['background']['gradient-direction'] ) ) ? $values['column']['background']['gradient-direction'] : NULL,
				);
				
			}

			if( 'column-background-end' == $e_key ){
		
				$new_elements[ 'column-borders-start' ] = array(
					'type' => 'group-start',
					'label' => __( 'Borders', 'layerswp' ),
				);

					$new_elements[ 'column-border-position' ] = array(
						'type' => 'select-icons',
						'multi_select' => TRUE,
						'name' => $widget->get_layers_field_name( 'column-border-position' ),
						'id' => $widget->get_layers_field_id( 'column-border-position' ),
						'value' => ( isset( $values['column-border-position'] ) ) ? $values['column-border-position'] : NULL,
						'options' => array(
							'top' => array(
								'name' => 'Top',
								'class' => 'icon-border-top',
							),
							'right' => array(
								'name' => 'Right',
								'class' => 'icon-border-right',
							),
							'bottom' => array(
								'name' => 'Bottom',
								'class' => 'icon-border-bottom',
							),
							'left' => array(
								'name' => 'Left',
								'class' => 'icon-border-left',
							),
						),
						'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-span-12',
					);
					
					$new_elements[ 'column-border-style' ] = array(
						'type' => 'border-style-fields',
						'name' => $widget->get_layers_field_name( 'column-border-style' ),
						'id' => $widget->get_layers_field_id( 'column-border-style' ),
						'value' => ( isset( $values['column-border-style'] ) ) ? $values['column-border-style'] : NULL,
						// 'input_class' => 'inline-fields-flush',
					);

					$new_elements[ 'column-border-color' ] = array(
						'type' => 'color',
						'label' => __( 'Border Color', 'layers-pro' ),
						'name' => $widget->get_layers_field_name( 'column-border-color' ),
						'id' => $widget->get_layers_field_id( 'column-border-color' ),
						'value' => ( isset( $values['column-border-color'] ) ) ? $values['column-border-color'] : NULL,
					);	

				$new_elements[ 'column-borders-end' ] = array(
					'type' => 'group-end',
				);

				$new_elements['column-padding-start'] = array(
					'type' => 'group-start',
					'label' => __( 'Padding (px)', 'layerswp' ),
				);

					$new_elements['column-padding'] = array(
						'type' => 'inline-numbers-fields',
						'name' => $widget->get_layers_field_name( 'column-padding' ),
						'id' => $widget->get_layers_field_id( 'column-padding' ),
						'value' => ( isset( $values['column-padding'] ) ) ? $values['column-padding'] : NULL,
						'input_class' => 'inline-fields-flush',
					);
					
				$new_elements['column-padding-end'] = array(
					'type' => 'group-end',
				);			
			}

		}

		// Merge new controls
		$args[ 'elements' ] = $new_elements;

		return $args;
	}

	public function apply_post_column_controls( $inline_css, $widget, $instance ) {

		if( empty( $widget ) || empty( $instance ) ) return $inline_css;

		$css = array();

		if (
			NULL != $widget->check_and_return( $instance, 'design', 'column-border-style', 'width' )
			&& (
				NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'top' ) ||
				NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'right' ) ||
				NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'bottom' ) ||
				NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'left' )
			)
		) {
		
			// Save the border width, then unset it.
			$border_width = $widget->check_and_return( $instance, 'design', 'column-border-style', 'width' );
			$border_width .='px';

			// Set the individual border widths.
			if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'top' ) ) {
				$css['border-top-width'] = $border_width;
			}
			if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'right' ) ) {
				$css['border-right-width'] = $border_width;
			}
			if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'bottom' ) ) {
				$css['border-bottom-width'] = $border_width;
			}
			if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-position', 'left' ) ) {
				$css['border-left-width'] = $border_width;
			}
		}

		$padding_keys = array(
			'top',
			'right',
			'bottom',
			'left'
		);

		foreach( $padding_keys as $p ){
			if ( NULL != $widget->check_and_return( $instance, 'design', 'column-padding', $p ) ) {
				$css['padding-' . $p ] = $widget->check_and_return( $instance, 'design', 'column-padding', $p ) . 'px';
			}	
		}
		
		if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-color') ) {
			$css['border-color'] = $widget->check_and_return( $instance, 'design', 'column-border-color');
		}

		if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-color') ) {
			$css['border-color'] = $widget->check_and_return( $instance, 'design', 'column-border-color');
		}

		if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-style', 'radius') ) {
			$css['border-radius'] = $widget->check_and_return( $instance, 'design', 'column-border-style', 'radius') . 'px';

			/*
			$css['border-bottom-left-radius'] = $widget->check_and_return( $instance, 'design', 'column-border-style', 'radius') . 'px';
			$css['border-bottom-right-radius'] = $widget->check_and_return( $instance, 'design', 'column-border-style', 'radius') . 'px';
			*/
		}
		
		if ( NULL != $widget->check_and_return( $instance, 'design', 'column-border-style', 'style') ) {
			$css['border-style'] = $widget->check_and_return( $instance, 'design', 'column-border-style', 'style');
		}
		
		if( !empty($css) ){
			$additional_inline_css = layers_inline_styles( "#{$widget->id}", array( 'selectors' => array( '.layers-masonry-column' ), 'css' => $css ) );
			$inline_css .= $additional_inline_css;
		}

		return $inline_css;

	}
	/**
// Prep: Border Width - Individual Borders.
		

	/**
	* Add Slider Widget - Slides - Button Styling.
	*/
	public function add_button_controls( $components, $widget = FALSE, $instance = FALSE ){

		// If this filter is called before we added the 2 new args - $widget, $instance - then bail.
		if ( FALSE === $widget || FALSE === $instance ) return $components;

		// Remove the existing watered down buttons control it exists.
		unset( $components['buttons'] ); // Search for array key
		if ( FALSE !== array_search ( 'buttons', $components ) )
			unset( $components[ array_search ( 'buttons', $components ) ] ); // Search for array value

		// Custom settings based on where the filter is action-ed.
		switch ( current_filter() ) {

			case 'layers_slide_widget_slide_design_bar_components' :
			case 'layers_column_widget_column_design_bar_components' :

				if( isset( $components[ 'fonts' ] ) )
					$after = 'fonts';
				else 
					$after = 'header_excerpt';
			break;
			case 'layers_post_widget_design_bar_components' :
			case 'layers_showcase_widget_design_bar_components' :

				$after = 'columns';

			break;
			case 'layers_post_carousel_widget_design_bar_components':

				$after = 'display';
			case 'layers_portfolio_widget_design_bar_components':

				$after = 'display';

			break;
			case 'layers_cta_widget_cta_design_bar_components' :
			case 'layers_social_widget_social_design_bar_components' :

				// If 'fonts' is not in the existing components then add a placeholder that
				// we can also look for below. So the new component will still be added.
				if ( empty( $components ) ) $components[] = '-placeholder-';

				$after = '-placeholder-';

			break;
			case 'layers_tabs_widget_design_bar_components' :
			case 'layers_accordion_widget_design_bar_components' :
			case 'layers_social_widget_design_bar_components' :

				$after = 'background';

			break;
			default:

				$after = FALSE;
		}

		// If there's nothing to put this after then bail.
		if ( ! $after ) return $components;

		// A place to collect the new components.
		$new_components = array();
		
		if( 'layers-pro-accordion' == $widget->widget_id ){
			$icon_css = 'icon-accordions';
			$component_label = __( 'Accordians', 'layers-pro' );
		} elseif ( 'layers-pro-tabs' == $widget->widget_id ) {
			$icon_css = 'icon-tabs';
			$component_label = __( 'Tabs', 'layers-pro' );

			if( isset( $instance['design']['tabs-size'] ) && !isset( $instance['design']['buttons-text-size'] ) ){
				$instance['design']['buttons-text-size'] = $instance['design']['tabs-size'];
			}

			if( isset( $instance['design']['tabs-background-color'] ) && !isset( $instance['design']['buttons-background-color'] ) ){
				$instance['design']['buttons-background-color'] = $instance['design']['tabs-background-color'];
			}

		} else {
			$icon_css = 'icon-call-to-action';
			$component_label = __( 'Buttons', 'layers-pro' );
		}

		// Loop through existing components looking for one we want ours to go after.
		foreach( $components as $key => $element ) {

			// Add the current existing component.
			$new_components[ $key ] = $element;

			// Add ours after the specified component(s).
			if ( $after === $key || $after === $element  ) {

				// Add the new component.
				$new_components['buttons-advanced-new'] = array(
					'icon-css' => $icon_css,
					'label' => $component_label,
					'elements' => array(
						
						/**
						 * Button Tabs
						 */
						'buttons-tabs' => array(
							'type' => 'tabs',
							'name' => $widget->get_layers_field_name( 'design', 'buttons-tabs' ),
							'id' => $widget->get_layers_field_id( 'design', 'buttons-tabs' ),
							'value' => ( isset( $instance['design']['buttons-tabs'] ) ) ? $instance['design']['buttons-tabs'] : NULL,
							'tabs' => array(
								'default' => array(
									'label' => __( 'Default', 'layerswp' ),
									'tab-id' => $widget->get_layers_field_id( 'design', 'buttons-default-tab-start' ),
								),
								'hover' => array(
									'label' => __( 'Hover', 'layerswp' ),
									'tab-id' => $widget->get_layers_field_id( 'design', 'buttons-hover-tab-start' ),
								),
							),
						),
						
						/**
						 * Button Tab - Default
						 */
						'buttons-default-tab-start' => array(
							'type' => 'tab-start',
							'id' => $widget->get_layers_field_id( 'design', 'buttons-default-tab-start' ),
						),
							
							/**
							 * Button Background (Group)
							 */
							'buttons-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Background', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-group-start' ),
								'value' => ( isset( $instance['design']['buttons-group-start'] ) ) ? $instance['design']['buttons-group-start'] : NULL,
							),
							'buttons-background-style' => array(
								'type'  => 'select',
								'label' => '',
								'choices' => array(
									'' => '-- Choose --',
									'solid' => __( 'Solid', 'layers-pro' ),
									'transparent' => __( 'Transparent', 'layers-pro' ),
									'gradient' => __( 'Gradient', 'layers-pro' ),
								),
								'default'  => 'solid',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-background-style' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-background-style' ),
								'value' => ( isset( $instance['design']['buttons-background-style'] ) ) ? $instance['design']['buttons-background-style'] : NULL,
							),
							'buttons-background-color' => array(
								'type' => 'color',
								'label' => __( 'Background Color', 'layers-pro' ),
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-background-style' ),
									'show-if-value' => 'solid',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-background-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-background-color' ),
								'value' => ( isset( $instance['design']['buttons-background-color'] ) ) ? $instance['design']['buttons-background-color'] : NULL,
							),
							'buttons-background-gradient-start-color' => array(
								'type' => 'color',
								'label' => __( 'Gradient Start Color', 'layers-pro' ),
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-background-style' ),
									'show-if-value' => 'gradient',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-background-gradient-start-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-background-gradient-start-color' ),
								'value' => ( isset( $instance['design']['buttons-background-gradient-start-color'] ) ) ? $instance['design']['buttons-background-gradient-start-color'] : NULL,
							),
							'buttons-background-gradient-end-color' => array(
								'type' => 'color',
								'label' => __( 'Gradient End Color', 'layers-pro' ),
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-background-style' ),
									'show-if-value' => 'gradient',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-background-gradient-end-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-background-gradient-end-color' ),
								'value' => ( isset( $instance['design']['buttons-background-gradient-end-color'] ) ) ? $instance['design']['buttons-background-gradient-end-color'] : NULL,
							),
							'buttons-background-gradient-direction' => array(
								'type' => 'range',
								'label' => __( 'Gradient Angle', 'layers-pro' ),
								'min' => '0',
								'max' => '360',
								'step' => '1',
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-background-style' ),
									'show-if-value' => 'gradient',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-background-gradient-direction' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-background-gradient-direction' ),
								'value' => ( isset( $instance['design']['buttons-background-gradient-direction'] ) ) ? $instance['design']['buttons-background-gradient-direction'] : NULL,
							),
							'buttons-group-end' => array(
								'type' => 'group-end',
							),
							
							/**
							 * Button Borders (Group)
							 */
							'buttons-border-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Borders', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-border-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-border-group-start' ),
								'value' => ( isset( $instance['design']['buttons-border-group-start'] ) ) ? $instance['design']['buttons-border-group-start'] : NULL,
							),
							
							'buttons-border-position' => array(
								'type' => 'select-icons',
								'multi_select' => TRUE,
								'label' => '',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-border-position' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-border-position' ),
								'value' => ( isset( $instance['design']['buttons-border-position'] ) ) ? $instance['design']['buttons-border-position'] : NULL,
								'options' => array(
									'top' => array(
										'name' => 'Top',
										'class' => 'icon-border-top',
									),
									'right' => array(
										'name' => 'Right',
										'class' => 'icon-border-right',
									),
									'bottom' => array(
										'name' => 'Bottom',
										'class' => 'icon-border-bottom',
									),
									'left' => array(
										'name' => 'Left',
										'class' => 'icon-border-left',
									),
								),
								'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-span-12',
							),
							
							'buttons-border-style' => array(
								'type' => 'border-style-fields',
								'label' => '',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-border-style' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-border-style' ),
								'value' => ( isset( $instance['design']['buttons-border-style'] ) ) ? $instance['design']['buttons-border-style'] : NULL,
								// 'input_class' => 'inline-fields-flush',
							),
							'buttons-border-color' => array(
								'type' => 'color',
								'label' => __( 'Border Color', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-border-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-border-color' ),
								'value' => ( isset( $instance['design']['buttons-border-color'] ) ) ? $instance['design']['buttons-border-color'] : NULL,
							),
							'buttons-border-group-end' => array(
								'type' => 'group-end',
							),
							
							/**
							 * Button Font (Group)
							 */
							'buttons-font-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Font', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-font-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-font-group-start' ),
								'value' => ( isset( $instance['design']['buttons-font-group-start'] ) ) ? $instance['design']['buttons-font-group-start'] : NULL,
							),
							'buttons-text-color' => array(
								'type' => 'color',
								'label' => __( 'Text Color', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-text-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-text-color' ),
								'value' => ( isset( $instance['design']['buttons-text-color'] ) ) ? $instance['design']['buttons-text-color'] : NULL,
							),
							'buttons-text-size' => array(
								'type' => 'inline-numbers-fields',
								'label' => '',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-text-size' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-text-size' ),
								'value' => ( isset( $instance['design']['buttons-text-size'] ) ) ? $instance['design']['buttons-text-size'] : NULL,
								'fields' => array(
									'font-size' => 'Size',
									'line-height' => 'Line Height',
									'letter-spacing' => 'Spacing',
								),
								// 'input_class' => 'inline-fields-flush',
							),
							'buttons-font-weight' => array(
								'type' => 'select-icons',
								'label' => '',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-font-weight' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-font-weight' ),
								'value' => ( isset( $instance['design']['buttons-font-weight'] ) ) ? $instance['design']['buttons-font-weight'] : NULL,
								'options' => array(
									'light' => array( 'name' => __( 'Light', 'layerswp' ), 'class' => 'icon-font-weight-light', 'data' => '' ),
									'normal' => array( 'name' => __( 'Normal', 'layerswp' ), 'class' => 'icon-font-weight-normal', 'data' => '' ),
									'bold' => array( 'name' => __( 'Bold', 'layerswp' ), 'class' => 'icon-font-weight-bold', 'data' => '' ),
								),
								'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-icon-group-inline-flexible',
							),
							'buttons-font-style' => array(
								'type' => 'select-icons',
								'label' => '',
								'group' => array(
									'buttons-font-style-italic' => array(
										'type' => 'select-icons',
										'name' => $widget->get_layers_field_name( 'design', 'buttons-font-style', 'italic' ),
										'id' => $widget->get_layers_field_id( 'design', 'buttons-font-style', 'italic' ),
										'value' => ( isset( $instance['design']['buttons-font-style']['italic'] ) ) ? $instance['design']['buttons-font-style']['italic'] : NULL,
										'options' => array(
											'italic' => array(
												'class' => 'icon-font-italic',
												'data' => ''
											),
										),
									),
									'buttons-font-style-underline' => array(
										'type' => 'select-icons',
										'name' => $widget->get_layers_field_name( 'design', 'buttons-font-style', 'underline' ),
										'id' => $widget->get_layers_field_id( 'design', 'buttons-font-style', 'underline' ),
										'value' => ( isset( $instance['design']['buttons-font-style']['underline'] ) ) ? $instance['design']['buttons-font-style']['underline'] : NULL,
										'options' => array(
											'underline' => array(
												'class' => 'icon-font-underline',
												'data' => ''
											),
										),
									),
									'buttons-font-style-strikethrough' => array(
										'type' => 'select-icons',
										'name' => $widget->get_layers_field_name( 'design', 'buttons-font-style', 'strikethrough' ),
										'id' => $widget->get_layers_field_id( 'design', 'buttons-font-style', 'strikethrough' ),
										'value' => ( isset( $instance['design']['buttons-font-style']['strikethrough'] ) ) ? $instance['design']['buttons-font-style']['strikethrough'] : NULL,
										'options' => array(
											'strikethrough' => array(
												'class' => 'icon-font-strike-through',
												'data' => ''
											),
										),
									),
									'buttons-font-style-uppercase' => array(
										'type' => 'select-icons',
										'name' => $widget->get_layers_field_name( 'design', 'buttons-font-style', 'uppercase' ),
										'id' => $widget->get_layers_field_id( 'design', 'buttons-font-style', 'uppercase' ),
										'value' => ( isset( $instance['design']['buttons-font-style']['uppercase'] ) ) ? $instance['design']['buttons-font-style']['uppercase'] : NULL,
										'options' => array(
											'uppercase' => array(
												'class' => 'icon-font-text-transform',
												'data' => ''
											),
										),
									),
								),
								'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-span-12',
							),
							'buttons-font-group-end' => array(
								'type' => 'group-end',
							),
							/**
							 * Button Padding (Group)
							 */
							'buttons-padding-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Padding', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-padding-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-padding-group-start' ),
								'value' => ( isset( $instance['design']['buttons-padding-group-start'] ) ) ? $instance['design']['buttons-padding-group-start'] : NULL,
							),
								'buttons-padding' => array(
									'type' => 'trbl-fields',
									'name' => $widget->get_layers_field_name( 'design', 'buttons-padding' ),
									'id' => $widget->get_layers_field_id( 'design', 'buttons-padding' ),
									'value' => ( isset( $instance['design']['buttons-padding'] ) ) ? $instance['design']['buttons-padding'] : NULL,
									'input_class' => 'inline-fields-flush',
								),
							'buttons-padding-group-end' => array(
								'type' => 'group-end',
							),

							/**
							 * Button Margin (Group)
							 */
							'buttons-margin-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Margin', 'layers-pro' ),
							),
								'buttons-margin' => array(
									'type' => 'trbl-fields',
									'name' => $widget->get_layers_field_name( 'design', 'buttons-margin' ),
									'id' => $widget->get_layers_field_id( 'design', 'buttons-margin' ),
									'value' => ( isset( $instance['design']['buttons-margin'] ) ) ? $instance['design']['buttons-margin'] : NULL,
									'input_class' => 'inline-fields-flush',
								),
							'buttons-margin-group-end' => array(
								'type' => 'group-end',
							),						
						

							/**
							 * Button Shadow (Group)
							 */
							'buttons-shadow-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Shadow', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-shadow-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-shadow-group-start' ),
								'value' => ( isset( $instance['design']['buttons-shadow-group-start'] ) ) ? $instance['design']['buttons-shadow-group-start'] : NULL,
							),
							'buttons-shadow-color' => array(
								'type' => 'color',
								'label' => __( 'Shadow Color', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-shadow-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-shadow-color' ),
								'value' => ( isset( $instance['design']['buttons-shadow-color'] ) ) ? $instance['design']['buttons-shadow-color'] : NULL,
							),
							'buttons-shadow-size' => array(
								'type' => 'inline-numbers-fields',
								'label' => '',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-shadow-size' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-shadow-size' ),
								'value' => ( isset( $instance['design']['buttons-shadow-size'] ) ) ? $instance['design']['buttons-shadow-size'] : NULL,
								'fields' => array(
									'x' => __( 'X', 'layers-pro' ),
									'y' => __( 'Y', 'layers-pro' ),
									'blur' => __( 'Blur', 'layers-pro' ),
									'spread' => __( 'Spread', 'layers-pro' ),
								),
								'input_class' => 'inline-fields-flush',
							),
							'buttons-shadow-group-end' => array(
								'type' => 'group-end',
							),
						
						'buttons-default-tab-end' => array(
							'type' => 'tab-end',
							'id' => $widget->get_layers_field_id( 'design', 'buttons-default-tab-end' ),
						),
						
						
						/**
						 * Button Tab - Hover
						 */
						'buttons-hover-tab-start' => array(
							'type' => 'tab-start',
							'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-tab-start' ),
						),
							
							/**
							 * Button Background (Group)
							 */
							'buttons-hover-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Background', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-group-start' ),
								'value' => ( isset( $instance['design']['buttons-hover-group-start'] ) ) ? $instance['design']['buttons-hover-group-start'] : NULL,
							),
							'buttons-hover-background-style' => array(
								'type'  => 'select',
								'label' => '',
								'choices' => array(
									'' => '-- Choose --',
									'solid' => __( 'Solid', 'layers-pro' ),
									'transparent' => __( 'Transparent', 'layers-pro' ),
									'gradient' => __( 'Gradient', 'layers-pro' ),
								),
								'default'  => 'solid',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-background-style' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-background-style' ),
								'value' => ( isset( $instance['design']['buttons-hover-background-style'] ) ) ? $instance['design']['buttons-hover-background-style'] : NULL,
							),
							'buttons-hover-background-color' => array(
								'type' => 'color',
								'label' => __( 'Background Color', 'layers-pro' ),
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-hover-background-style' ),
									'show-if-value' => 'solid',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-background-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-background-color' ),
								'value' => ( isset( $instance['design']['buttons-hover-background-color'] ) ) ? $instance['design']['buttons-hover-background-color'] : NULL,
							),
							'buttons-hover-background-gradient-start-color' => array(
								'type' => 'color',
								'label' => __( 'Gradient Start Color', 'layers-pro' ),
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-hover-background-style' ),
									'show-if-value' => 'gradient',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-background-gradient-start-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-background-gradient-start-color' ),
								'value' => ( isset( $instance['design']['buttons-hover-background-gradient-start-color'] ) ) ? $instance['design']['buttons-hover-background-gradient-start-color'] : NULL,
							),
							'buttons-hover-background-gradient-end-color' => array(
								'type' => 'color',
								'label' => __( 'Gradient End Color', 'layers-pro' ),
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-hover-background-style' ),
									'show-if-value' => 'gradient',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-background-gradient-end-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-background-gradient-end-color' ),
								'value' => ( isset( $instance['design']['buttons-hover-background-gradient-end-color'] ) ) ? $instance['design']['buttons-hover-background-gradient-end-color'] : NULL,
							),
							'buttons-hover-background-gradient-direction' => array(
								'type' => 'range',
								'label' => __( 'Gradient Angle', 'layers-pro' ),
								'min' => '0',
								'max' => '360',
								'step' => '1',
								'data' => array(
									'show-if-selector' => '#' . $widget->get_layers_field_id( 'design', 'buttons-hover-background-style' ),
									'show-if-value' => 'gradient',
								),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-background-gradient-direction' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-background-gradient-direction' ),
								'value' => ( isset( $instance['design']['buttons-hover-background-gradient-direction'] ) ) ? $instance['design']['buttons-hover-background-gradient-direction'] : NULL,
							),
							'buttons-hover-group-end' => array(
								'type' => 'group-end',
							),
							
							/**
							 * Button Borders (Group)
							 */
							'buttons-hover-border-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Borders', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-border-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-border-group-start' ),
								'value' => ( isset( $instance['design']['buttons-hover-border-group-start'] ) ) ? $instance['design']['buttons-hover-border-group-start'] : NULL,
							),
							'buttons-hover-border-color' => array(
								'type' => 'color',
								'label' => __( 'Border Color', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-border-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-border-color' ),
								'value' => ( isset( $instance['design']['buttons-hover-border-color'] ) ) ? $instance['design']['buttons-hover-border-color'] : NULL,
							),
							'buttons-hover-border-group-end' => array(
								'type' => 'group-end',
							),
							
							/**
							 * Button Font (Group)
							 */
							'buttons-hover-font-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Font', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-font-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-font-group-start' ),
								'value' => ( isset( $instance['design']['buttons-hover-font-group-start'] ) ) ? $instance['design']['buttons-hover-font-group-start'] : NULL,
							),
							'buttons-hover-text-color' => array(
								'type' => 'color',
								'label' => __( 'Text Color', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-text-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-text-color' ),
								'value' => ( isset( $instance['design']['buttons-hover-text-color'] ) ) ? $instance['design']['buttons-hover-text-color'] : NULL,
							),
							'buttons-hover-font-weight' => array(
								'type' => 'select-icons',
								'label' => '',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-font-weight' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-font-weight' ),
								'value' => ( isset( $instance['design']['buttons-hover-font-weight'] ) ) ? $instance['design']['buttons-hover-font-weight'] : NULL,
								'options' => array(
									'light' => array( 'name' => __( 'Light', 'layerswp' ), 'class' => 'icon-font-weight-light', 'data' => '' ),
									'normal' => array( 'name' => __( 'Normal', 'layerswp' ), 'class' => 'icon-font-weight-normal', 'data' => '' ),
									'bold' => array( 'name' => __( 'Bold', 'layerswp' ), 'class' => 'icon-font-weight-bold', 'data' => '' ),
								),
								'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-icon-group-inline-flexible',
							),
							'buttons-hover-font-style' => array(
								'type' => 'select-icons',
								'label' => '',
								'group' => array(
									'buttons-hover-font-style-italic' => array(
										'type' => 'select-icons',
										'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-font-style', 'italic' ),
										'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-font-style', 'italic' ),
										'value' => ( isset( $instance['design']['buttons-hover-font-style']['italic'] ) ) ? $instance['design']['buttons-hover-font-style']['italic'] : NULL,
										'options' => array(
											'italic' => array(
												'class' => 'icon-font-italic',
												'data' => ''
											),
										),
									),
									'buttons-hover-font-style-underline' => array(
										'type' => 'select-icons',
										'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-font-style', 'underline' ),
										'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-font-style', 'underline' ),
										'value' => ( isset( $instance['design']['buttons-hover-font-style']['underline'] ) ) ? $instance['design']['buttons-hover-font-style']['underline'] : NULL,
										'options' => array(
											'underline' => array(
												'class' => 'icon-font-underline',
												'data' => ''
											),
										),
									),
									'buttons-hover-font-style-strikethrough' => array(
										'type' => 'select-icons',
										'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-font-style', 'strikethrough' ),
										'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-font-style', 'strikethrough' ),
										'value' => ( isset( $instance['design']['buttons-hover-font-style']['strikethrough'] ) ) ? $instance['design']['buttons-hover-font-style']['strikethrough'] : NULL,
										'options' => array(
											'strikethrough' => array(
												'class' => 'icon-font-strike-through',
												'data' => ''
											),
										),
									),
								),
								'class' => 'layers-icon-group-inline layers-icon-group-inline-outline layers-span-12',
							),
							'buttons-hover-font-group-end' => array(
								'type' => 'group-end',
							),
							/**
							 * Button Padding (Group)
							 */
							'buttons-hover-padding-hover-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Padding', 'layers-pro' ),
							),
								'buttons-hover-padding' => array(
									'type' => 'trbl-fields',
									'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-padding' ),
									'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-padding' ),
									'value' => ( isset( $instance['design']['buttons-hover-padding'] ) ) ? $instance['design']['buttons-hover-padding'] : NULL,
									'input_class' => 'inline-fields-flush',
								),
							'buttons-padding-hover-group-end' => array(
								'type' => 'group-end',
							),
							
							
							/**
							 * Button Margin (Group)
							 */
							'buttons-hover-margin-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Margin', 'layers-pro' ),
							),
								'buttons-hover-margin' => array(
									'type' => 'trbl-fields',
									'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-margin' ),
									'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-margin' ),
									'value' => ( isset( $instance['design']['buttons-hover-margin'] ) ) ? $instance['design']['buttons-hover-margin'] : NULL,
									'input_class' => 'inline-fields-flush',
							),
							'buttons-hover-margin-group-end' => array(
								'type' => 'group-end',
							),


							/**
							 * Button Shadow (Group)
							 */
							'buttons-hover-shadow-group-start' => array(
								'type' => 'group-start',
								'label' => __( 'Shadow', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-shadow-group-start' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-shadow-group-start' ),
								'value' => ( isset( $instance['design']['buttons-hover-shadow-group-start'] ) ) ? $instance['design']['buttons-hover-shadow-group-start'] : NULL,
							),
							'buttons-hover-shadow-color' => array(
								'type' => 'color',
								'label' => __( 'Shadow Color', 'layers-pro' ),
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-shadow-color' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-shadow-color' ),
								'value' => ( isset( $instance['design']['buttons-hover-shadow-color'] ) ) ? $instance['design']['buttons-hover-shadow-color'] : NULL,
							),
							'buttons-hover-shadow-size' => array(
								'type' => 'inline-numbers-fields',
								'label' => '',
								'name' => $widget->get_layers_field_name( 'design', 'buttons-hover-shadow-size' ),
								'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-shadow-size' ),
								'value' => ( isset( $instance['design']['buttons-hover-shadow-size'] ) ) ? $instance['design']['buttons-hover-shadow-size'] : NULL,
								'fields' => array(
									'x' => __( 'X', 'layers-pro' ),
									'y' => __( 'Y', 'layers-pro' ),
									'blur' => __( 'Blur', 'layers-pro' ),
									'spread' => __( 'Spread', 'layers-pro' ),
								),
								'input_class' => 'inline-fields-flush',
							),
							'buttons-hover-shadow-group-end' => array(
								'type' => 'group-end',
							),
						
						'buttons-hover-tab-end' => array(
							'type' => 'tab-end',
							'id' => $widget->get_layers_field_id( 'design', 'buttons-hover-tab-end' ),
						),
					),
				);
			}
		}

		return $new_components;
	}

	/**
	* Add Parallax Class to Widgets
	*/

	public function apply_widget_parallax_controls( $item_class, $widget_this = array(), $item_instance = array() ){

		// Fallback incase there is no widget or item variables to work with
		if( empty( $widget_this ) || empty( $item_instance ) ) return $item_class;

		// Get the mobile fallback
		$parallax = $widget_this->check_and_return( $item_instance, 'design', 'background', 'parallax');

		if( 'on' == $parallax ) {
			$item_class[] = 'layers-parallax';
		}

		return $item_class;
	}

	public function apply_slider_controls( $widget_this, $item_instance = array(), $widget_instance = array()){
		global $wp_customize;

		if( empty( $item_instance ) || empty( $widget_instance ) ) return $widget_this;

		// Get the mobile fallback
		$bg_img = $widget_this->check_and_return( $item_instance, 'design', 'background', 'image');

		// Get the video type
		$bg_video_type = $widget_this->check_and_return( $item_instance, 'design', 'background', 'video-type');

		// Spool up the video URLs
		$src = FALSE;
		$mp4 = $widget_this->check_and_return( $item_instance, 'design', 'background', 'video-mp4');
		$youtube = $widget_this->check_and_return( $item_instance, 'design', 'background', 'video-youtube');
		$vimeo = $widget_this->check_and_return( $item_instance, 'design', 'background', 'video-vimeo');

		if( $mp4 && 'self-hosted' == $bg_video_type ){
			$src = $mp4;
		} else if( 'vimeo' == $bg_video_type ){
			$src = $vimeo;
			$id = layers_get_vimeo_id( $src );
		} else if( 'youtube' == $bg_video_type ){
			$src = $youtube;
			$id = layers_get_youtube_id( $src );
		}

		if( !$src ) return;

		if( 'self-hosted' == $bg_video_type ) {
			if( !$wp_customize && 1 == count( $widget_this->check_and_return( $widget_instance, 'slides' ) ) ) {
				$autoplay = 'autoplay';
			} else {
				$autoplay = '';
			}
			?>
			<video <?php if( $wp_customize ) echo 'customizer'; ?> <?php echo $autoplay; ?> loop <?php if( $bg_img ) { ?>poster="<?php echo wp_get_attachment_url( $bg_img ); ?>"<?php } ?>>
				<?php if( $src ) { ?>
					<source src="<?php echo wp_get_attachment_url( $src ); ?>" type="video/mp4" />
				<?php } ?>
			</video>
		<?php }
		elseif( isset( $id ) ) {
			if( !$wp_customize && 1 == count( $widget_this->check_and_return( $widget_instance, 'slides' ) ) ) {
				$autoplay = '&autoplay=1';
			} else {
				$autoplay = '';
			}
			?>
			<div class="layerspro-slider-video fitvidsignore">
				<?php if( 'youtube' == $bg_video_type ) {
					 ?>
					<iframe frameborder="0" src="//www.youtube.com/embed/<?php echo $id; ?>?enablejsapi=1&controls=0&loop=1&playlist=<?php echo $id; ?>&rel=0&showinfo=0&autohide=1&wmode=transparent&hd=1<?php echo $autoplay; ?>"></iframe>
				<?php } elseif( 'vimeo' == $bg_video_type ) {
					 ?>
					<iframe frameborder="0" src="//player.vimeo.com/video/<?php echo $id; ?>?title=0&controls=0&byline=0&portrait=0&loop=1&background=1<?php echo $autoplay; ?>" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				<?php }  ?>
			</div>
		<?php }
	}

	public function add_animation_controls($elements, $widget) {
		$elements = array_merge([

			'animations-start' => array(
				'label' => __( 'Enable Animations'),
				'type' => 'group-start'
			),
			'animation' => array(
				'type' => 'checkbox',
				'label' => __( 'Animation', 'layerswp' ),
				'description' => __( 'Animation preview not avaiable inside the Customizer.', 'layerswp' ),
				'name' => $widget->get_layers_field_name( 'advanced', 'animation' ),
				'id' => $widget->get_layers_field_id( 'advanced', 'animation' ),
				'value' => ( isset( $widget->values['advanced']['animation'] ) ) ? $widget->values['advanced']['animation'] : NULL,
			),
			'animations-end' => array(
				'type' => 'group-end'
			),
		], $elements);

		return $elements;
	}
}

// Initialize
Layers_Pro_Widget_Filters::get_instance();
