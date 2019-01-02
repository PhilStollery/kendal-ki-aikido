<?php

function layers_pro_apply_control_button_styling( $prefix, $selectors ) {

	$css = array();

	// Prep: Background.
	if ( 'transparent' == layers_get_theme_mod( "{$prefix}-background-style" ) ) {

		/**
		 * Transparent Background.
		 */

		$css['background']   = 'transparent';
	}
	else if ( 'gradient' == layers_get_theme_mod( "{$prefix}-background-style" ) ) {

		/**
		 * Gradient Background.
		 */

		if (
			'' != layers_get_theme_mod( "{$prefix}-background-gradient-start-color", FALSE ) &&
			'' != layers_get_theme_mod( "{$prefix}-background-gradient-end-color", FALSE )
			) {

			$gradient_start_color = layers_get_theme_mod( "{$prefix}-background-gradient-start-color", FALSE );
			$gradient_end_color   = layers_get_theme_mod( "{$prefix}-background-gradient-end-color", FALSE );

			$gradient_start_color_hover = layers_too_light_then_dark( $gradient_start_color, 20 );
			$gradient_end_color_hover   = layers_too_light_then_dark( $gradient_end_color, 20 );

			$gradient_degrees = ( '' != layers_get_theme_mod( "{$prefix}-background-gradient-direction", FALSE ) ) ? layers_get_theme_mod( "{$prefix}-background-gradient-direction", FALSE ) . 'deg, ' : '';
			$css['background'] = "linear-gradient( $gradient_degrees $gradient_start_color, $gradient_end_color )";
		}
	}
	else if ( 'solid' == layers_get_theme_mod( "{$prefix}-background-style" ) ) {

		/**
		 * Solid Background.
		 */

		if ( '' != layers_get_theme_mod( "{$prefix}-background-color", FALSE ) ) {

			$css['background'] = layers_get_theme_mod( "{$prefix}-background-color", FALSE );
		}
	}

	// Prep: Text Color.
	if ( layers_get_theme_mod( "{$prefix}-text-color", FALSE ) ) {
		$css['color'] = layers_get_theme_mod( "{$prefix}-text-color");
	}

	// Prep: Text Shadow.
	if ( layers_get_theme_mod( "{$prefix}-text-shadow", FALSE ) ) {
		if ( 'top' == layers_get_theme_mod( "{$prefix}-text-shadow") ) $css['text-shadow'] = '0 -1px rgba(0,0,0,0.3)';
		if ( 'bottom' == layers_get_theme_mod( "{$prefix}-text-shadow") ) $css['text-shadow'] = '0 1px rgba(0,0,0,0.3)';
	}

	// Prep: Text Transform.
	if ( layers_get_theme_mod( "{$prefix}-text-transform" ) ) {
		$css['text-transform'] = layers_get_theme_mod( "{$prefix}-text-transform" );
	}

	// Prep: Shadow.
	if ( layers_get_theme_mod( "{$prefix}-shadow", FALSE ) ) {
		if ( 'small' == layers_get_theme_mod( "{$prefix}-shadow") ) $css['box-shadow'] = '0 1px 0 rgba(0,0,0,0.15)';
		if ( 'medium' == layers_get_theme_mod( "{$prefix}-shadow") ) $css['box-shadow'] = '0 1px 5px rgba(0,0,0,0.2)';
		if ( 'large' == layers_get_theme_mod( "{$prefix}-shadow") ) $css['box-shadow'] = '0 3px 10px rgba(0,0,0,0.2)';
	}

	// Prep: Border Width.
	if ( '' != layers_get_theme_mod( "{$prefix}-border-width", FALSE ) ) {
		$css['border-width'] = layers_get_theme_mod( "{$prefix}-border-width") . 'px';
	}

	// Prep: Border Color.
	if ( '' !== layers_get_theme_mod( "{$prefix}-border-color") ) {
		$css['border-color'] = layers_get_theme_mod( "{$prefix}-border-color", FALSE );
	}

	// Prep: Border Radius.
	if ( '' !== layers_get_theme_mod( "{$prefix}-border-radius" ) && 0 !== layers_get_theme_mod( "{$prefix}-border-radius") ) {
		$css['border-radius'] = layers_get_theme_mod( "{$prefix}-border-radius") . 'px';
	}

	/**
	 * Apply Button Styling
	 */
	layers_pro_apply_button_styling( $selectors, $css, TRUE );
}

