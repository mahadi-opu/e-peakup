<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function imageUpload($image, $path)
    {
        $ext        = $image->extension();
        $filename   = 'image-'.time().rand().'.'.$ext;
        $image->move($path, $filename);
        $image_url  = $path.$filename;

        return $image_url;
    }
}
