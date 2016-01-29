<?php

namespace RMLcustomizer\Modules\Attributes;

/**
 *
 */
class Angular_ng_click implements \RMLcustomizer\Core\Attributes\Basic_attribute
{

    public function __construct()
    {
        echo "rml_Link_attribute_angular_ng_click";
        # code...
    }

    public function get()
    {
        return "ng-click=\"wp-now()\"";
    }
}
