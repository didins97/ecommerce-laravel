<?php

namespace App\Helpers;

class Helper 
{
    // public static function moveImage($images, $path_move)
    // {
    //     $new_name = time() . '.' . $images->getClientOriginalExtension();
    //     $images->move($path_move, $new_name);
    //     return $new_name;
    // }

    // public static function moveImages($images, $path_move)
    // {
    //     foreach ($images as $image) {
    //         $new_name = rand() . time() . '.' . $image->getClientOriginalExtension();
    //         $image->move($path_move, $new_name);
    //         $new_names[] = $new_name;
    //     }
    //     return $new_names;
    // }

    // public static function deleteImage($path_delete, $image)
    // {
    //     if (file_exists($path_delete . $image)) {
    //         unlink($path_delete . $image);
    //     }
    // }

    // public static function deleteImages($path_delete, array $images)
    // {
    //     foreach ($images as $image) {
    //         if (file_exists($path_delete . $image)) {
    //             unlink($path_delete . $image);
    //         }
    //     }
    // }

    public static function getPrice($price)
    {
        return 'Rp. ' . number_format($price, 0, ',', '.');
    }
}