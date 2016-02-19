<?php

namespace RMLcustomizer\Core\Attributes;

/**
 *
 */
class Loader_Attributes extends \RMLcustomizer\Core\Loader
{
	// Full path to attributes directory
	const PATH_TO_ATTRIBUTES = __DIR__ . '/../../modules/attributes/';
	// Namespace to directory's atttibute
	const NAMESPACE_ATTRIBUTE = '\\RMLcustomizer\\Modules\\Attributes\\';
	// Interface implementation each attribute
	const BASIC_TYPE_ATTRIBUTES = '\\RMLcustomizer\\Core\\Attributes\\Basic_Attribute';

	public function __construct() {

		parent::__construct();
	}

	public function load() {

		if ( $this->search( realpath( static::PATH_TO_ATTRIBUTES ) ) ) {
			return $this->init(
				static::NAMESPACE_ATTRIBUTE,
				static::BASIC_TYPE_ATTRIBUTES
			);
		}

		throw new Exception( "Attribute's list not loaded", 1 );

	}

	/**
	 * Options for setting section in admin page
	 *
	 * TODO: Move into setting scaffold in future version
	 */
	public function settings() {
		return array(
			'slug' => 'rml-attributes-modules',
			'name' => 'Attributes',
			'desc' => 'Some text will adding leter..',
		);
	}
}
