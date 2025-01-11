<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadsTrait
{
  public function uploadImage(Request $request, $inputName, $path)
  {
    if ($request->hasFile($inputName)) {

      $image = $request->{$inputName};
      $ext = $image->getClientOriginalExtension();
      $image_name = 'media_'.uniqid() . '_' . $ext;

      $image->move(public_path($path), $image_name);

      return $path . '/' . $image_name;
    }
  }
}