function layers_pro_apply_widget_button_styling( $widget, $item, $selectors ) {

	// Make sure the 'buttons' values are at the root of the item instance, not nested deeper in 'design' - so it is one size fits all.
	if ( isset( $item['design'] ) ) {
		foreach ( $item['design'] as $key => $value ) {
			if ( -1 < strpos( $key, 'buttons-' ) && isset( $item['design'] ) ) {
				$item = $item['design'];
			}
		}
	}
	
	/*
	 * Button Main Styling.
	 */
	
	$css = array();

	// Prep: Background.
	if ( 'transparent' == $widget->check_and_return( $item, 'buttons-background-style' ) ) {

		// Transparent Background.
		$css['background']       = 'transparent';
	}
	else if ( 'gradient' == $widget->check_and_return( $item, 'buttons-background-style' ) ) {

		if (
				NULL != $widget->check_and_return( $item, 'buttons-background-gradient-start-color' ) &&
				NULL != $widget->check_and_return( $item, 'buttons-background-gradient-end-color' )
			) {

			// Gradient Background.
			$gradient_start_color = $widget->check_and_return( $item, 'buttons-background-gradient-start-color' );
			$gradient_end_color   = $widget->check_and_return( $item, 'buttons-background-gradient-end-color' );

			$gradient_start_color_hover = layers_too_light_then_dark( $gradient_start_color, 20 );
			$gradient_end_color_hover   = layers_too_light_then_dark( $gradient_end_color, 20 );

			$gradient_degrees = ( NULL != $widget->check_and_return( $item, 'buttons-background-gradient-direction' ) ) ? $widget->check_and_return( $item, 'buttons-background-gradient-direction' ) . 'deg, ' : '';
			$css['background'] = "linear-gradient( $gradient_degrees $gradient_start_color, $gradient_end_color )";
		}
	}
	else if ( 'solid' == $widget->check_and_return( $item, 'buttons-background-style' ) ) {

		// Solid Background.
		if ( NULL != $widget->check_and_return( $item, 'buttons-background-color' ) ) {
			$css['background'] = $widget->check_and_return( $item, 'buttons-background-color' );
		}
	}

	// Prep: Text Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-color' ) ) {
		$css['color'] = $widget->check_and_return( $item, 'buttons-text-color');
	}
	
	// Prep: Text Transform.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-transform' ) ) {
		$css['text-transform'] = $widget->check_and_return( $item, 'buttons-text-transform' );
	}

	// Prep: Border Width.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-style', 'width' ) ) {
		
		$css['border-width'] = $widget->check_and_return( $item, 'buttons-border-style', 'width' ) . 'px';
		
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-style', 'style' ) ) {
			$css['border-style'] = $widget->check_and_return( $item, 'buttons-border-style', 'style' );
		}
		else {
			$css['border-style'] = 'solid';
		}
		
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-border-style', 'radius' ) ) {
		$css['border-radius'] = $widget->check_and_return( $item, 'buttons-border-style', 'radius' ) . 'px';
	}
	
	// Prep: Border Width - Individual Borders.
	if (
			isset( $css['border-width'] ) &&
			(
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'top' ) ||
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'right' ) ||
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'bottom' ) ||
				NULL != $widget->check_and_return( $item, 'buttons-border-position', 'left' )
			)
		) {
		
		// Save the border width, then unset it.
		$border_width = $css['border-width'];
		unset( $css['border-width'] );
		
		// Set the individual border widths.
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'top' ) ) {
			$css['border-top-width'] = $border_width;
		}
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'right' ) ) {
			$css['border-right-width'] = $border_width;
		}
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'bottom' ) ) {
			$css['border-bottom-width'] = $border_width;
		}
		if ( NULL != $widget->check_and_return( $item, 'buttons-border-position', 'left' ) ) {
			$css['border-left-width'] = $border_width;
		}
	}
	
	// Prep: Border Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-color') ) {
		$css['border-color'] = $widget->check_and_return( $item, 'buttons-border-color');
	}
	
	// Prep: Text Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-color' ) ) {
		$css['color'] = $widget->check_and_return( $item, 'buttons-text-color');
	}
	
	// Prep: Font Size.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-size', 'font-size' ) ) {
		$font_size = ( $widget->check_and_return( $item, 'buttons-text-size', 'font-size' ) ) / 10;
		$css['font-size'] = $font_size . 'rem';
	}
	
	// Prep: Line Height.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-size', 'line-height' ) ) {
		$css['line-height'] = $widget->check_and_return( $item, 'buttons-text-size', 'line-height' ) . 'px';
	}
	
	// Prep: Letter Spacing.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-size', 'letter-spacing' ) ) {
		$css['letter-spacing'] = $widget->check_and_return( $item, 'buttons-text-size', 'letter-spacing' ) . 'px';
	}
	
	// Prep: Font Weight.
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
		
		if ( 'light' == $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
			$css['font-weight'] = '300';
		}
		elseif ( 'normal' == $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
			$css['font-weight'] = 'normal';
		}
		elseif ( 'bold' == $widget->check_and_return( $item, 'buttons-font-weight' ) ) {
			$css['font-weight'] = '700';
		}
	}
	
	// Prep: Font Style.
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'italic' ) ) {
		$css['font-style'] = 'italic';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'underline' ) ) {
		$css['text-decoration'] = 'underline';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'strikethrough' ) ) {
		$css['text-decoration'] = 'line-through';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-font-style', 'uppercase' ) ) {
		$css['text-transform'] = 'uppercase';
	}
	
	// Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-shadow-color' ) ) {
		
		$shadow_color = $widget->check_and_return( $item, 'buttons-shadow-color' );
		$shadow_x = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'x' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'x' ) . 'px' : '0px' ;
		$shadow_y = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'y' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'y' ) . 'px' : '1px' ;
		$shadow_blur = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'blur' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'blur' ) . 'px' : '3px' ;
		$shadow_spread = ( NULL != $widget->check_and_return( $item, 'buttons-shadow-size', 'spread' ) ) ? $widget->check_and_return( $item, 'buttons-shadow-size', 'spread' ) . 'px' : '' ;
		
		$css['box-shadow'] = "{$shadow_x} {$shadow_y} {$shadow_blur} {$shadow_spread} {$shadow_color}";
	}
	
	// (OLD) Prep: Border Width.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-width' ) ) {
		$css['border-width'] = $widget->check_and_return( $item, 'buttons-border-width') . 'px';
	}
	
	// (OLD) Prep: Border Width.
	if ( NULL != $widget->check_and_return( $item, 'buttons-border-width' ) ) {
		$css['border-width'] = $widget->check_and_return( $item, 'buttons-border-width') . 'px';
	}

	// (OLD) Prep: Border Radius.
	if ( $widget->check_and_return( $item, 'buttons-border-radius' ) && 0 !== $widget->check_and_return( $item, 'buttons-border-radius') ) {
		$css['border-radius'] = $widget->check_and_return( $item, 'buttons-border-radius') . 'px';
	}
	
	// (OLD) Prep: Text Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-shadow' ) ) {
		if ( 'top' == $widget->check_and_return( $item, 'buttons-text-shadow') ) $css['text-shadow'] = '0 -1px rgba(0,0,0,0.3)';
		if ( 'bottom' == $widget->check_and_return( $item, 'buttons-text-shadow') ) $css['text-shadow'] = '0 1px rgba(0,0,0,0.3)';
	}
	
	// (OLD) Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-shadow' ) ) {
		if ( 'small' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 0 rgba(0,0,0,0.15)';
		if ( 'medium' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 5px rgba(0,0,0,0.2)';
		if ( 'large' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 3px 10px rgba(0,0,0,0.2)';
	}
	
	// (OLD) Prep: Text Transform.
	if ( NULL != $widget->check_and_return( $item, 'buttons-text-transform' ) ) {
		$css['text-transform'] = $widget->check_and_return( $item, 'buttons-text-transform' );
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-padding' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){

			if ( NULL != $widget->check_and_return( $item, 'buttons-padding', $trbl ) )
				$css[ 'padding-' . $trbl ] = $widget->check_and_return( $item, 'buttons-padding', $trbl ) . 'px';

		}
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-margin' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){
		
			if ( NULL != $widget->check_and_return( $item, 'buttons-margin', $trbl ) )
				$css[ 'margin-' . $trbl ] = $widget->check_and_return( $item, 'buttons-margin', $trbl ) . 'px';

		}
	}

	
	// (OLD) Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-shadow' ) ) {
		if ( 'small' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 0 rgba(0,0,0,0.15)';
		if ( 'medium' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 1px 5px rgba(0,0,0,0.2)';
		if ( 'large' == $widget->check_and_return( $item, 'buttons-shadow') ) $css['box-shadow'] = '0 3px 10px rgba(0,0,0,0.2)';
	}
	
	/*
	 * Button Hover Styling.
	 */
	
	$hover_css = array();

	// Prep: Background.
	if ( 'transparent' == $widget->check_and_return( $item, 'buttons-hover-background-style' ) ) {

		// Transparent Background.
		$hover_css['background']       = 'transparent';
	}
	else if ( 'gradient' == $widget->check_and_return( $item, 'buttons-hover-background-style' ) ) {

		if (
				NULL != $widget->check_and_return( $item, 'buttons-hover-background-gradient-start-color' ) &&
				NULL != $widget->check_and_return( $item, 'buttons-hover-background-gradient-end-color' )
			) {

			// Gradient Background.
			$gradient_start_color = $widget->check_and_return( $item, 'buttons-hover-background-gradient-start-color' );
			$gradient_end_color   = $widget->check_and_return( $item, 'buttons-hover-background-gradient-end-color' );

			$gradient_start_color_hover = layers_too_light_then_dark( $gradient_start_color, 20 );
			$gradient_end_color_hover   = layers_too_light_then_dark( $gradient_end_color, 20 );

			$gradient_degrees = ( NULL != $widget->check_and_return( $item, 'buttons-hover-background-gradient-direction' ) ) ? $widget->check_and_return( $item, 'buttons-hover-background-gradient-direction' ) . 'deg, ' : '';
			$hover_css['background'] = "linear-gradient( $gradient_degrees $gradient_start_color, $gradient_end_color )";
		}
	}
	else if ( 'solid' == $widget->check_and_return( $item, 'buttons-hover-background-style' ) ) {

		// Solid Background.
		if ( NULL != $widget->check_and_return( $item, 'buttons-hover-background-color' ) ) {
			$hover_css['background'] = $widget->check_and_return( $item, 'buttons-hover-background-color' );
		}
	}
	
	// Prep: Button Border Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-border-color') ) {
		$hover_css['border-color'] = $widget->check_and_return( $item, 'buttons-hover-border-color');
	}
	
	// Prep: Text Color.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-text-color' ) ) {
		$hover_css['color'] = $widget->check_and_return( $item, 'buttons-hover-text-color');
	}
	
	// Prep: Font Weight.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
		
		if ( 'light' == $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
			$hover_css['font-weight'] = '300';
		}
		elseif ( 'normal' == $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
			$hover_css['font-weight'] = 'normal';
		}
		elseif ( 'bold' == $widget->check_and_return( $item, 'buttons-hover-font-weight' ) ) {
			$hover_css['font-weight'] = '700';
		}
	}
	
	// Prep: Font Style.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-style', 'italic' ) ) {
		$hover_css['font-style'] = 'italic';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-style', 'underline' ) ) {
		$hover_css['text-decoration'] = 'underline';
	}
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-font-style', 'strikethrough' ) ) {
		$hover_css['text-decoration'] = 'line-through';
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-padding' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){
		
			if ( NULL != $widget->check_and_return( $item, 'buttons-hover-padding', $trbl ) )
				$hover_css[ 'padding-' . $trbl ] = $widget->check_and_return( $item, 'buttons-hover-padding', $trbl ) . 'px';

		}
	}

	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-margin' ) ) {

		foreach( array( 'top', 'right', 'bottom', 'left' ) as $trbl ){

			if ( NULL != $widget->check_and_return( $item, 'buttons-hover-margin', $trbl ) )
				$hover_css[ 'margin-' . $trbl ] = $widget->check_and_return( $item, 'buttons-hover-margin', $trbl ) . 'px';

		}
	}

	
	// Prep: Shadow.
	if ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-color' ) ) {
		
		$shadow_color = $widget->check_and_return( $item, 'buttons-hover-shadow-color' );
		$shadow_x = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'x' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'x' ) . 'px' : '0px' ;
		$shadow_y = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'y' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'y' ) . 'px' : '1px' ;
		$shadow_blur = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'blur' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'blur' ) . 'px' : '3px' ;
		$shadow_spread = ( NULL != $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'spread' ) ) ? $widget->check_and_return( $item, 'buttons-hover-shadow-size', 'spread' ) . 'px' : '' ;
		
		$hover_css['box-shadow'] = "{$shadow_x} {$shadow_y} {$shadow_blur} {$shadow_spread} {$shadow_color}";
	}
	
	/**
	 * Apply Button Styling
	 */
	return layers_pro_apply_button_styling( $selectors, $css, $hover_css );
}

