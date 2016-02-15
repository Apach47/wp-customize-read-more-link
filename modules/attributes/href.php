<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Href implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'href';

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
		return '#sub-plg-test';
	}

	public function merge( $value ) {
		return $value . '#sub-plg-test';
	}
}
