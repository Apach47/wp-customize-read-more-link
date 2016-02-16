<?php

namespace RMLcustomizer\Modules\Attributes\Angular;

/**
 *
 */
class Ng_Click implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'ng-click';
	private $ng_click;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->ng_click = $setting['value'];
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
		return empty( $this->ng_click ) ? false : true;
	}

	public function get() {
		return $this->ng_click;
	}

	public function merge( $value ) {
		// Angular ng-click doesn't accept more than one thing
		return $this->get();
	}
}