function layers_pro_apply_button_styling( $selectors, $css, $hover_css = FALSE ) {

	$styles = '';

	/**
	 * Apply Main Styles
	 */

	$styles .= layers_inline_styles( implode( ', ', $selectors ), array( 'css' => $css ) );

	/**
	 * Apply Main Styles :before & :after.
	 */

	$before_and_after_css = array();
	if ( isset( $css['color'] ) ) $before_and_after_css['color'] = $css['color'];
	if ( isset( $css['text-shadow'] ) ) $before_and_after_css['text-shadow'] = $css['text-shadow'];
	$styles .= layers_inline_styles( implode( ':before, ', $selectors ) . ':before ' . implode( ':after, ', $selectors ) . ':after', array( 'css' => $before_and_after_css ) );

	/**
	 * Apply Hover Styles
	 */
	
	if ( TRUE === $hover_css || is_array( $hover_css ) ) {
		
		if ( TRUE === $hover_css ) {
			
			/**
			 * Optionally create hover styles dynamically.
			 */
			
			$hover_css = array();

			// Background Color.
			if ( isset( $css['background'] ) ) {

				if ( 0 === strpos( $css['background'], '#' ) ) {

					// Background is a #hex color - so set background to a lighter shade of that color.
					// $hover_css['background'] = layers_too_light_then_dark( $css['background'] );
					$hover_css['background'] = layers_adjust_brightness( $css['background'], 35, true );
				}
			}

			// Text Color.
			if ( isset( $css['border-color'] ) ) {

				if (
						0 === strpos( $css['border-color'], '#' ) &&
						isset( $css['border-width'] ) && 0 !== ( (int) $css['border-width'] )
					) {
					// $hover_css['border-color'] = layers_too_light_then_dark( $css['border-color'] );
					$hover_css['border-color'] = layers_adjust_brightness( $css['border-color'], -55, true );
				}
			}

			// Text Color.
			if ( isset( $css['color'] ) && ! isset( $hover_css['color'] ) ) {
				/*
				// $hover_css['color'] = layers_too_light_then_dark( $css['color'] );
				$hover_css['color'] = layers_adjust_brightness( $css['color'], 35, true );
				*/
			}
		}
		
		/**
		 * Apply Hover Styles.
		 */
		$styles .= layers_inline_styles( implode( ':hover, ', $selectors ) . ':hover', array( 'css' => $hover_css ) );

		/**
		 * Apply Hover Styles :before & :after.
		 */
		$before_and_after_css = array();
		if ( isset( $hover_css['color'] ) ) $before_and_after_css['color'] = $hover_css['color'];
		if ( isset( $hover_css['text-shadow'] ) ) $before_and_after_css['text-shadow'] = $hover_css['text-shadow'];
		$styles .= layers_inline_styles( implode( ':before, ', $selectors ) . ':before ' . implode( ':after, ', $selectors ) . ':after', array( 'css' => $before_and_after_css ) );
	}

	// Debugging:
	global $wp_customize;
	if ( $wp_customize && ( ( bool ) layers_get_theme_mod( 'dev-switch-button-css-testing' ) ) ) {

		echo '<pre style="font-size:11px;">';

		if ( 0 === strpos( $selectors[0], '#' ) )
			print_r( $selectors );
		else
			echo "GLOBAL\n";

		echo "button -----------------------\n";
		if ( empty( $css ) )
			echo '';
		else
			foreach ( $css as $key => $value )
				echo "$key: $value\n";

		echo "button:hover -----------------\n";
		if ( empty( $hover_css ) )
			echo '';
		else
			foreach ( $hover_css as $key => $value )
				echo "$key: $value\n";

		echo '</pre>';
	}

	return $styles;
}

