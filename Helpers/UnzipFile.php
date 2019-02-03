<?php

namespace App\Helpers;

class UnzipFile {
    
    /**
     * Unzip file in zip format
     * @param pathFileToExtract $filepath
     * @param pathToUnzipFile $fileextract
     * @return void
     */
    public function unzip($filepath, $fileextract){
        $zip = new \ZipArchive;

        $res = $zip->open($filepath);
        if ($res === TRUE) {
            $zip->extractTo($fileextract);
            $zip->close();
            unlink($filepath);
        } else {
            echo 'Extração do arquivo ZIP falhou';
        }
    }

}