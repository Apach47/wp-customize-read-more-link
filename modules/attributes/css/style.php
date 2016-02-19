<?php

namespace RMLcustomizer\Modules\Attributes\Css;

/**
 *
 */
class Style implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'style';
	private $style;

	public function __construct() {

		$this->style = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
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
			'name' => 'CSS <%tag%>style</%tag%>',
			'desc' => 'Add or append before css style to the <%tag%>style</%tag%> attribute',
			'field_type' => 'text',
		);
	}

	public function active() {
		return empty( $this->style ) ? false : true;
	}

	public function get() {
		return $this->style;
	}

	public function merge( $value ) {
		return $this->style. ',' . $value;
	}
}
