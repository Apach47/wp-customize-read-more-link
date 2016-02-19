<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Href implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'href';
	private $url;

	public function __construct() {

		$this->url = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
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
			'name' => 'Link <%tag%>href</%tag%>',
			'desc' => 'Append sufix to the <%tag%>href</%tag%> attribute',
			'field_type' => 'text',
		);
	}

	public function active() {
		return empty( $this->url ) ? false : true;
	}

	public function get() {
		return $this->url;
	}

	public function merge( $value ) {
		return $value . $this->url;
	}
}