function layers_pro_get_social_networks( $type = NULL ) {

	$return_collection = array();

	$networks = array(
		'apple'         => array( 'name' => 'Apple',            'icon_class' => 'fa fa-apple',           'base_url' => 'itunes.apple.com' ), // New
		'behance'       => array( 'name' => 'Behance',          'icon_class' => 'fa fa-behance',         'base_url' => 'behance.net' ),
		'bitbucket'     => array( 'name' => 'Bitbucket',        'icon_class' => 'fa fa-bitbucket',       'base_url' => 'bitbucket.org' ),
		'dribbble'      => array( 'name' => 'Dribbble',         'icon_class' => 'fa fa-dribbble',        'base_url' => 'dribbble.com' ),
		'dropbox'       => array( 'name' => 'Dropbox',          'icon_class' => 'fa fa-dropbox',         'base_url' => 'dropbox.com' ),
		'facebook'      => array( 'name' => 'Facebook',         'icon_class' => 'fa fa-facebook',        'base_url' => 'facebook.com' ),
		'flickr'        => array( 'name' => 'Flickr',           'icon_class' => 'fa fa-flickr',          'base_url' => 'flickr.com' ),
		'foursquare'    => array( 'name' => 'Foursquare',       'icon_class' => 'fa fa-foursquare',      'base_url' => 'foursquare.com' ),
		'github'        => array( 'name' => 'Github',           'icon_class' => 'fa fa-github',          'base_url' => 'github.com' ),
		'gittip'        => array( 'name' => 'GitTip',           'icon_class' => 'fa fa-gittip',          'base_url' => 'gittip.com' ),
		'instagram'     => array( 'name' => 'Instagram',        'icon_class' => 'fa fa-instagram',       'base_url' => 'instagr.am' ),
		'instagram'     => array( 'name' => 'Instagram',        'icon_class' => 'fa fa-instagram',       'base_url' => 'instagram.com' ),
		'linkedin'      => array( 'name' => 'LinkedIn',         'icon_class' => 'fa fa-linkedin',        'base_url' => 'linkedin.com' ),
		'lastfm'        => array( 'name' => 'Last.fm',          'icon_class' => 'fa fa-lastfm',          'base_url' => 'last.fm' ), // New
		'medium'        => array( 'name' => 'Medium',           'icon_class' => 'fa fa-medium',          'base_url' => 'medium.com' ),
		'envelope'      => array( 'name' => 'Email',            'icon_class' => 'fa fa-envelope',        'base_url' => 'mailto:' ),
		'pinterest'     => array( 'name' => 'Pinterest',        'icon_class' => 'fa fa-pinterest',       'base_url' => 'pinterest.com' ),
		'google-plus'   => array( 'name' => 'Google+',          'icon_class' => 'fa fa-google-plus',     'base_url' => 'plus.google.com' ),
		'renren'        => array( 'name' => 'RenRen',           'icon_class' => 'fa fa-renren',          'base_url' => 'renren.com' ),
		'slack'         => array( 'name' => 'Slack',            'icon_class' => 'fa fa-slack',           'base_url' => 'slack.com' ),
		'spotify'       => array( 'name' => 'Spotify',          'icon_class' => 'fa fa-spotify',         'base_url' => 'spotify.com' ), // New
		'soundcloud'    => array( 'name' => 'Soundcloud',       'icon_class' => 'fa fa-soundcloud',      'base_url' => 'soundcloud.com' ),
		'trello'        => array( 'name' => 'Trello',           'icon_class' => 'fa fa-trello',          'base_url' => 'trello.com' ),
		'tumblr'        => array( 'name' => 'Tumblr',           'icon_class' => 'fa fa-tumblr',          'base_url' => 'tumblr.com' ),
		'twitter'       => array( 'name' => 'Twitter',          'icon_class' => 'fa fa-twitter',         'base_url' => 'twitter.com' ),
		'vk'            => array( 'name' => 'VK',               'icon_class' => 'fa fa-vk',              'base_url' => 'vk.com' ),
		'vine'          => array( 'name' => 'Vine',             'icon_class' => 'fa fa-vine',            'base_url' => 'vine.co' ),
		'vimeo'         => array( 'name' => 'Vimeo',            'icon_class' => 'fa fa-vimeo',           'base_url' => 'vimeo.com' ),
		'weibo'         => array( 'name' => 'Weibo',            'icon_class' => 'fa fa-weibo',           'base_url' => 'weibo.com' ),
		'xing'          => array( 'name' => 'Xing',             'icon_class' => 'fa fa-xing',            'base_url' => 'xing.com' ),
		'youtube'       => array( 'name' => 'YouTube',          'icon_class' => 'fa fa-youtube',         'base_url' => 'youtube.com' ),
	);


	// Reformat the array for the various usage types.

	if ( 'config' == $type ) {

		/**
		 * Format array for use with Controls Config.
		 */

		$return_collection_first = array();
		$return_collection_last = array();

		foreach ( $networks as $key => $value ) {

			$return_item = array(
				'type'   => 'layers-text',
				'label'  => '<i class="' . $value['icon_class'] . '"></i>&nbsp; ' . __( $value['name'], 'layers-pro' ),
				'default' => '',
				'placeholder' => 'http://' . $value['base_url'],
			);

			if ( get_theme_mod( "layers-social-network-{$key}" ) )
				$return_collection_first[ "social-network-{$key}" ] = $return_item;
			else
				$return_collection_last[ "social-network-{$key}" ] = $return_item;
		}

		$return_collection = $return_collection_first + $return_collection_last;
	}
	else if ( 'select-icons' == $type ) {

		/**
		 * Format array for use with forms Select-Icons.
		 */

		$return_collection_first = array();
		$return_collection_last = array();

		foreach ( $networks as $key => $value ) {

			$return_item = array(
				'name'   => $value['name'],
				'class' => 'fa-2x ' . $value['icon_class'],
				'data' => array(
					'tip' => $value['name'],
				),
			);

			if ( get_theme_mod( "layers-social-network-{$key}" ) )
				$return_collection_first[$key] = $return_item;
			else
				$return_collection_last[$key] = $return_item;
		}

		$return_collection = $return_collection_first + $return_collection_last;
	}
	elseif( 'select' == $type ) {

		/**
		 * Format array for use with forms Select.
		 */

		foreach ( $networks as $key => $value ) {
			$return_collection[ $key ] = $value['name'];
		}
	}
	elseif( 'native-with-values' == $type ) {

		/**
		 * Format array for use with forms Select.
		 */

		foreach ( $networks as $key => $value ) {
			$value['value'] = get_theme_mod( "layers-social-network-{$key}" );
			$return_collection[ $key ] = $value;
		}
	}
	else {

		/**
		 * Format array natively.
		 */

		$return_collection = $networks;
	}

	return $return_collection;
}

/**
 * Find social links in top-level menu items, add icon HTML
 */
add_filter( 'wp_nav_menu_objects', 'layers_pro_convert_social_nav_menu_items', 20, 2 );

function layers_pro_convert_social_nav_menu_items( $sorted_menu_items, $args ){

	$networks = layers_pro_get_social_networks();

	foreach( $sorted_menu_items as &$item ) {

		// Skip submenu items.
		if ( 0 != $item->menu_item_parent ) {
			continue;
		}

		// Dynamically apply the iconclass.
		foreach( $networks as $network_key => $network_values ) {
			if ( false !== strpos( strtolower( $item->url ), strtolower( $network_values['base_url'] ) ) ) {
				$icon_class = $network_values['icon_class'];
				$item->title = "<i class='{$icon_class}'></i>";
				// $item->title = "<span class='{$icon_class}'></span><span class='fa-hidden'>{$item->title}</span>";
			}
		}
	}

	return $sorted_menu_items;
}

// Render layers customizer menu
// add_action( 'customize_controls_print_footer_scripts' , 'layers_pro_render_menu_icons_interface' ); // Customizer
add_action( 'print_media_templates' , 'layers_pro_render_menu_icons_interface' ); // Admin

function layers_pro_render_menu_icons_interface() {

	$form_elements = new Layers_Form_Elements(); ?>
	<div class="layer-pro-menu-icons-interface">

		<label>
			<?php _e( 'Social Icons', 'layers-pro' ); ?>
		</label>

		<div class="layers-visuals-item layers-icon-group">
			<?php echo $form_elements->input(
				array(
					'type' => 'select-icons',
					'name' => '',
					'id' => '',
					'placeholder' => __( 'e.g. http://facebook.com/oboxthemes', 'layers-pro' ),
					'value' => '',
					'options' => layers_pro_get_social_networks( 'select-icons' ),
				)
			); ?>
		</div>

		<span class="layers-form-item-description">
			<?php _e( 'Your Social Network links are set in Customizer > Site Settings > Social Networks.', 'layers-pro' ); ?>
		</span>

	</div>
	<?php
}



/**
 * New!
 */

