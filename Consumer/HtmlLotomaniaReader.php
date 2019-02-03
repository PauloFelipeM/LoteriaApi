<?php

namespace App\Services\LoteriaApi\Consumer;

class HtmlLotomaniaReader extends AbstractHtmlLoteriaReader
{
    public $path = '/lotomania/D_LOTMAN.HTM';
    
    public function __construct(){
       $this->dezenas = [4,6,8,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42];
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
                    'arrecadacao' => $tds->item(44)->nodeValue,
                    'total_ganhadores' => $tds->item(46)->nodeValue,
                    'acumulado' => $tds->item(46)->nodeValue === '0' ? 'SIM' : 'NAO',
                    'valor_acumulado' => $tds->item(46)->nodeValue === '0' ? $tds->item(73)->nodeValue : $tds->item(74)->nodeValue,
                    'estimativa_premio' => $tds->item(46)->nodeValue === '0' ? $tds->item(85)->nodeValue : $tds->item(86)->nodeValue,
                ];
            }
        }
        return $this->results;
    }

}