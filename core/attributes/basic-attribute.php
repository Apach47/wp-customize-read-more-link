<?php

namespace RMLcustomizer\Core\Attributes;

interface Basic_Attribute extends \RMLcustomizer\Core\Base_Module
{
	/**
	 * Get attribute's value
	 *
	 * @return string
	 */
	public function get();

	/**
	 * Merge attribute with exist value
	 *
	 * @return string
	 */
	public function merge( $value );

	/**
	 * Get attribute's name
	 *
	 * @return string
	 */
	public function identifier();

	/**
	 * Load or not it attribute
	 */
	public function active();

}
