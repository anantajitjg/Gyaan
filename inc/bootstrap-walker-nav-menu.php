<?php
/**
 * Bootstrap_Walker_Nav_Menu class
 * Description: Custom Walker class for Navigation Menu for Bootstrap
 * @package gyaan
 * @since 1.0.0
 */

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default Bootstrap class dropdown-menu with custom helper classes
		$classes = array( 'sub-menu', 'dropdown-menu' );
		if( $depth >= 1 ) {
			$classes[] = 'high_depth';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		// Bootstrap Specific
		$output .= "{$n}{$indent}<div$class_names>{$n}";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Bootstrap Specific
		$output .= "$indent</div>{$n}";
	}

	/**
	 * Starts the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		// Bootstrap Specific
		$classes[] = 'nav-item';
		$classes[] = ( $item->current || $item->current_item_ancestor ) ? 'active' : '';
		$classes[] = ( $args->walker->has_children ) ? 'dropdown' : 'no_dropdown';

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// Bootstrap Specific
		if( $depth == 0 ) {
			$output .= $indent . '<li' . $id . $class_names .'>';
		} else {
			$output .= $indent . '<div class="dropdown">';
		}

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		// Bootstrap Specific
		$link_class = 'nav-link';
		if( $args->walker->has_children ) {
			$link_class .= ' dropdown-toggle';
			$atts['data-toggle'] = 'dropdown';
			$atts['role'] = 'button';
			$atts['aria-expanded'] = 'false';
		}
		if( ( ! $args->walker->has_children ) && $depth >= 1 ) {
			$link_class = 'dropdown-item';
		}
		if( ( $item->current || $item->current_item_ancestor ) && $depth >= 1 ) {
			$link_class .= ' active';
		}
		$atts['class'] = $link_class;

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;

		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Page data object. Not used.
	 * @param int      $depth  Depth of page. Not Used.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}

		// Bootstrap Specific
		if( $depth == 0 ) {
			$output .= "</li>{$n}";
		} else {
			$output .= "</div>{$n}";
		}
	}

} // Bootstrap_Walker_Nav_Menu