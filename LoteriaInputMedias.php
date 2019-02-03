<?php

namespace App\Services\LoteriaApi;

use App\Media;
use DateTime;

class LoteriaInputMedias {

    public function inputMedias($concurso)
    {       
        $midias = Media::firstOrNew(array('original_filename' => $concurso . '.' . 'jpg'));

        $midias->mime = 'image/jpeg';
        $midias->original_filename = $concurso . '.' . 'jpg';
        $midias->storage_filename = $concurso . '.' . 'jpg';
        $midias->name = 'LOTERIA: ' . strtoupper($concurso);
        $midias->file_type = 3;
        $midias->updated_at = new DateTime();
        $midias->save();
    }

}