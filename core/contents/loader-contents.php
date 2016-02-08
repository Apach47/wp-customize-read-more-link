<?php

namespace RMLcustomizer\Core\Contents;

/**
 *
 */
class Loader_Contents extends \RMLcustomizer\Core\Loader
{
	const PATH_TO_CONTENTS = __DIR__ . '/../../modules/contents/';
	const NAMESPACE_CONTENT = '\\RMLcustomizer\\Modules\\Contents\\';
	const BASIC_TYPE_CONTENTS = '\\RMLcustomizer\\Core\\Contents\\Basic_Content';

	public function __construct() {

		parent::__construct();
	}

	public function load() {

		if ( $this->search( realpath( self::PATH_TO_CONTENTS ) ) ) {
			return $this->init(
				self::NAMESPACE_CONTENT,
				self::BASIC_TYPE_CONTENTS
			);
		}

		throw new Exception( "Content's list not loaded", 1 );

	}
}
