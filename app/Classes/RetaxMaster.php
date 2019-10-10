<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;

class RetaxMaster {
    
    //Sube una imagen
    public static function uploadImage(object $image, string $folder) : array {
        //Primero subo la imagen
        $supported_files = ["image/jpeg", "image/png", "image/gif"];
        return self::uploadFile($image, $folder, $supported_files);
    }

    //Sube un archivo
    public static function uploadFile(object $file, string $folder, array $supported_files = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"]) : array {
        $response = [];
        $originalName = $file->getClientOriginalName();
        $extension = get_image_extension($originalName);
        $newName = str_shuffle(time().random_string(5)).".".$extension;

        if (in_array($file->getMimeType(), $supported_files)) {
            //Ahora si subo la imagen
            Storage::putFileAs($folder, $file, $newName);

            $response["name"] = $newName;
        }
        else {
            $response["status"] = "false";
            $response["message"] = "Por favor sube una archivo válido";
        }

        return $response;
    }

}


?>