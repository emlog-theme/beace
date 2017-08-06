<?php 
/**
 * Display the classes for the body element.
 *
 * @since 5.3.1
 *
 * @param string|array $class One or more classes to add to the class list.
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}

function body_class( $class = '' , $keyword) {
	// Separates classes with a single space, collates classes for body element
	echo 'class="' . join( ' ', get_body_class( $class , $keyword) ) . '"';
}

/**
 * Retrieve the classes for the body element as an array.
 *
 * @since 5.3.1
 *
 * @param string|array $class One or more classes to add to the class list.
 * @return array Array of classes.
 */
function get_body_class( $class = '' , $keyword ) {
	$classes = array();
	
	if ( blog_tool_ishome() ){
		$classes[] = 'home';
		$classes[] = 'blog';
	}
	if ( $keyword ) {
		$classes[] = 'search';
		$classes[] = $keyword ? 'search-results' : 'search-no-results';
	}
	if ( ISLOGIN )
		$classes[] = 'logged-in';
	
	if ( ! empty( $class ) ) {
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	return array_unique( $classes );
}