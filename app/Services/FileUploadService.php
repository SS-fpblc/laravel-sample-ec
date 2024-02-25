<?php
 
namespace App\Services;
 
class FileUploadService {
 
    public function saveImage($image, $folder){
      $path = '';
      if( isset($image) === true ){
          $path = $image->store($folder, 'public');
      }
      return $path; // 画像が存在しない場合は空文字
    }
}
