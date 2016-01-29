<?php

namespace RMLcustomizer\Core\Contents;

/**
 *
 */
class Loader_Contents extends \RMLcustomizer\Core\Loader
{
    const PATH_TO_ATTRIBUTES = __DIR__ . "/../../modules/contents/";
    const NAMESPACE_ATTRIBUTE = "\\RMLcustomizer\\Modules\\Contents\\";
    const BASIC_TYPE_ATTRIBUTES = "\\RMLcustomizer\\Core\\Contents\\Basic_content";

    public function __construct()
    {
        parent::__construct();
    }

    public function load()
    {
        if ($this->_search(realpath(self::PATH_TO_ATTRIBUTES))) {
            return $this->_init(
                self::NAMESPACE_ATTRIBUTE,
                self::BASIC_TYPE_ATTRIBUTES
            );
        }

        throw new Exception("Content's list not loaded", 1);

    }
}
