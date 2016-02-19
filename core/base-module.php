<?php

namespace RMLcustomizer\Core;

interface Base_Module {

	/**
	 * Default value for module
	 */
	public function default_value();

	/**
	 * Setting field for option page in admin panel
	 */
	public function option_field();
}
