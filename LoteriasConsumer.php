<?php

namespace App\Services\LoteriaApi;

use App\Services\LoteriaApi\ImageCreate\ImageMegaSenaCreate;
use App\Services\LoteriaApi\ImageCreate\ImageQuinaCreate;
use App\Services\LoteriaApi\ImageCreate\ImageTimeManiaCreate;
use App\Services\LoteriaApi\ImageCreate\ImageLotoManiaCreate;
use App\Services\LoteriaApi\ImageCreate\ImageLotoFacilCreate;
use App\Services\LoteriaApi\ImageCreate\ImageDuplaSenaCreate;

class LoteriasConsumer {

    protected $loteriasWrite;
    protected $megasena;
    protected $quina;
    protected $timemania;
    protected $lotomania;
    protected $lotofacil;
    protected $duplasena;

    public function __construct(LoteriasWrite $loteriasWrite, ImageMegaSenaCreate $megasena, ImageQuinaCreate $quina, ImageTimeManiaCreate $timemania
                                , ImageLotoManiaCreate $lotomania, ImageLotoFacilCreate $lotofacil, ImageDuplaSenaCreate $duplasena)
    {
        $this->loteriasWrite = $loteriasWrite;
        $this->megasena = $megasena;
        $this->quina = $quina;
        $this->timemania = $timemania;
        $this->lotomania = $lotomania;
        $this->lotofacil = $lotofacil;
        $this->duplasena = $duplasena;
    }

    public function getAll()
    {  
        try 
        {
            $this->megasena->createImage();
            $this->quina->createImage();
            $this->timemania->createImage();
            $this->lotomania->createImage();
            $this->lotofacil->createImage();
            $this->duplasena->createImage();

        } catch (\Exception $e) {
            \Log::info('Error ao criar loterias' . $e->getMessage() . \Carbon\Carbon::now());
            echo('Error: ' . $e->getMessage());
        }
    }

}