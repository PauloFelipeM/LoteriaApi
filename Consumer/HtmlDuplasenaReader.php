<?php

namespace App\Services\LoteriaApi\Consumer;

class HtmlDuplasenaReader extends AbstractHtmlLoteriaReader
{
    public $path = '/duplasena/D_DPLSEN.HTM';
    public $dezenas_sorteio2 = [41,43,45,47,49,51];
    public $dezenas_sorteio2_2 = [42,44,46,48,40,52];
    
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
                    'valor_acumulado' => "",
                    'dezenas_sorteio_2' => $tds->item(18)->nodeValue === '0' ? $this->getDezenasSorteio2($tds, $this->dezenas_sorteio2) 
                                                                             : $this->getDezenasSorteio2($tds, $this->dezenas_sorteio2_2),
                    'total_ganhadores_sorteio_2' => $tds->item(18)->nodeValue === '0' ? $tds->item(53)->nodeValue : $tds->item(54)->nodeValue,
                    'acumulado_sorteio_2' => $tds->item(18)->nodeValue === '0' ? $tds->item(53)->nodeValue === '0' ? 'SIM' : 'NAO'
                                                                               : $tds->item(54)->nodeValue === '0' ? 'SIM' : 'NAO',
                    'estimativa_premio' => $tds->item(18)->nodeValue === '0' ? $tds->item(69)->nodeValue : $tds->item(71)->nodeValue,
                ];
            }
        }
        return $this->results;
    }

    //Sorteio das dezenas da segunda rodada da Dupla Sena
    protected function getDezenasSorteio2($tds, $dezenas2)
    {                 
        $dezenas = [];         
        foreach ($dezenas2 as $dezenaConcurso) {
            $dezenas[] = $tds->item($dezenaConcurso)->nodeValue;
        }
        return $dezenas;
    }


}