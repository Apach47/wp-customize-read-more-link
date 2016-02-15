<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *
 */
class Style implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{

	const NAME = 'style';

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
		return 'color: green';
	}

	public function merge( $value ) {
		return $value;
	}
}
