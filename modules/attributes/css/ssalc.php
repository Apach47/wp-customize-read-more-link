<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *	Read "Ssalc" as "Class", becouse keyword "class" is exist in PHP.
 * Yes, it is crutch. May be you know better way?
 */
class Ssalc implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'class';
	private $class;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->class = $setting['value'];
	}

	public function identifier() {
		return static::NAME;
	}

	public function by_default() {
		return array(
			'value' => 'rml-plugin',
		);
	}

	public function active() {
		return empty( $this->class ) ? false : true;
	}

	public function get() {
		return $this->class;
	}

	public function merge( $value ) {
		return $this->class . ' ' . $value;
	}
}
