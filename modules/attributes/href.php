<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Href implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'href';
	private $url;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->url = $setting['value'];
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
		return empty( $this->url ) ? false : true;
	}

	public function get() {
		return $this->url;
	}

	public function merge( $value ) {
		return $value . $this->url;
	}
}
