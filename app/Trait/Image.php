<?php

namespace App\Trait;
trait Image
{
    public function UploadImage($path, $request, $name)
    {

        $image_name = $name . time();
        $ext = strtolower($request->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $image_url = $path . $image_full_name;
        $success = $request->move($path, $image_full_name);
        return $image_url;
    }
}
