<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Title implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'title';
	private $title;
	private $is_active;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->title = $setting['value'];
		$this->is_active = $setting['active'];
	}

	public function identifier() {
		return static::NAME;
	}

	public function by_default() {
		return array( 'value' => 'Title test new', 'active' => true );
	}

	public function active() {
		return empty( $this->is_active ) ? false : true;
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
