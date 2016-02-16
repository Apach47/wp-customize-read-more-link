<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Wrap implements \RMLcustomizer\Core\Contents\Basic_Content
{
	private $wraper;

	public function __construct() {

		$setting = \RMLcustomizer\Core\Setting::get_instance()->retrieve( $this );
		$this->wraper = $setting['value'];
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

	public function by_default() {
		// Value may be 'div' or 'span'
		return array(
			'value' => '',
		);
	}

	public function get( $html ) {
		return sprintf( '<%1$s class="rml-wrap-plugin">%2$s</%1$s>', $this->wraper, $html );
	}
}
