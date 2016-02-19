<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *	Read "Ssalc" as "Class", becouse keyword "class" is exist in PHP.
 * Yes, it is crutch. May be you know better way?
 */
class Ssalc implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'class';
	private $class;

	public function __construct() {

		$this->class = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
	}

	public function identifier() {
		return static::NAME;
	}

	public function default_value() {
		return 'rml-plugin';
	}

	public function option_field() {
		return array(
			'slug' => __CLASS__,
			'name' => 'CSS <%tag%>class</%tag>',
			'desc' => 'Add or append <%tag%>class</%tag%> attribute to the link',
			'field_type' => 'text',
		);
	}

	public function active() {
		return empty( $this->class ) ? false : true;
	}

	public function get() {
		return $this->class;
	}

	public function merge( $value ) {
		return $this->class . ' ' . $value;
	}
}
