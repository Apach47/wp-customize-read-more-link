<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *
 */
class Style implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'style';
	private $style;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->style = $setting['value'];
	}

	public function identifier() {
		return static::NAME;
	}

	public function by_default() {
		return array(
			'value' => '',
		);
	}

	public function active() {
		return empty( $this->style ) ? false : true;
	}

	public function get() {
		return $this->style;
	}

	public function merge( $value ) {
		return $this->style. ',' . $value;
	}
}
