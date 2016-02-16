<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Text implements \RMLcustomizer\Core\Contents\Basic_Content
{
	private $text;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->text = $setting['value'];
	}

	public function active() {
		return empty( $this->text ) ? false : true;
	}

	public function enter() {
		return true;
	}

	public function next() {
		return new Icon();
	}

	public function by_default() {
		return array(
			'value' => '',
		);
	}

	public function get( $text ) {
		return $this->text;
	}
}