function layers_pro_get_block_styling_settings( $prefix, $args = array() ) {
	
	if ( ! function_exists( 'layers_get_theme_mod' ) ) return;

		
	/**
	 * Set defaults.
	 */
		
	$defaults = array(
		'options' => array( 'all' ),
	);
	$args = wp_parse_args( $args, $defaults );
	
	
	// Set Defaults.
	$settings = array(
		'background-style' => '',
		'background-gradient-start-color' => '',
		'background-gradient-end-color' => '',
		'background-gradient-direction' => '',
		'background-color' => '',
		'background-image' => '',
		'background-repeat' => '',
		'background-position' => '',
		'background-parallax' => '',
		'background-size' => '',
		'border-top' => '',
		'border-right' => '',
		'border-bottom' => '',
		'border-left' => '',
		'border-style-width' => '',
		'border-style-style' => '',
		'border-style-radius' => '',
		'border-color' => '',
		'margin-top' => '',
		'margin-right' => '',
		'margin-bottom' => '',
		'margin-left' => '',
		'padding-top' => '',
		'padding-right' => '',
		'padding-bottom' => '',
		'padding-left' => '',
		'shadow-style-x' => '',
		'shadow-style-y' => '',
		'shadow-style-blur' => '',
		'shadow-style-spread' => '',
		'shadow-style-opacity' => '',
		'shadow-color' => '',
		'font-color' => '',
		'font-size' => '',
		'line-height' => '',
		'letter-spacing' => '',
		'font-weight' => '',
		'font-style-italic' => '',
		'font-style-underline' => '',
		'font-style-strike-through' => '',
		'font-style-text-transform' => '',
		'text-color' => '',
		'text-shadow' => '',
		'text-transform' => '',
	);
	
	
	/**
	 * Background.
	 */
	if (
			in_array( 'background', $args['options'] ) ||
			in_array( 'all', $args['options'] )
		) {
		
		// Background.
		$settings['background-style'] = layers_get_theme_mod( "{$prefix}-background-style" );
		$settings['background-gradient-start-color'] = layers_get_theme_mod( "{$prefix}-background-gradient-start-color" );
		$settings['background-gradient-end-color'] = layers_get_theme_mod( "{$prefix}-background-gradient-end-color" );
		$settings['background-gradient-direction'] = layers_get_theme_mod( "{$prefix}-background-gradient-direction" );
		$settings['background-color'] = layers_get_theme_mod( "{$prefix}-background-color" );
		
		// Background-image.
		$settings['background-image'] = layers_get_theme_mod( "{$prefix}-background-image" );
		$settings['background-repeat'] = layers_get_theme_mod( "{$prefix}-background-repeat" );
		$settings['background-position'] = layers_get_theme_mod( "{$prefix}-background-position" );
		$settings['background-parallax'] = layers_get_theme_mod( "{$prefix}-background-parallax" );
		$settings['background-size'] = layers_get_theme_mod( "{$prefix}-background-size" );
	}
	
	/**
	 * Border.
	 */
	if (
			in_array( 'border', $args['options'] ) ||
			in_array( 'all', $args['options'] )
		) {
		
		// Border.
		$settings['border-top'] = layers_get_theme_mod( "{$prefix}-borders-active-top" );
		$settings['border-right'] = layers_get_theme_mod( "{$prefix}-borders-active-right" );
		$settings['border-bottom'] = layers_get_theme_mod( "{$prefix}-borders-active-bottom" );
		$settings['border-left'] = layers_get_theme_mod( "{$prefix}-borders-active-left" );
		$settings['border-style-width'] = layers_get_theme_mod( "{$prefix}-border-style-width" );
		$settings['border-style-style'] = layers_get_theme_mod( "{$prefix}-border-style-style" );
		$settings['border-style-radius'] = layers_get_theme_mod( "{$prefix}-border-style-radius" );
		$settings['border-color'] = layers_get_theme_mod( "{$prefix}-border-color" );
	}
	
	/**
	 * Margin.
	 */
	if (
			in_array( 'margin', $args['options'] ) ||
			in_array( 'all', $args['options'] )
		) {
		
		// Margin.
		$settings['margin-top'] = layers_get_theme_mod( "{$prefix}-margin-top" );
		$settings['margin-right'] = layers_get_theme_mod( "{$prefix}-margin-right" );
		$settings['margin-bottom'] = layers_get_theme_mod( "{$prefix}-margin-bottom" );
		$settings['margin-left'] = layers_get_theme_mod( "{$prefix}-margin-left" );
	}
	
	/**
	 * Padding.
	 */
	if (
			in_array( 'padding', $args['options'] ) ||
			in_array( 'all', $args['options'] )
		) {
		
		// Padding.
		$settings['padding-top'] = layers_get_theme_mod( "{$prefix}-padding-top" );
		$settings['padding-right'] = layers_get_theme_mod( "{$prefix}-padding-right" );
		$settings['padding-bottom'] = layers_get_theme_mod( "{$prefix}-padding-bottom" );
		$settings['padding-left'] = layers_get_theme_mod( "{$prefix}-padding-left" );
	}
	
	/**
	 * Shadow.
	 */
	if (
			in_array( 'shadow', $args['options'] ) ||
			in_array( 'all', $args['options'] )
		) {
		
		// Shadow.
		$settings['shadow-style-x'] = layers_get_theme_mod( "{$prefix}-shadow-style-x" );
		$settings['shadow-style-y'] = layers_get_theme_mod( "{$prefix}-shadow-style-y" );
		$settings['shadow-style-blur'] = layers_get_theme_mod( "{$prefix}-shadow-style-blur" );
		$settings['shadow-style-spread'] = layers_get_theme_mod( "{$prefix}-shadow-style-spread" );
		$settings['shadow-style-opacity'] = layers_get_theme_mod( "{$prefix}-shadow-style-opacity" );
		$settings['shadow-color'] = layers_get_theme_mod( "{$prefix}-shadow-color" );
	}
	
	/**
	 * Font.
	 */
	if (
			in_array( 'font', $args['options'] ) ||
			in_array( 'all', $args['options'] )
		) {
		
		// Font.
		$settings['font-color'] = layers_get_theme_mod( "{$prefix}-font-color" );
		$settings['font-size'] = layers_get_theme_mod( "{$prefix}-font-size-size" );
		$settings['line-height'] = layers_get_theme_mod( "{$prefix}-font-size-line-height" );
		$settings['letter-spacing'] = layers_get_theme_mod( "{$prefix}-font-size-letter-spacing" );
		$settings['font-weight'] = layers_get_theme_mod( "{$prefix}-font-weight" );
		$settings['font-style-italic'] = layers_get_theme_mod( "{$prefix}-font-style-italic" );
		$settings['font-style-underline'] = layers_get_theme_mod( "{$prefix}-font-style-underline" );
		$settings['font-style-strike-through'] = layers_get_theme_mod( "{$prefix}-font-style-strike-through" );
		$settings['font-style-text-transform'] = layers_get_theme_mod( "{$prefix}-font-style-text-transform" );
		
		// Font (OLD).
		$settings['text-color'] = layers_get_theme_mod( "{$prefix}-text-color" );
		$settings['text-shadow'] = layers_get_theme_mod( "{$prefix}-text-shadow" );
		$settings['text-transform'] = layers_get_theme_mod( "{$prefix}-text-transform" );
	}

	return $settings;
}

