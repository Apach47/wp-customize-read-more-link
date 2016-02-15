<?php

namespace RMLcustomizer\Core\Contents;

/**
 *
 */
interface Basic_Content extends \RMLcustomizer\Core\Base_Module
{
	/**
	 * Load or not it content's bit
	 *
	 * @return bool
	 */
	public function active();

	/**
	 * Get content's bit
	 *
	 * @return string
	 */
	public function get( $html );

	/**
	 * If true then this module start processing.
	 * Implementation "Chain of responsibility"
	 *
	 * @return bool
	 */
	public function enter();

	/**
	 * Module that will accept processing
	 *
	 * @return Basic_Content
	 */
	public function next();

}
