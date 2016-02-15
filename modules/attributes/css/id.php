<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *
 */
class Id implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{

	const NAME = 'id';

	public function __construct() {
	}

	public function identifier() {
		return static::NAME;
	}

	public function by_default() {
	}

	public function active() {
		return false;
	}

	public function get() {
		return 'plg-id-test';
	}

	public function merge( $value ) {
		return $value . 'plg-id-test';
	}
}
