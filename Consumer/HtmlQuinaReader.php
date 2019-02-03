<?php

namespace App\Services\LoteriaApi\Consumer;

class HtmlQuinaReader extends AbstractHtmlLoteriaReader
{
    public $path = '/quina/D_QUINA.HTM';
    
    public function __construct(){
       $this->dezenas = [4,6,8,10,12];
       $this->apiUrl = "{$this->apiUrl}{$this->path}";
       $this->results = "";
    }

    public function getConcurso(){        
        
        $rows = $this->getXPath();
            
        foreach ($rows as $row) {  
            $tds = $row->childNodes;
            if( $tds->length > 3 ){
                $this->results = [
                    'concurso' => $tds->item(0)->nodeValue,
                    'data' => $tds->item(2)->nodeValue,
                    'dezenas' => $this->getDezenas($tds),
                    'arrecadacao' => $tds->item(14)->nodeValue,
                    'total_ganhadores' => $tds->item(16)->nodeValue,
                    'acumulado' => $tds->item(16)->nodeValue === '0' ? 'SIM' : 'NAO',
                    'valor_acumulado' => $tds->item(16)->nodeValue === '0' ? $tds->item(37)->nodeValue : $tds->item(38)->nodeValue,
                    'estimativa_premio' => $tds->item(16)->nodeValue === '0' ? $tds->item(39)->nodeValue : $tds->item(40)->nodeValue,
                ];
            }            
        }
        return $this->results;
    }

}