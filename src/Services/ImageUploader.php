<?php
 namespace App\Services;
 
 use Symfony\Component\HttpFoundation\File\UploadedFile;
 
 class ImageUploader
 {

    public function __construct(){
         \Cloudinary::config([
            "cloud_name"=>"df3uvqrte",
             "api_key"=>678416948214361,
             "api_secret"=>"FjkPO_r-0Iv13YMwlN2bzvjFnGg"
         ]);
    }
     public function uploadImageToCloudinary(UploadedFile $file)
     {
         $fileName = $file->getRealPath();
         // $imageUploaded = \Cloudinary\Uploader::upload($fileName, [
         //     'folder' => 'E-COMMERCE',
         // ]);
         $imageUploaded = \Cloudinary\Uploader::upload($fileName);
 
         return $imageUploaded;
     }
     public function removeImageToCloudinary(string $id){
        \Cloudinary\Uploader::destroy($id);
     }
 }