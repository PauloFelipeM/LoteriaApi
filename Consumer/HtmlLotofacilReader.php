<?php

namespace App\Services\LoteriaApi\Consumer;

class HtmlLotofacilReader extends AbstractHtmlLoteriaReader
{
    public $path = '/lotofacil/D_LOTFAC.HTM';
    
    public function __construct(){
       $this->dezenas = [4,6,8,10,12,14,16,18,20,22,24,26,28,30,32];
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
                    'arrecadacao' => $tds->item(34)->nodeValue,
                    'total_ganhadores' => $tds->item(36)->nodeValue,
                    'acumulado' => $tds->item(36)->nodeValue === '0' ? 'SIM' : 'NAO',
                    'valor_acumulado' => $tds->item(36)->nodeValue === '0' ? $tds->item(59)->nodeValue : $tds->item(60)->nodeValue,
                    'estimativa_premio' => $tds->item(36)->nodeValue === '0' ? $tds->item(61)->nodeValue : $tds->item(62)->nodeValue,
                ];
            }
            
        }
        return $this->results;
    }

}