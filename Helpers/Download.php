<?php

namespace App\Helpers;

class Download {

    /**
     * Download files from external url
     * @param url download file => $url
     * @param path input file => $filepath
     */
    public function downloadFile($url, $filepath, $httpheader = null){
        $ch = curl_init($url);
        if($httpheader) curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $raw_file_data = curl_exec($ch);
   
        if(curl_errno($ch)){
           echo 'error:' . curl_error($ch);
        }
        curl_close($ch);

        file_put_contents($filepath, $raw_file_data);
        return (filesize($filepath) > 0)? true : false;
    }

}