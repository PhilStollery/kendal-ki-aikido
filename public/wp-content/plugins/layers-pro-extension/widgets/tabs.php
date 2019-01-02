<?php
/**
 * Carousel Widget
 *
 * This file is used to register and display the Layers - Carousel widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */

function layers_tabs_widget_init() {

	if( !class_exists( 'Layers_Widget' ) ) return;

	if( !class_exists( 'Layers_Tabs_Widget' ) ) {
		class Layers_Tabs_Widget extends Layers_Pro_Widget {

			/**
			*  Widget construction
			*/
			function __construct() {

				/**
				* Widget variables
				*
				* @param   string   $widget_title   Widget title
				* @param   string   $widget_id      Widget slug for use as an ID/classname
				* @param   array    $checkboxes     (optional) Array of checkbox names to be saved in this widget. Don't forget these please!
				*/
				$this->widget_title = __( 'Tabs', 'layers-pro' );
				$this->widget_id    = 'layers-pro-tabs';
				$this->checkboxes   = array(
					'buttons-full-width',
				);

				/* Widget settings. */
				$widget_ops = array(
					'classname' => 'obox-layers-' . $this->widget_id .'-widget',
					'description' => __( 'This widget is used to display your ', 'layers-pro' ) . $this->widget_title . '.',
					'customize_selective_refresh' => TRUE,
				);

				/* Widget control settings. */
				$control_ops = array(
					'width' => LAYERS_WIDGET_WIDTH_LARGE,
					'height' => NULL,
					'id_base' => LAYERS_THEME_SLUG . '-widget-' . $this->widget_id,
				);

				/* Create the widget. */
				parent::__construct(
					LAYERS_THEME_SLUG . '-widget-' . $this->widget_id,
					$this->widget_title,
					$widget_ops,
					$control_ops
				);


				/* Setup Widget Defaults */
				$this->defaults = array (
					'title' => __( 'Tabs', 'layers-pro' ),
					'excerpt' => __( 'Lorem ipsum dolor sit amet enim ad minim veniam, quis nostrud exercitation.', 'layers-pro' ),

					'design' => array(
						'layout' => 'layout-boxed',
						'featuredimage-size' => '',
						'imagealign' => 'image-left',
						'background' => NULL,
						'fonts' => array(
							'align' => 'text-left',
							'size' => 'medium',
							'color' => NULL,
							'shadow' => NULL,
							'heading-type' => 'h5',
						),
						'fonts' => array(
							'align' => 'text-left',
							'size' => 'medium',
							'color' => NULL,
							'shadow' => NULL,
							'heading-type' => 'h3',
						),
                        'advanced' => array (
                            'animation' => 'on',
                        )
					),
				);

				/* Setup Widget Repeater Defaults */
				$this->register_repeater_defaults( 'tab', 3,
					array(
						'tab-title' => __( 'Tab 1', 'layers-pro'),
						'content' => __( '<p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.</p>', 'layers-pro'),
						'design' => array(
							'featuredimage-size' => '',
							'imagealign' => 'image-left',
							'background' => NULL,
							'fonts' => array(
								'align' => 'text-left',
								'size' => 'medium',
								'color' => NULL,
								'shadow' => NULL,
								'heading-type' => 'h5',
							),
						),

					),
					array(
						'tab-title' => __( 'Tab 2', 'layers-pro'),
						'content' => __( '<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'layers-pro'),
						'design' => array(
							'featuredimage-size' => '',
							'imagealign' => 'image-left',
							'background' => NULL,
							'fonts' => array(
								'align' => 'text-left',
								'size' => 'medium',
								'color' => NULL,
								'shadow' => NULL,
								'heading-type' => 'h5',
							),
						),
					),
					array(
						'tab-title' => __( 'Tab 3', 'layers-pro'),
						'content' => __( '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.</p>', 'layers-pro'),
						'design' => array(
							'featuredimage-size' => '',
							'imagealign' => 'image-left',
							'background' => NULL,
							'fonts' => array(
								'align' => 'text-left',
								'size' => 'medium',
								'color' => NULL,
								'shadow' => NULL,
								'heading-type' => 'h5',
							),
						),
					)
				);
			}

			/**
			*  Widget front end display
			*/
			function widget( $args, $instance ) {

				global $wp_customize;

				$this->backup_inline_css();

				// Turn $args array into variables.
				extract( $args );

				// Use defaults if $instance is empty.
				if( empty( $instance ) && ! empty( $this->defaults ) ) {
					$instance = wp_parse_args( $instance, $this->defaults );
				}

				// Mix in new/unset defaults on every instance load (NEW)
				$instance = $this->apply_defaults( $instance );

				/**
				 * Styling
				 */

				// Background Styling
				if ( NULL !== $this->check_and_return( $instance, 'design', 'background' ) ) {
					$this->inline_css .= layers_inline_styles( ".{$widget_id}", 'background', array( 'background' => $this->check_and_return( $instance, 'design', 'background' ) ) );
				}

				// Text Styling
				if ( NULL !== $this->check_and_return( $instance, 'design', 'fonts', 'color' ) ) {
					$this->inline_css .= layers_inline_styles( ".{$widget_id} .nav-tabs .tab a, .{$widget_id} .tab-content .content", array( 'css' => array( 'color' => $this->check_and_return( $instance, 'design', 'fonts', 'color' ) ) ) );
				}

				// Tab Styling
				if( NULL !== $this->check_and_return( $instance, 'design', 'buttons-border-position' ) ){
 					$this->inline_css .= layers_inline_styles( ".{$widget_id} .nav-tabs", array( 'css' => array( 'border' =>  'none' ) ) );
 					$this->inline_css .= layers_inline_styles( ".{$widget_id} .tab-row li > a", array( 'css' => array( 'border' =>  'none' ) ) );
 				}


				$this->inline_css .= layers_pro_apply_widget_button_styling( $this, $instance, array( ".{$widget_id} .tab-row li > a" ) );

				// Apply the advanced widget styling
				$this->apply_widget_advanced_styling( $widget_id, $instance );

				/**
				 * Generate Classes
				 */
				$widget_container_class = array();
				$widget_container_class[] = $widget_id;
				$widget_container_class[] = 'widget';
				$widget_container_class[] = 'layers-pro-tabs'; // Important - Widget Class
				$widget_container_class[] = 'content-vertical-massive';
                $widget_container_class[] = $this->get_animation_class( $instance );
				$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'background', 'darken' ) ? 'darken' : '' );
				$widget_container_class[] = $this->check_and_return( $instance , 'design', 'advanced', 'customclass' ); // Apply custom class from design-bar's advanced control.

				$widget_container_class = apply_filters( 'layers_tabs_widget_container_class', $widget_container_class, $this, $instance );
				$widget_container_class = implode( ' ', $widget_container_class );

				// Custom Anchor
				echo $this->custom_anchor( $instance ); ?>

				<div id="<?php echo esc_html( $widget_id ); ?>" class="<?php echo esc_attr( $widget_container_class ); ?>" <?php $this->selective_refresh_atts( $args ); ?>>

					<?php if( NULL !== $this->check_and_return( $instance , 'title' ) || NULL !== $this->check_and_return( $instance , 'excerpt' ) ) { ?>
						<div class="container clearfix">
							<?php
							/**
							 * Generate Classes
							 */
							$classes = array();
							$classes[] = $this->check_and_return( $instance , 'design', 'fonts', 'size' );
							$classes[] = $this->check_and_return( $instance , 'design', 'fonts', 'align' );
							$classes[] = ( $this->check_and_return( $instance, 'design', 'background' , 'color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) ? 'invert' : '' );
							$classes = implode( ' ', $classes ); ?>
							<div class="section-title clearfix <?php echo esc_attr( $classes ); ?>">
								<?php if( '' != $instance['title'] ) { ?>
									<<?php echo $this->check_and_return( $instance, 'design', 'fonts', 'heading-type' ); ?> class="heading">
										<?php echo esc_html( $instance['title'] ); ?>
									</<?php echo $this->check_and_return( $instance, 'design', 'fonts', 'heading-type' ); ?>>
								<?php } ?>
								<?php if( '' != $instance['excerpt'] ) { ?>
									<div class="excerpt"><?php layers_the_content( $instance['excerpt'] ); ?></div>
								<?php } ?>
							</div>
						</div>
					<?php }

					if( ! empty( $instance['tabs'] ) ) {

						/**
						 * Generate Classes
						 */
						$classes = array();
						$classes[] = ( NULL !== $this->check_and_return( $instance, 'design', 'buttons-background-color' ) ? 'no-background' : '' );
						$classes[] = ( NULL !== $this->check_and_return( $instance, 'design', 'buttons-border-position' ) ? 'has-borders' : '' ); 
						$classes[] = $this->get_widget_layout_class( $instance );
						$classes = implode( ' ', $classes );
						?>
						<div class="tab-row nav-tabs no-inset <?php echo esc_attr( $classes ); ?>">
							<ul>
								<?php
								/**
								 * Loop Items
								 */
								$i = 0;
								foreach ( explode( ',', $instance['tab_ids'] ) as $item_key ) {

									// Setup Internal Vars.
									$item_instance = $instance['tabs'][ $item_key ];
									$item_id_attr  = "{$widget_id}-tabs-{$item_key}";

									// Mix in new/unset defaults on every instance load (NEW)
									$item_instance = $this->apply_defaults( $item_instance, 'tab' );

									// Make sure we've got a tab going on here
									if( ! isset( $instance['tabs'][$item_key ]) ) continue;

									if( ! $this->check_and_return( $item_instance, 'tab-title' ) ) continue;

									/**
									 * Generate Classes
									 */
									$classes = array();
									$classes[] = 'tab';

									if( 0 == $i )
										$classes[] = 'active';

									if( $this->check_and_return( $instance, 'design', 'buttons-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'buttons-background-color' ) ) ) {
										$classes[] = 'invert';
									} elseif( $this->check_and_return( $instance, 'design', 'background' , 'color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) ) {
										$classes[] = 'invert';
									}

									$classes[] = 'btn-medium'; // Button Size

									$classes = implode( ' ', $classes );
									?>
									<li
										id="<?php echo esc_attr( $item_id_attr ); ?>"
										class="<?php echo esc_attr( $classes ); ?>"
										>
										<a href="#"><?php echo $this->check_and_return( $item_instance, 'tab-title' ); ?></a>
									</li>
									<?php $i++; ?>
								<?php } ?>
							</ul>
						</div>

						<div class="tab-content <?php echo $this->get_widget_layout_class( $instance ); ?>">
							<?php
							/**
							 * Loop Items
							 */
							foreach ( explode( ',', $instance['tab_ids'] ) as $item_key ) {

								// Make sure we've got a tab going on here
								if( ! isset( $instance['tabs'][$item_key ]) ) continue;

								// Setup Internal Vars.
								$type          = 'tab';
								$item_instance = $instance['tabs'][ $item_key ];
								$item_id_attr  = "{$widget_id}-{$item_key}";


								// Calculate which cut based on ratio.
								if( $this->check_and_return( $item_instance, 'design', 'imageratios' ) ){

									// Translate Image Ratio into something usable
									$image_ratio = layers_translate_image_ratios( $this->check_and_return( $item_instance, 'design', 'imageratios' ) );
									
									$use_image_ratio = $image_ratio . '-medium';

								} else {
									$use_image_ratio = 'medium';
								}

								// Set the background styling
								if( NULL !== $this->check_and_return( $item_instance, 'design', 'background' ) ) 
									$this->inline_css .= layers_inline_styles( "#{$widget_id}-{$item_key}", 'background', array( 'background' => $this->check_and_return( $item_instance, 'design', 'background' ) ) );

								if( NULL !== $this->check_and_return( $item_instance, 'design', 'fonts', 'excerpt-color' ) )	 
									$this->inline_css .= layers_inline_styles( "#{$widget_id}-{$item_key}", 'color', array( 'selectors' => array( 'div.excerpt', 'div.excerpt p', 'div.excerpt a' ) , 'color' => $this->check_and_return( $item_instance, 'design', 'fonts', 'excerpt-color' ) ) );

								if( NULL !== $this->check_and_return( $item_instance, 'design', 'fonts', 'shadow' ) )
									$this->inline_css .= layers_inline_styles( "#{$widget_id}-{$item_key}", 'text-shadow', array( 'selectors' => array( '.heading a', '.heading' , 'div.excerpt' , 'div.excerpt p' )  , 'text-shadow' => $this->check_and_return( $item_instance, 'design', 'fonts', 'shadow' ) ) );

								// Set column margin & padding
								if( NULL !== $this->check_and_return( $item_instance, 'design', 'advanced', 'margin' ) )
									$this->inline_css .= layers_inline_styles( "#{$widget_id}-{$item_key}", 'margin', array( 'margin' => $this->check_and_return( $item_instance, 'design', 'advanced', 'margin' ) ) );
								
								if( NULL !== $this->check_and_return( $item_instance, 'design', 'advanced', 'padding' ) )
									$this->inline_css .= layers_inline_styles( "#{$widget_id}-{$item_key}", 'padding', array( 'padding' => $this->check_and_return( $item_instance, 'design', 'advanced', 'padding' ) ) );

								// Get the link array.
								$link_array       = $this->check_and_return_link( $item_instance, 'button' );
								$link_href_attr   = ( $link_array['link'] ) ? 'href="' . esc_url( $link_array['link'] ) . '"' : '';
								$link_target_attr = ( '_blank' == $link_array['target'] ) ? 'target="_blank"' : '';

								/**
								 * Generate Classes
								 */
								$tab_classes = array();
								$tab_classes[] = 'row';
								$tab_classes[] = ( $this->check_and_return( $item_instance , 'design' , 'featuredimage' ) || $this->check_and_return( $item_instance , 'design' , 'featuredvideo' ) ) ? 'has-image content' : '';
								$tab_classes[] = ( 'on' == $this->check_and_return( $item_instance , 'design', 'background', 'darken' ) ? 'darken' : '' );

								if( $this->check_and_return( $instance, 'design', 'buttons-background-color' ) ) {
									if( 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'buttons-background-color' ) ) ) {
										$tab_classes[] = 'invert';
									}
								} elseif( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) {
									if( 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) ) {
										$tab_classes[] = 'invert';
									}
								}
								$tab_classes = implode( ' ', $tab_classes ); ?>

								<div id="<?php echo esc_attr( $item_id_attr ); ?>" class="<?php echo esc_attr( $tab_classes ); ?>">
									
									<?php $tab_inner_classes = array();
									$tab_inner_classes[] = 'media';
									$tab_inner_classes[] = 'container';
									$tab_inner_classes[] = 'content';
									$tab_inner_classes[] = ( !$this->check_and_return( $instance, 'design', 'gutter' ) ? 'no-push-bottom' : '' );
									$tab_inner_classes[] = $this->check_and_return( $item_instance, 'design', 'imagealign' );
									$tab_inner_classes[] = $this->check_and_return( $item_instance, 'design', 'fonts' , 'size' );

									if( $this->check_and_return( $item_instance, 'design', 'background' , 'color' ) ) {
										if( 'dark' == layers_is_light_or_dark( $this->check_and_return( $item_instance, 'design', 'background' , 'color' ) ) ) {
											$tab_inner_classes[] = 'invert';
										}
									} else {
										if( $this->check_and_return( $instance, 'design', 'background' , 'color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) ) {
											$tab_inner_classes[] = 'invert';
										}
									}
									$tab_inner_classes = implode( ' ', $tab_inner_classes ); ?>

									<div class="<?php echo $tab_inner_classes; ?>">

										<?php // Display featured image
										$this->featured_media( 'media-image', $item_instance ); ?>

										<?php if( $this->check_and_return( $item_instance, 'content' ) || ( $link_array['link'] && $link_array['text'] ) ) { ?>
											<div class="media-body <?php echo ( isset( $item_instance['design']['fonts'][ 'align' ] ) ) ? $item_instance['design']['fonts'][ 'align' ] : ''; ?>">
												<?php if( $this->check_and_return( $item_instance, 'content' ) ) { ?>
													<div class="excerpt"><?php layers_the_content( $item_instance['content'] ); ?></div>
												<?php } ?>
												<?php if ( $link_array['link'] && $link_array['text'] ) { ?>
													<a <?php echo $link_href_attr; ?> class="button <?php echo $button_size; ?>" <?php echo $link_target_attr; ?>>
														<?php echo $link_array['text']; ?>
													</a>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					<?php }

					if( method_exists( $this, 'print_inline_css' ) ) {
						$this->print_inline_css( $this, $instance );
					} ?>
				</div>
			<?php }

			/**
			*  Widget update
			*/
			function update( $new_instance, $old_instance ) {
				if ( isset( $this->checkboxes ) ) {
					foreach( $this->checkboxes as $cb ) {
						if( isset( $old_instance[ $cb ] ) ) {
							$old_instance[ $cb ] = strip_tags( $new_instance[ $cb ] );
						}
					} // foreach checkboxes
				} // if checkboxes
				return $new_instance;
			}

			/**
			* Widget form
			*
			* We use regular HTML here, it makes reading the widget much easier than if we used just php to echo all the HTML out.
			*/
			function form( $instance ){

				// Use defaults if $instance is empty.
				if( empty( $instance ) && ! empty( $this->defaults ) ) {
					$instance = wp_parse_args( $instance, $this->defaults );
				}

				// Mix in new/unset defaults on every instance load (NEW)
				$instance = $this->apply_defaults( $instance );

				$this->design_bar(
					'side', // CSS Class Name
					array( // Widget Object
						'name' => $this->get_layers_field_name( 'design' ),
						'id' => $this->get_layers_field_id( 'design' ),
						'widget_id' => $this->widget_id,
						'widget_object' => $this,
					),
					$instance, // Widget Values
					apply_filters( 'layers_tabs_widget_design_bar_components',
						array( // Components
							'layout',
							'background',
							'advanced',
						),
					$this, $instance )
				); ?>
				<div class="layers-container-large" id="layers-column-widget-<?php echo $this->number; ?>">

					<?php
					$this->form_elements()->header( array(
						'title' =>'Tabs',
						'icon_class' =>'text'
					) );
					?>

					<section class="layers-accordion-section layers-content">

						<div class="layers-form-item">

							<?php echo $this->form_elements()->input(
								array(
									'type' => 'text',
									'name' => $this->get_layers_field_name( 'title' ),
									'id' => $this->get_layers_field_id( 'title' ),
									'placeholder' => __( 'Enter title here', 'layers-pro' ),
									'value' => ( isset( $instance['title'] ) ) ? $instance['title'] : NULL,
									'class' => 'layers-text layers-large',
								)
							); ?>

							<?php $this->design_bar(
								'top', // CSS Class Name
								array( // Widget Object
									'widget_object' => $this,
									'name' => $this->get_layers_field_name( 'design' ),
									'id' => $this->get_layers_field_id( 'design' ),
									'widget_id' => $this->widget_id,
									'show_trash' => FALSE,
									'inline' => TRUE,
									'align' => 'right',
								),
								$instance, // Widget Values
								apply_filters( 'layers_tabs_widget_inline_design_bar_components', array( // Components
									'header_excerpt',
								), $this, $instance )
							); ?>

						</div>
						<div class="layers-form-item">

							<?php echo $this->form_elements()->input(
								array(
									'type' => 'rte',
									'name' => $this->get_layers_field_name( 'excerpt' ),
									'id' => $this->get_layers_field_id( 'excerpt' ),
									'placeholder' =>  __( 'Short Excerpt', 'layers-pro' ),
									'value' => ( isset( $instance['excerpt'] ) ) ? $instance['excerpt'] : NULL,
									'class' => 'layers-textarea layers-large',
								)
							); ?>

						</div>
						<div class="layers-form-item">

							<?php $this->repeater( 'tab', $instance ); ?>

						</div>

					</section>

				</div>

			<?php }

			/**
			*  Widget repeated item display.
			*/
			function tab_item( $item_guid, $item_instance ) {

				// Required - Get the name of this type.
				$type = str_replace( '_item', '', __FUNCTION__ );

				// Mix in new/unset defaults on every instance load (NEW)
				$item_instance = $this->apply_defaults( $item_instance, 'tab' );
				?>
				<li class="layers-accordion-item <?php echo $this->item_count; ?>" data-guid="<?php echo esc_attr( $item_guid ); ?>">
					
					<a class="layers-accordion-title">
						<span>
							<?php echo ucfirst( $type ); ?><span class="layers-detail"><?php if ( isset( $item_instance['tab-title'] ) ) echo $this->format_repeater_title( $item_instance['tab-title'] ); ?></span>
						</span>
					</a>
					
					<section class="layers-accordion-section layers-content">

						<?php
						$this->design_bar(
							'top', // CSS Class Name
							array( // Widget Object
								'widget_object' => $this,
								'name'       => $this->get_layers_field_name( 'design' ),
								'id'         => $this->get_layers_field_id( 'design' ),
								'widget_id'  => $this->widget_id,
								'number'     => $this->number,
								'show_trash' => TRUE,
							),
							$item_instance, // Widget Values
							
							apply_filters( 'layers_tabs_widget_item_design_bar_components', array( // Components
								'background',
								'featuredimage',
								'imagealign',
								'header_excerpt',
								'advanced' => array(
									'elements' => array(
										'advanced-margin-padding-start' => array(
											'type' => 'group-start',
											'label' => __( 'Margin &amp; Padding', 'layerswp' ),
										),
										'padding' => array(
											'type' => 'inline-numbers-fields',
											'label' => __( 'Padding (px)', 'layerswp' ),
											'name' => $this->get_layers_field_name( 'design', 'advanced', 'padding' ),
											'id' => $this->get_layers_field_id( 'design', 'advanced', 'padding' ),
											'value' => ( isset( $item_instance['design']['advanced']['padding'] ) ) ? $item_instance['design']['advanced']['padding'] : NULL,
											'fields' => array(
												'top',
												'right',
												'bottom',
												'left',
											),
											'input_class' => 'inline-fields-flush',
										),
										'margin' => array(
											'type' => 'inline-numbers-fields',
											'label' => __( 'Margin (px)', 'layerswp' ),
											'name' => $this->get_layers_field_name( 'design', 'advanced', 'margin' ),
											'id' => $this->get_layers_field_id( 'design', 'advanced', 'margin' ),
											'value' => ( isset( $item_instance['design']['advanced']['margin'] ) ) ? $item_instance['design']['advanced']['margin'] : NULL,
											'fields' => array(
												'top',
												'bottom',
											),
											'input_class' => 'inline-fields-flush',
										),
										'advanced-margin-padding-end' => array(
											'type' => 'group-end',
										),
										'advanced-custom-class-start' => array(
											'type' => 'group-start',
											'label' => __( 'Custom Classes', 'layerswp' ),
										),
										'customclass',
										'advanced-custom-class-end' => array(
											'type' => 'group-end'
										),
									),
									'elements_combine' => 'replace',
								),
							), $this, $item_instance )
						);
						?>

						<div class="layers-row">
							<div class="layers-column layers-span-12">
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'tab-title' ); ?>"><?php _e( 'Title' , 'layers-pro' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'text',
											'name' => $this->get_layers_field_name( 'tab-title' ),
											'id' => $this->get_layers_field_id( 'tab-title' ),
											'placeholder' => __( 'Tab Title', 'layers-pro' ),
											'value' => ( isset( $item_instance['tab-title'] ) ) ? $item_instance['tab-title'] : NULL ,
											'class' => 'layers-text'
										)
									); ?>
								</p>

								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'content' ); ?>"><?php _e( 'Excerpt' , 'layers-pro' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'rte',
											'name' => $this->get_layers_field_name( 'content' ),
											'id' => $this->get_layers_field_id( 'content' ),
											'placeholder' =>  __( 'Short Excerpt', 'layers-pro' ),
											'value' => ( isset( $item_instance['content'] ) ) ? $item_instance['content'] : NULL ,
											'class' => 'layers-textarea'
										)
									); ?>
								</p>

								<div class="layers-form-item">
									<label>
										<?php _e( 'Insert Link' , 'layerswp' ); ?>
									</label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'link-group',
											'name' => $this->get_layers_field_name( 'button' ),
											'id' => $this->get_layers_field_id( 'button' ),
											'value' => ( isset( $item_instance['button'] ) ) ? $item_instance['button'] : NULL,
										)
									); ?>
								</div>
							</div>
						</div>

					</section>

				</li>
				<?php
			}

		}

		// Add our function to the widgets_init hook.
		register_widget("Layers_Tabs_Widget");
	}
}
add_action( 'widgets_init', 'layers_tabs_widget_init', 40 );
