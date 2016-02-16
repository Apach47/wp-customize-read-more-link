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

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->title = $setting['value'];
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
		return empty( $this->title ) ? false : true;
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
		return $this->title;
	}

	public function merge( $value ) {
		return $value . $this->title;
	}
}