function layers_pro_apply_block_styling( $settings, $selectors, $auto_hover = FALSE ) {
	
	if ( ! function_exists( 'layers_inline_styles' ) ) return;
	
	
	/**
	 * GENERATE CSS.
	 */
	
	$css = array();
	
	
	/**
	 * Background - Color.
	 */
	
	if ( 'transparent' == $settings["background-style"] ) {

		/**
		 * Transparent Background.
		 */

		$css['background-color'] = 'transparent';
	}
	else if ( 'gradient' == $settings["background-style"] ) {

		/**
		 * Gradient Background.
		 */

		if (
			'' != $settings["background-gradient-start-color"] &&
			'' != $settings["background-gradient-end-color"]
			) {

			$gradient_start_color = $settings["background-gradient-start-color"];
			$gradient_end_color   = $settings["background-gradient-end-color"];

			$gradient_start_color_hover = layers_too_light_then_dark( $gradient_start_color, 20 );
			$gradient_end_color_hover   = layers_too_light_then_dark( $gradient_end_color, 20 );

			$gradient_degrees = ( '' != $settings["background-gradient-direction"] ) ? $settings["background-gradient-direction"] . 'deg, ' : '';
			$css['background'] = "linear-gradient( $gradient_degrees $gradient_start_color, $gradient_end_color )";
		}
	}
	else if ( 'solid' == $settings["background-style"] ) {

		/**
		 * Solid Background.
		 */

		if ( '' != $settings["background-color"] ) {

			$css['background-color'] = $settings["background-color"];
		}
	}
	
	
	/**
	 * Background - Image.
	 */
	
	if ( '' != $settings["background-image"] ) {
		$image = wp_get_attachment_image_src( $settings["background-image"], 'full' );
		if ( isset( $image[0] ) ) {
			$css['background-image'] = "url('" . $image[0] ."')";
		}
	}
	if ( '' != $settings["background-repeat"] ){
		$css['background-repeat'] = $settings['background-repeat'];
	}
	if ( '' != $settings["background-position"] ){
		$css['background-position'] = $settings['background-position'];
	}
	if ( '' != $settings["background-size"] ){
		$css['background-size'] = 'cover';
	}
	if ( '' != $settings["background-parallax"] ){
		$css['background-attachment'] = 'fixed';
	}
	
	
	/**
	 * Border.
	 */
	
	// Prep: Border Width.
	if ( '' != $settings["border-style-width"] ) {
		
		if ( '' != $settings["border-top"] ) {
			$css['border-top-width'] = $settings["border-style-width"] . 'px';
		}
		if ( '' != $settings["border-right"] ) {
			$css['border-right-width'] = $settings["border-style-width"] . 'px';
		}
		if ( '' != $settings["border-bottom"] ) {
			$css['border-bottom-width'] = $settings["border-style-width"] . 'px';
		}
		if ( '' != $settings["border-left"] ) {
			$css['border-left-width'] = $settings["border-style-width"] . 'px';
		}
	}
	
	// Prep: Border Style.
	if ( '' != $settings["border-style-style"] ) {
		$css['border-style'] = $settings["border-style-style"];
	}

	// Prep: Border Radius.
	if ( FALSE !== $settings["border-style-radius"] && '' !== $settings["border-style-radius"] && 0 !== $settings["border-style-radius"] ) {
		$css['border-radius'] = $settings["border-style-radius"] . 'px';
	}
	
	// Prep: Border Color.
	if ( $settings["border-color"] ) {
		$css['border-color'] = $settings["border-color"];
	}
	
	
	/**
	 * Margin.
	 */
	
	$trbl = array( 'top', 'right', 'bottom', 'left' );
	foreach ( $trbl as $key ) {
		if ( '' != $settings["margin-{$key}"] ) {
			$css["margin-{$key}"] = $settings["margin-{$key}"] . 'px';
		}
	}
	
	
	/**
	 * Padding.
	 */
	
	$trbl = array( 'top', 'right', 'bottom', 'left' );
	foreach ( $trbl as $key ) {
		if ( '' != $settings["padding-{$key}"] ) {
			$css["padding-{$key}"] = $settings["padding-{$key}"] . 'px';
		}
	}
	
	
	/**
	 * Shadow.
	 */
	
	if (
			$settings["shadow-style-x"] ||
			$settings["shadow-style-y"] ||
			$settings["shadow-style-blur"] ||
			$settings["shadow-style-spread"] ||
			$settings["shadow-style-opacity"] ||
			$settings["shadow-color"]
		) {
		
		$shadow_x = ( '' != $settings["shadow-style-x"] ) ? $settings["shadow-style-x"] . 'px' : '3px' ;
		$shadow_y = ( '' != $settings["shadow-style-y"] ) ? $settings["shadow-style-y"] . 'px' : '3px' ;
		$shadow_blur = ( '' != $settings["shadow-style-blur"] ) ? $settings["shadow-style-blur"] . 'px' : '6px' ;
		$shadow_spread = ( '' != $settings["shadow-style-spread"] ) ? $settings["shadow-style-spread"] . 'px' : '' ;
		$shadow_color = ( '' != $settings["shadow-color"] ) ? $settings["shadow-color"] : '#000000' ;
		if ( '' !== $settings["shadow-style-opacity"] ) {
			$shadow_color = 'rgba(' . implode( ', ' , layers_hex2rgb( $shadow_color ) ) . ', ' . $settings["shadow-style-opacity"] . '); ';
		}
		
		$css["box-shadow"] = "{$shadow_x} {$shadow_y} {$shadow_blur} {$shadow_spread} {$shadow_color}";
	}
	
	
	/**
	 * Font.
	 */
	
	// Prep: Color.
	if ( $settings["font-color"] ) {
		$css["color"] = $settings["font-color"];
	}
	
	// Prep: Font Size.
	if ( $settings["font-size"] ) {
		$css["font-size"] = $settings["font-size"] . 'px';
	}
	
	// Prep: Line Height.
	if ( $settings["line-height"] ) {
		$css["line-height"] = $settings["line-height"] . 'px';
	}
	
	// Prep: Letter Spacing.
	if ( $settings["letter-spacing"] ) {
		$css["letter-spacing"] = $settings["letter-spacing"] . 'px';
	}
	
	// Prep: Font Weight.
	if ( $settings["font-weight"] ) {
		
		if ( 'light' == $settings["font-weight"] ) {
			$css["font-weight"] = '100';
		}
		else if ( 'normal' == $settings["font-weight"] ) {
			$css["font-weight"] = 'normal';
		}
		else if ( 'bold' == $settings["font-weight"] ) {
			$css["font-weight"] = '900';
		}
	}
	
	// Prep: Font Style.
	if ( $settings["font-style-italic"] ) {
		$css["font-style"] = 'italic';
	}
	if ( $settings["font-style-underline"] ) {
		$css["text-decoration"] = 'underline';
	}
	if ( $settings["font-style-strike-through"] ) {
		$css["text-decoration"] = 'line-through';
	}
	if ( $settings["font-style-text-transform"] ) {
		$css["text-transform"] = 'uppercase';
	}
	
	
	/**
	 * Font (OLD).
	 */
	
	// Prep: Text Color.
	if ( $settings["text-color"] ) {
		$css['color'] = $settings["text-color"];
	}

	// Prep: Text Shadow.
	if ( $settings["text-shadow"] ) {
		if ( 'top' == $settings["text-shadow"] ) $css['text-shadow'] = '0 -1px rgba(0,0,0,0.3)';
		if ( 'bottom' == $settings["text-shadow"] ) $css['text-shadow'] = '0 1px rgba(0,0,0,0.3)';
	}

	// Prep: Text Transform.
	if ( $settings["text-transform"] ) {
		$css['text-transform'] = $settings["text-transform"];
	}
	
	
	/**
	 * GENERATE STYLE STRING
	 *
	 * e.g. $selectors { background: #333333; }
	 */
	
	$styles = '';

	/**
	 * Apply Main Styles
	 */
	
	$styles .= layers_inline_styles( implode( ', ', $selectors ), array( 'css' => $css ) );

	/**
	 * Apply Main Styles :before & :after.
	 */
	
	$before_and_after_css = array();
	if ( isset( $css['color'] ) ) $before_and_after_css['color'] = $css['color'];
	if ( isset( $css['text-shadow'] ) ) $before_and_after_css['text-shadow'] = $css['text-shadow'];
	$styles .= layers_inline_styles( implode( ':before, ', $selectors ) . ':before ' . implode( ':after, ', $selectors ) . ':after', array( 'css' => $before_and_after_css ) );
	
	/**
	 * Apply Hover Styles
	 */
	
	if ( $auto_hover ) {
		
		/**
		 * Optionally create hover styles dynamically.
		 */
		
		$hover_css = array();

		// Background Color.
		if ( isset( $css['background'] ) ) {

			if ( 0 === strpos( $css['background'], '#' ) ) {

				// Background is a #hex color - so set background to a lighter shade of that color.
				// $hover_css['background'] = layers_too_light_then_dark( $css['background'] );
				$hover_css['background'] = layers_adjust_brightness( $css['background'], 35, true );
			}
		}

		// Text Color.
		if ( isset( $css['border-color'] ) ) {

			if (
					0 === strpos( $css['border-color'], '#' ) &&
					isset( $css['border-width'] ) && 0 !== ( (int) $css['border-width'] )
				) {
				// $hover_css['border-color'] = layers_too_light_then_dark( $css['border-color'] );
				$hover_css['border-color'] = layers_adjust_brightness( $css['border-color'], -55, true );
			}
		}

		// Text Color.
		if ( isset( $css['color'] ) && ! isset( $hover_css['color'] ) ) {
			/*
			// $hover_css['color'] = layers_too_light_then_dark( $css['color'] );
			$hover_css['color'] = layers_adjust_brightness( $css['color'], 35, true );
			*/
		}
		
		if ( ! empty( $hover_css ) ) {
			
			/**
			 * Apply Hover Styles.
			 */
			
			$styles .= layers_inline_styles( implode( ':hover, ', $selectors ) . ':hover', array( 'css' => $hover_css ) );

			/**
			 * Apply Hover Styles :before & :after.
			 */
			
			$before_and_after_css = array();
			if ( isset( $hover_css['color'] ) ) $before_and_after_css['color'] = $hover_css['color'];
			if ( isset( $hover_css['text-shadow'] ) ) $before_and_after_css['text-shadow'] = $hover_css['text-shadow'];
			$styles .= layers_inline_styles( implode( ':before, ', $selectors ) . ':before ' . implode( ':after, ', $selectors ) . ':after', array( 'css' => $before_and_after_css ) );
		}
	}

	// Debugging:
	global $wp_customize;
	if ( $wp_customize && ( ( bool ) layers_get_theme_mod( 'dev-switch-button-css-testing' ) ) ) {

		echo '<pre style="font-size:11px;">';

		if ( 0 === strpos( $selectors[0], '#' ) )
			print_r( $selectors );
		else
			echo "GLOBAL\n";

		echo "button -----------------------\n";
		if ( empty( $css ) )
			echo '';
		else
			foreach ( $css as $key => $value )
				echo "$key: $value\n";

		echo "button:hover -----------------\n";
		if ( empty( $hover_css ) )
			echo '';
		else
			foreach ( $hover_css as $key => $value )
				echo "$key: $value\n";

		echo '</pre>';
	}

	return $styles;
}

