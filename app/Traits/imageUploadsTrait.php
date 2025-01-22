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
      $image_name = 'media_' . uniqid() . '.' . $ext;

      $image->move(public_path($path), $image_name);

      return $path . '/' . $image_name;
    }
  }

  public function uploadMultiImage(Request $request, $inputName, $path)
  {
    if ($request->hasFile($inputName)) {

      $images = $request->{$inputName};
      foreach ($images as $image) {
        $ext = $image->getClientOriginalExtension();
        $image_name = 'media_' . uniqid() . '.' . $ext;

        $image->move(public_path($path), $image_name);

        $imagePaths[] = $path . '/' . $image_name;
      }
      return $imagePaths;
    }
  }

  public function updateImage(Request $request, $inputName, $path, $oldPath = null)
  {
    if ($request->hasFile($inputName)) {

      if (File::exists(public_path($oldPath))) {

        File::delete(public_path($oldPath));
      }

      $image = $request->$inputName;

      $ext = $image->getClientOriginalExtension();

      $imageName = 'media_' . uniqid() . '.' . $ext;

      $image->move(public_path($path), $imageName);

      $path = "/uploads/$imageName";

      return $path;
    } else return $oldPath;
  }

  public function deleteImage(string $path)
  {
    if (File::exists(public_path($path))) {
      File::delete(public_path($path));
    }
  }
}
