<?php

namespace RMLcustomizer\Core\Attributes;

/**
 *
 */
class Loader_Attributes extends \RMLcustomizer\Core\Loader
{
	const PATH_TO_ATTRIBUTES = __DIR__ . '/../../modules/attributes/';
	const NAMESPACE_ATTRIBUTE = '\\RMLcustomizer\\Modules\\Attributes\\';
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
}
