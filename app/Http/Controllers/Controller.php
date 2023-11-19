<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Storage;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    function uploadFile($nameFolder,$file) {
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs($nameFolder,$fileName,'public');
    }
    function deleteFile($nameImage)  {
        $deleteImage = Storage::delete('/public/' . $nameImage);
        return $deleteImage;
    }
    
}
