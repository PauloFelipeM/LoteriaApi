<?php

namespace App\Services\LoteriaApi\Consumer;

use \DOMDocument;

class Reader
{
    public function getData($path){
        $dom = new DOMDocument(); /* Classe DOMDocument */

        $oldSetting = libxml_use_internal_errors( true );
        libxml_clear_errors();
        $dom->loadHTMLFile($path);

        return $dom;
    }
}