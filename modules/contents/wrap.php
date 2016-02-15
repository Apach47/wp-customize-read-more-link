<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Wrap implements \RMLcustomizer\Core\Contents\Basic_Content
{
	public function __construct() {
	}

	public function active() {
		return true;
	}

	public function enter() {
		return false;
	}

	public function next() {
		return null;
	}

	public function by_default() {
	}

	public function get( $html ) {
		return '<span class=\'ppc\'>' . $html . '</span>';
	}
}
