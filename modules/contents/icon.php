<?php

namespace RMLcustomizer\Modules\Contents;

/**
 *
 */
class Icon implements \RMLcustomizer\Core\Contents\Basic_Content
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
		return new Wrap();
	}

	public function by_default() {
	}

	public function get( $html ) {
		return '<i class="plg-icon"></i>' . $html;
	}
}
