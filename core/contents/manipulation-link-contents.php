<?php

namespace RMLcustomizer\Core\Contents;

/**
 *
 */
class DisassembleContents extends Disassemble
{
    protected $_text;

    public function __construct($text)
    {
        $this->_text = $text;
        parent::__construct();
    }

    public function getContents()
    {

    }
}
