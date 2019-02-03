<?php 

namespace App\Services\LoteriaApi;

use App\Helpers\Download;
use App\Helpers\UnzipFile;

class LoteriasWrite {

    protected $apiUrl = 'http://www1.caixa.gov.br/loterias/_arquivos/loterias';
    protected $filePath = './app/Services/LoteriaApi/Arquivos';
    protected $httpHeader = array("Cookie: security=true");

    protected $download;
    protected $unzipFile;

    public function __construct(Download $download, UnzipFile $unzipFile){
        $this->download = $download;
        $this->unzipFile = $unzipFile;
    }

    public function getAll(){

        $concursos = array(
            ['concurso' => 'duplasena', 'finalurl' => '/d_dplsen.zip'],
            ['concurso' => 'lotofacil', 'finalurl' => '/D_lotfac.zip'],
            ['concurso' => 'lotomania', 'finalurl' => '/D_lotoma.zip'],
            ['concurso' => 'megasena',  'finalurl' => '/D_megase.zip'],
            ['concurso' => 'quina',     'finalurl' => '/D_quina.zip'],
            ['concurso' => 'timemania', 'finalurl' => '/D_timema.zip'],
        );

        $apiUrl;
        $filePath;
        $fileExtract;

        foreach ($concursos as $key => $concurso) {
            //URL Path for download
            $apiUrl = "{$this->apiUrl}"."{$concurso['finalurl']}";

            //Path to download the concursos
            $filePath = "{$this->filePath}" . "/" . "{$concurso['concurso']}" . "/concurso.zip";

            //Path to extract the zip file of concursos
            $fileExtract = "{$this->filePath}" . "/" . "{$concurso['concurso']}" . "/";

            //Method to download concurso
            $this->download->downloadFile($apiUrl , $filePath, $this->httpHeader);

            //Method to unzip concurso.zip
            $this->unzipFile->unzip($filePath, $fileExtract);
        }
    }

}   