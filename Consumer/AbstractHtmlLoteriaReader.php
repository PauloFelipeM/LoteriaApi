<?php

namespace App\Services\LoteriaApi\Consumer;

use \DOMXPath;
use \DOMDocument;

abstract class AbstractHtmlLoteriaReader
{
    protected $apiUrl = './app/Services/LoteriaApi/Arquivos';
    protected $dezenas;
    protected $results;

    protected function getHTMLApiUrl(){
        $dom = new DOMDocument(); /* Classe DOMDocument */

        $oldSetting = libxml_use_internal_errors( true );
        libxml_clear_errors();

        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadHTMLFile($this->apiUrl);        
        
        return $dom;
    }

    protected function getXPath(){
        
        $html = $this->getHTMLApiUrl();        
        $xpath = new DOMXPath($html); /* Classe DOMXPath */
        
        $expression = '(//tr)';
        $rows = $xpath->query($expression);

        return $rows;
    }

    protected function getDezenas($tds)
    {
        $dezenas = [];
        foreach ($this->dezenas as $dezenaConcurso) {
            $dezenas[] = $tds->item($dezenaConcurso)->nodeValue;
        }
        return $dezenas;
    }
}