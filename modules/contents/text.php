<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Text implements \RMLcustomizer\Core\Contents\Basic_Content
{
	public function __construct() {
	}

	public function active() {
		return true;
	}

	public function enter() {
		return true;
	}

	public function next() {
		return new Icon();
	}

	public function get( $text ) {

		$text = 0;
		$text_link = 'Plugin more...';
		return $text_link;
	}
}
