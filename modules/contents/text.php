<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Text implements \RMLcustomizer\Core\Contents\Basic_Content
{
	private $text;

	public function __construct() {

		$this->text = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
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

	public function default_value() {
		return '';
	}

	public function option_field() {
		return array(
			'slug' => __CLASS__,
			'name' => 'Text link',
			'desc' => 'Setup custom text for the link',
			'field_type' => 'text',
		);
	}

	public function get( $text ) {
		return $this->text;
	}
}
