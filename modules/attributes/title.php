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

		$this->title = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
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
			'name' => 'Link <%tag%>title</%tag%>',
			'desc' => 'Append sufix to the <%tag%>title</%tag%> attribute',
			'field_type' => 'text',
		);
	}

	public function active() {
		return empty( $this->title ) ? false : true;
	}

	public function get() {
		return $this->title;
	}

	public function merge( $value ) {
		return $value . $this->title;
	}
}