function layers_pro_replace_customizer_css( $search, $replace ) {
	
	// Only do this if we getting a customizer partial.
	if ( isset( $_POST['partials'] ) ) {
		?>
		<script type="text/javascript">
			layers_replace_customizer_css( '<?php echo addslashes( $search ); ?>', '<?php echo rawurlencode( $replace ); ?>' );
		</script>
		<?php
	}
}

function layers_pro_get_controls( $prefix, $args = array() ) {
	
	/**
	 * Set defaults.
	 */
	
	$defaults = array(
		'options'          => array(),
		'type'             => 'controls',
		'accordion'        => FALSE,
		'hover'            => FALSE,
		'partial'          => FALSE,
		'background-image' => FALSE,
	);
	$args = wp_parse_args( $args, $defaults );
	
	/**
	 * Get Controls.
	 */
	
	$controls = array(); // Collect Controls.
	$settings = array(); // Collect Settings.
	
	foreach ( $args['options'] as $option ) {
		
		/**
		 * Background.
		 */
		
		if ( 'background' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-background-accordion-start"] = array(
					'label' => ( $args['background-image'] ? __( 'Background Color', 'layers-pro' ) : __( 'Background', 'layers-pro' ) ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
			
			$controls["{$prefix}-background-style"] = array(
				'type'  => 'layers-select',
				'label' => '',
				'class' => 'group',
				'choices' => array(
					'' => '-- Choose --',
					'solid' => __( 'Solid', 'layers-pro' ),
					'transparent' => __( 'Transparent', 'layers-pro' ),
					'gradient' => __( 'Gradient', 'layers-pro' ),
				),
				'default' => 'solid',
			);
			$controls["{$prefix}-background-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Background Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'solid',
				),
			);
			$controls["{$prefix}-background-gradient-start-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Start Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'gradient',
				),
			);
			$controls["{$prefix}-background-gradient-end-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'End Color', 'layers-pro' ),
				'class' => 'group',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'gradient',
				),
			);
			$controls["{$prefix}-background-gradient-direction"] = array(
				'type' => 'layers-number',
				'label' => __( 'Gradient Angle', 'layers-pro' ),
				'class' => 'group',
				'default' => 0,
				'min' => '0',
				'max' => '360',
				'step' => '1',
				'linked'    => array(
						'show-if-selector' => "#layers-{$prefix}-background-style",
						'show-if-value' => 'gradient',
				),
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-background-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
			
			/**
			 * If background-image.
			 */
			
			if ( $args['background-image'] ) {
				
				if ( $args['accordion'] ) {
					$controls["{$prefix}-background-image-accordion-start"] = array(
						'label' => ( $args['background-image'] ? __( 'Background Image', 'layers-pro' ) : __( 'Background', 'layers-pro' ) ),
						'type' => 'layers-accordion-start',
						'class' => 'group',
					);
				}
				
				$controls["{$prefix}-background-image"] = array(
					'label' => __( 'Background Image', 'layers-pro' ),
					'type' => 'layers-select-images',
					'class' => 'group',
				);
				$controls["{$prefix}-background-repeat"] = array(
					'label' => __( 'Repeat', 'layers-pro' ),
					'type' => 'layers-select',
					'class' => 'group',
					'default' => 'no-repeat',
					'choices' => array(
						'no-repeat' => __( 'No Repeat', 'layers-pro' ),
						'repeat' => __( 'Repeat', 'layers-pro' ),
						'repeat-x' => __( 'Repeat Horizontal', 'layers-pro' ),
						'repeat-y' => __( 'Repeat Vertical', 'layers-pro' )
					),
					'linked' => array(
						'show-if-selector' => "#layers-{$prefix}-background-image",
						'show-if-value' => '',
						'show-if-operator' => '!==',
					),
				);
				$controls["{$prefix}-background-position"] = array(
					'label' => __( 'Position', 'layers-pro' ),
					'type' => 'layers-select',
					'class' => 'group',
					'default' => 'center',
					'choices' => array(
						'center' => __( 'Center', 'layers-pro' ),
						'top' => __( 'Top', 'layers-pro' ),
						'bottom' => __( 'Bottom', 'layers-pro' ),
						'left' => __( 'Left', 'layers-pro' ),
						'right' => __( 'Right', 'layers-pro' )
					),
					'linked' => array(
						'show-if-selector' => "#layers-{$prefix}-background-image",
						'show-if-value' => '',
						'show-if-operator' => '!==',
					),
				);
				$controls["{$prefix}-background-parallax"] = array(
					'label' => __( 'Parallax', 'layers-pro' ),
					'type' => 'layers-checkbox',
					'default' => FALSE,
					'class' => 'group',
					'linked' => array(
						'show-if-selector' => "#layers-{$prefix}-background-image",
						'show-if-value' => '',
						'show-if-operator' => '!==',
					),
				);
				$controls["{$prefix}-background-size"] = array(
					'type'   => 'layers-checkbox',
					'label'  => __( 'Stretch', 'layers-pro' ),
					'default' => TRUE,
					'class' => 'group',
					'linked' => array(
						'show-if-selector' => "#layers-{$prefix}-background-image",
						'show-if-value' => '',
						'show-if-operator' => '!==',
					),
				);
				
				if ( $args['accordion'] ) {
					$controls["{$prefix}-background-image-accordion-end"] = array(
						'type' => 'layers-accordion-end',
						'class' => 'group',
					);
				}
			}
		}
		
		
		/**
		 * Font.
		 */
		
		if ( 'font' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-font-accordion-start"] = array(
					'label' => __( 'Font Style', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group accordion-open-NOT',
				);
			}
				
			$controls["{$prefix}-font-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Text Color', 'layers-pro' ),
				'class' => 'group',
			);
			
			if ( ! $args['hover'] ) {
				
				$controls["{$prefix}-font-size"] = array(
					'type' => 'layers-inline-numbers-fields',
					'label' => '',
					'class' => 'group',
					'input_class' => 'inline-fields-flush',
					'fields' => array(
						'size' => 'Size',
						'line-height' => 'Line Height',
						'letter-spacing' => 'Spacing',
					),
				);
				
				$controls["{$prefix}-font-weight"] = array(
					'type' => 'layers-select-icons',
					// 'multi_select' => TRUE,
					'allow_inactive' => TRUE,
					'label' => '',
					'choices' => array(
						'light' => array(
							'name' => __( 'Light', 'layers-pro' ),
							'class' => 'icon-font-weight-light',
							'data' => '',
						),
						'normal' => array(
							'name' => __( 'Normal', 'layers-pro' ),
							'class' => 'icon-font-weight-normal',
							'data' => '',
						),
						'bold' => array(
							'name' => __( 'Bold', 'layers-pro' ),
							'class' => 'icon-font-weight-bold',
							'data' => '',
						),
					),
					'class' => 'group layers-icon-group-inline layers-icon-group-inline-outline',
					// 'class' => 'group layers-icon-group-inline',
					// 'class' => 'group',
				);
			}
			
			$controls["{$prefix}-font-style"] = array(
				'type' => 'layers-select-icons',
				'multi_select' => TRUE,
				'label' => '',
				// 'default' => 'underline',
				'choices' => array(
					'italic' => array(
						'name' => __( 'Italic', 'layers-pro' ),
						'class' => 'icon-font-italic',
						'data' => '',
					),
					'underline' => array(
						'name' => __( 'Underline', 'layers-pro' ),
						'class' => 'icon-font-underline',
						'data' => '',
					),
					'strike-through' => array(
						'name' => __( 'Strikethrough', 'layers-pro' ),
						'class' => 'icon-font-strike-through',
						'data' => '',
					),
					'text-transform' => array(
						'name' => __( 'Uppercase', 'layers-pro' ),
						'class' => 'icon-font-text-transform',
						'data' => '',
					),
				),
				'class' => 'group layers-icon-group-inline layers-icon-group-inline-outline',
				// 'class' => 'group layers-icon-group-inline',
				// 'class' => 'group',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-font-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Border.
		 */
		
		if ( 'border' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-border-accordion-start"] = array(
					'label' => __( 'Borders', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
			
			if ( ! $args['hover'] ) {
				
				$controls["{$prefix}-borders-active"] = array(
					'type' => 'layers-select-icons',
					'multi_select' => TRUE,
					'label' => '',
					'choices' => array(
						'top' => array(
							'name' => __( 'Top', 'layers-pro' ),
							'class' => 'icon-border-top',
							'data' => '',
						),
						'right' => array(
							'name' => __( 'Right', 'layers-pro' ),
							'class' => 'icon-border-right',
							'data' => '',
						),
						'bottom' => array(
							'name' => __( 'Bottom', 'layers-pro' ),
							'class' => 'icon-border-bottom',
							'data' => '',
						),
						'left' => array(
							'name' => __( 'Left', 'layers-pro' ),
							'class' => 'icon-border-left',
							'data' => '',
						),
					),
					'class' => 'group layers-icon-group-inline layers-icon-group-inline-outline',
					// 'class' => 'group layers-icon-group-inline',
					// 'class' => 'group',
				);
			
				$controls["{$prefix}-border-style"] = array(
					'type' => 'layers-border-style-fields',
					'label' => '',
					'class' => 'group',
				);
			}
			
			$controls["{$prefix}-border-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Border Color', 'layers-pro' ),
				'class' => 'group',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-border-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Margin.
		 */
		
		if ( 'margin' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-margin-accordion-start"] = array(
					'label' => __( 'Margin', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
				
			$controls["{$prefix}-margin"] = array(
				'type' => 'layers-inline-numbers-fields',
				'label' => '',
				'class' => 'group',
				'input_class' => 'inline-fields-flush',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-margin-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Padding.
		 */
		
		if ( 'padding' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-padding-accordion-start"] = array(
					'label' => __( 'Padding', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
				
			$controls["{$prefix}-padding"] = array(
				'type' => 'layers-inline-numbers-fields',
				'label' => '',
				'class' => 'group',
				'input_class' => 'inline-fields-flush',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-padding-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
		
		/**
		 * Shadow.
		 */
		
		if ( 'shadow' == $option ) {
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-shadow-accordion-start"] = array(
					'label' => __( 'Shadow', 'layers-pro' ),
					'type' => 'layers-accordion-start',
					'class' => 'group',
				);
			}
				
			$controls["{$prefix}-shadow-style"] = array(
				'type' => 'layers-inline-numbers-fields',
				'label' => '',
				'class' => 'group',
				'input_class' => 'inline-fields-flush',
				'fields' => array(
					'x' => 'X',
					'y' => 'Y',
					'blur' => 'Blur',
					'spread' => 'Spread',
					'opacity' => 'Opacity',
				),
			);
			
			$controls["{$prefix}-shadow-color"] = array(
				'type' => 'layers-color',
				'label' => __( 'Shadow Color', 'layers-pro' ),
				'class' => 'group',
			);
			
			if ( $args['accordion'] ) {
				$controls["{$prefix}-shadow-accordion-end"] = array(
					'type' => 'layers-accordion-end',
					'class' => 'group',
				);
			}
		}
		
	}
	
	
	/**
	 * Set partial key.
	 */
	
	if ( $args['partial'] ) {
		$controls = layers_set_partial_keys( $args['partial'], $controls );
	}
	
	
	return $controls;
}

/**
 * Get the Layers Pro HTML element.
 *
 * @return   string   Pro Badge HTML.
 */
function layers_get_controls_pro_badge() {
	
	return ' <span class="layers-control-title-marker" title="Control from Layers Pro">PRO</span>';
}
