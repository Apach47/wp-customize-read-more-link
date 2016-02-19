<?php

namespace RMLcustomizer\Modules\Attributes\Angular;

/**
 *
 */
class Ng_Click implements \RMLcustomizer\Core\Attributes\Basic_Attribute
{
	const NAME = 'ng-click';
	private $ng_click;

	public function __construct() {

		$this->ng_click = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
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
			'name' => 'Angular <%tag%>ng-click</%tag%>',
			'desc' => 'Add or replace <%tag%>ng-click</%tag%> directive to the link',
			'field_type' => 'text',
		);
	}

	public function active() {
		return empty( $this->ng_click ) ? false : true;
	}

	public function get() {
		return $this->ng_click;
	}

	public function merge( $value ) {
		// Angular ng-click doesn't accept more than one thing
		return $this->get();
	}
}
