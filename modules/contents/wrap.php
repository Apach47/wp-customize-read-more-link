<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Wrap implements \RMLcustomizer\Core\Contents\Basic_Content
{
	private $wrapper;
	private $wrapper_class = 'rml-wrap';

	public function __construct() {

		$this->wraper = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
	}

	public function active() {
		return empty( $this->wraper ) ? false : true;
	}

	public function enter() {
		return false;
	}

	public function next() {
		return null;
	}

	public function default_value() {
		// Value may be 'div' or 'span'
		return '';
	}

	public function option_field() {
		return array(
			'slug' => __CLASS__,
			'name' => 'Wrap the link',
			'desc' => 'Add wraper around the link. Wraper element will have <%tag%>rml-wrap</%tag> as css class',
			'field_type' => 'radio',
			'field_value' => array( 'div', 'span' ),
		);
	}

	public function get( $html ) {
		return sprintf( '<%1$s class="' . $this->wrapper_class . '">%2$s</%1$s>', $this->wrapper, $html );
	}
}
