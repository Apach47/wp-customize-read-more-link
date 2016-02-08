<?php

namespace RMLcustomizer\Core\Contents;

/**
 *
 */
interface Basic_Content
{
	/**
	 * Load or not it content's bit
	 * @return bool
	 */
	public function active();

	/**
	 * Get content's bit
	 * @return string
	 */
    public function get();
}
