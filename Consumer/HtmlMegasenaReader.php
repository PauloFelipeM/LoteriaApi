<?php

namespace App\Services\LoteriaApi\Consumer;

class HtmlMegasenaReader extends AbstractHtmlLoteriaReader
{
    public $path = '/megasena/D_MEGA.HTM';
    
    public function __construct(){
       $this->dezenas = [4,6,8,10,12,14];
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
                    'arrecadacao' => $tds->item(16)->nodeValue,
                    'total_ganhadores' => $tds->item(18)->nodeValue,
                    'acumulado' => $tds->item(18)->nodeValue === '0' ? 'SIM' : 'NAO',
                    'valor_acumulado' => $tds->item(18)->nodeValue === '0' ? $tds->item(35)->nodeValue : $tds->item(36)->nodeValue,
                    'estimativa_premio' => $tds->item(18)->nodeValue === '0' ? $tds->item(37)->nodeValue : $tds->item(38)->nodeValue,
                ];
            }
        }
        return $this->results;
    }

}