<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Icon implements \RMLcustomizer\Core\Contents\Basic_Content
{
	private $icon;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->icon = $setting['value'];
	}

	public function active() {
		return empty( $this->icon ) ? false : true;
	}

	public function enter() {
		return false;
	}

	public function next() {
		return new Wrap();
	}

	public function by_default() {
		return array(
			'value' => '',
		);
	}

	public function get( $html ) {
		return sprintf( '<i class="%s">%s</i>', $this->icon, $html );
	}
}
