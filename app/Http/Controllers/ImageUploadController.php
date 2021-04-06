<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function imageUpload($file)
    {
        if ($file == null) :
            return '';
        endif;

        if ($file->getError() != 0) :
            return '';
        endif;

        // Verifica se é mesmo uma imagem
        $check = getimagesize($file->getPathName());
        if ($check === false) :
            return '';
        endif;

        // Verifica tamanho do arquivo
        if ($file->getSize() > 1000000) :
            return '';
        endif;

        // Faz upload se nada deu errado
        $fileName = $file->hashName();
        $file->store('files', 'public');

        return $fileName;
    }
}
