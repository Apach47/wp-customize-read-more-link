<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *
 */
class Id implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'id';
	private $id;

	// Because all css id in the page must unique
	private static $increment = 1;

	public function __construct() {

		$this->id = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );

		// Because I like odd number, e.g 1,3,5 and i.e.
		static::$increment += 2;
	}

	public function identifier() {
		return static::NAME;
	}

	public function default_value() {
		return '';
	}

	public function option_field() {
		return array(
			'slug' => __CLASS__,
			'name' => 'CSS <%tag%>id</%tag%>',
			'desc' => 'Add or append <%tag%>id</%tag%> attribute to the link',
			'field_type' => 'text',
		);
	}

	public function active() {
		return empty( $this->id ) ? false : true;
	}

	public function get() {
		return $this->id . '-' . static::$increment;
	}

	public function merge( $value ) {
		return $this->id . '-' . $value;
	}
}
