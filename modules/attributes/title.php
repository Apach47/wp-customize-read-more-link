<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Title implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'title';

	public function __construct() {
	}

	public function identifier() {
		return static::NAME;
	}

	public function active() {
		return true;
	}

	public function get() {
		return 'Adding title in the plugin';
	}

	public function merge( $value ) {
		return $value . '::custom sufix title';
	}
}
