<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postimage extends Model
{
    use HasFactory;

    public static function upload($image) {
        if($image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $result = $image->move(public_path() . "/assets/images/posts/", $imageName);
            if($result) {
                return $imageName;
            }
            return false;
        }
    }
}
