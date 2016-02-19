<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Icon implements \RMLcustomizer\Core\Contents\Basic_Content
{
	private $icon;

	public function __construct() {

		$this->icon = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
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

	public function default_value() {
		return '';
	}

	public function option_field() {
		return array(
			'slug' => __CLASS__,
			'name' => 'Add icon',
			'desc' => 'Add icon before the link',
			'field_type' => 'text',
		);
	}

	public function get( $html ) {
		return sprintf( '<i class="%s">%s</i>', $this->icon, $html );
	}
}
