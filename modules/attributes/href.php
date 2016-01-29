<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Href implements \RMLcustomizer\Core\Attributes\Basic_attribute
{
    private $_href;

    public function __construct()
    {
        echo "rml_Link_attribute_href";
        # code...
    }

    public function get()
    {
        $this->_href = "Href Test";

        return $this->_href;
    }
}
