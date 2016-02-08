<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Text implements \RMLcustomizer\Core\Contents\Basic_Content
{

	public function __construct() {
	}

	public function get() {

		$text_link = 'Text link in a plugin';
		$text_link = apply_filters( 'apply-text-link', $text_link );
		return $text_link;
	}
}
