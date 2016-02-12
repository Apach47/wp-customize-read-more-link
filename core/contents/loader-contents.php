<?php

namespace RMLcustomizer\Core\Contents;

/**
 *
 */
class Loader_Contents extends \RMLcustomizer\Core\Loader
{
	const PATH_TO_CONTENTS = __DIR__ . '/../../modules/contents/';
	const NAMESPACE_CONTENT = '\\RMLcustomizer\\Modules\\Contents\\';
	const BASIC_TYPE_CONTENTS = '\\RMLcustomizer\\Core\\Contents\\Basic_Content';

	public function __construct() {

		parent::__construct();
	}

	public function load() {

		if ( $this->search( realpath( static::PATH_TO_CONTENTS ) ) ) {
			// List all content modules
			$modules = $this->init(
				static::NAMESPACE_CONTENT,
				static::BASIC_TYPE_CONTENTS
			);

			// Modules in the correct sequence
			$chain = array();

			/**
			* The content modules implement pattern "Chain of responsibility"
			* First module must return "True" in the "enter" method
			*/
			foreach ( $modules as $item ) {
				if ( $item->enter() ) {
					$chain[] = $item;
					break;
				}
			}

			// Last module in the chain must return 'null' value
			while ( true ) {
				$last = count( $chain ) - 1;
				$next = $chain[ $last ]->next();

				// Load only enabled module
				while ( false === $next->active() ) {
					$next = $next->next();
				}

				// End the chain
				if ( is_null( $next ) ) {
					break;
				}

				// Exclude the duplication
				if ( false === in_array( $next, $chain ) ) {
					$chain[] = $next;
				}

				if ( $chain[0] == $next ) {
					// Detect is loop collision. Break out
					break;
				}

				// Looping protection
				if ( count( $chain ) === count( $modules ) ) {
					break;
				}
			}

			return $chain;
		}

		throw new Exception( "Content's list not loaded", 1 );
	}
}
