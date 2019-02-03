<?php

namespace App\Services\LoteriaApi\Consumer;

class HtmlTimemaniaReader extends AbstractHtmlLoteriaReader
{
    public $path = '/timemania/D_TIMEMA.HTM';
    
    public function __construct(){
       $this->dezenas = [4,6,8,10,12,14,16];
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
                    'time_coracao' => $tds->item(18)->nodeValue,
                    'arrecadacao' => $tds->item(20)->nodeValue,
                    'total_ganhadores' => $tds->item(22)->nodeValue,
                    'acumulado' => $tds->item(22)->nodeValue === '0' ? 'SIM' : 'NAO',
                    'valor_acumulado' => $tds->item(22)->nodeValue === '0' ? $tds->item(49)->nodeValue : $tds->item(50)->nodeValue,
                    'estimativa_premio' => $tds->item(22)->nodeValue === '0' ? $tds->item(51)->nodeValue : $tds->item(52)->nodeValue,
                ];
            }
        }
        return $this->results;
    }

}