<?php

namespace RMLcustomizer\Core\Attributes;

interface Basic_Attribute
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
