<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *	Read "Ssalc" as "Class", becouse keyword "class" is exist in PHP.
 * Yes, it is crutch. May be you know better way?
 */
class Ssalc implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'class';

	public function __construct() {
	}

	public function identifier() {
		return static::NAME;
	}

	public function by_default() {
	}

	public function active() {
		return true;
	}

	public function get() {
		return 'new value';
	}

	public function merge( $value ) {
		return $value . 'new value';
	}
}
