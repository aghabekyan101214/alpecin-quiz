<?php


namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FileUploadHelper
{
    public static function upload($data, array $allowedfileExtension, $folder, $field_name = 'images')
    {
        $images = [];
        foreach ($data as $image) {
            if (in_array("*", $allowedfileExtension) || in_array($image->getClientOriginalExtension(), $allowedfileExtension)) {
                $image = Storage::putFile($folder, new File($image), 'public');
                $images[]["image"] = $image;
            } else {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add($field_name, $image->getClientOriginalName() . " \n Wrong file is chosen, accepted file extensions are " . implode(', ', $allowedfileExtension));
                throw new ValidationException($validator);
            }
        }
        return $images;
    }
}
