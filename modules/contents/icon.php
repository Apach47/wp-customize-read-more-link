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
		return false;
	}

	public function get() {

		return '<i class="plg-icon"></i>';
	}
}
