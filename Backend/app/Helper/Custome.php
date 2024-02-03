<?php

namespace App\Helper;

class Custome
{

    public static function imageBase64Decode($imageName,$allowTypes=null, $path=null){
        if($imageName) {
            $base64Image = $imageName;
            list($type, $data) = explode(';', $base64Image);
            list(, $mimeType) = explode('/', $type);
            list(, $data) = explode(',', $data);
            $imageData = base64_decode($data);
            $fileName = 'image_' . md5(uniqid()) . time() . '.' . $mimeType;
            $path = public_path($path ? $path . '/' . $fileName : 'image/' . $fileName);
            $saveImage= file_put_contents($path, $imageData);
            if($saveImage){
                return $fileName;
            }
            else{
                return null;
            }

        }

        else{
            return false;
        }
    }

    public static function ImageBase64Encoded($image, $folderName=null){
        if($image){
            $path = public_path($folderName ? $folderName.'/'. $image : 'image/'.$image);
            if(file_exists($path)){
                $imageData = file_get_contents($path);
                $encodeData = base64_encode($imageData);
                return $encodeData;
            }
            else{
                return null;
            }
        }
    }

}
