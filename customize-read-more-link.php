<?php

/*
Plugin Name: Customize [Read more...] link
Plugin URI: https://github.com/Apach47/wp-customize-read-more-link
Description: Allow customization "[Read more...]" link with post and single page
Version: 0.0.2
Author: Kudryavtsev Maxim
Author URI: https://github.com/Apach47
License: GPL V3
 */

/**
 * PSR-4 Basic autoloader
 */

spl_autoload_register(function ( $class ) {

	// project-specific namespace prefix
	$prefix = 'RMLcustomizer\\';

	// base directory for the namespace prefix
	$base_dir = __DIR__ . DIRECTORY_SEPARATOR;

	// does the class use the namespace prefix?
	$len = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		// no, move to the next registered autoloader
		return;
	}

	// get the relative class name
	$relative_class = substr( $class, $len );

	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = strtolower( $base_dir . str_replace( array( '\\', '_' ), array( '/', '-' ), $relative_class ) . '.php' );

	// if the file exists, require it
	if ( file_exists( $file ) ) {
		require $file;
	}
});

/**
 * Composer dependencies
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Initialize the plugin
 */
\RMLcustomizer\Bootstrap::get_instance();
