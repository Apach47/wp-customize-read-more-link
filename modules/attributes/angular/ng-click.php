<?php

namespace RMLcustomizer\Modules\Attributes\Angular;

/**
 *
 */
class Ng_Click implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'ng-click';

	public function __construct() {
	}

	public function identifier() {
		return static::NAME;
	}

	public function active() {
		return false;
	}

	public function get() {
		return 'wp-now()';
	}

	public function merge( $value ) {
		return $value;
	}
}
