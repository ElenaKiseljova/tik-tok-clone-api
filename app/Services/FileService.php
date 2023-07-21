<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

use Image;

class FileService
{
  public function updateImage(User $model, Request $request): User
  {
    $image = Image::make($request->file('image'));

    if (!empty($model->image)) {
      $currentImage = public_path() . $model->image;

      if (file_exists($currentImage) && $currentImage !== public_path() . '/user-placeholder.png') {
        unlink($currentImage);
      }

      $file = $request->file('image');

      $extension = $file->getClientOriginalExtension();

      $image->crop(
        $request->width,
        $request->height,
        $request->left,
        $request->top,
      );

      $name = time() . '.' . $extension;

      $image->save(public_path() . '/files/' . $name);

      $model->image = '/files/' . $name;

      return $model;
    }
  }

  public function addVideo(Post $model, Request $request): Post
  {
    $video = $request->file('video');
    $extension = $video->getClientOriginalExtension();

    $name = time() . '.' . $extension;

    $video->move(public_path() . '/files/', $name);

    $model->video = '/files/' . $name;

    return $model;
  }
}
