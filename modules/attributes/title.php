<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Title implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'title';
	private $title;

	public function __construct() {
	}

	public function identifier() {
		return static::NAME;
	}

	public function active() {
		return true;
	}

	/**
	 * Setting field in the option page with admin panel
	 *
	 * @return array
	 */
	public function view() {
		return array(
			'type' => 'text',
			'setting-field' => __CLASS__,
			'validation' => 'absint',
		);
	}

	public function get() {
		return 'Adding title in the plugin';
	}

	public function merge( $value ) {
		return $value . '::custom sufix title';
	}
}
