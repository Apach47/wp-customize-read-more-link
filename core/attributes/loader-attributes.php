<?php

namespace RMLcustomizer\Core\Attributes;

/**
 *
 */
class Loader_attributes extends \RMLcustomizer\Core\Loader
{
    const PATH_TO_ATTRIBUTES = __DIR__ . "/../../modules/attributes/";
    const NAMESPACE_ATTRIBUTE = "\\RMLcustomizer\\Modules\\Attributes\\";
    const BASIC_TYPE_ATTRIBUTES = "\\RMLcustomizer\\Core\\Attributes\\Basic_attribute";

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

        throw new Exception("Attribute's list not loaded", 1);

    }
}
