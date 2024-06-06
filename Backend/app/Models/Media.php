<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['image'];

    public static function storeOrUpdate($image, $id = null)
    {
        $media = new Media();

        // store the image in Storage
        $filename = $image->getClientOriginalName(); // get the file name
        $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
        $getfileExtension = $image->getClientOriginalExtension(); // get the file extension
        $createnewFileName = time() . '_' . str_replace(' ', '_', $getfilenamewitoutext) . '.' . $getfileExtension; // create new random file name
        $img_path = $image->storeAs('public/images/posts', $createnewFileName); // get the image path

        // store the image on the database
        $media->image = $createnewFileName;
        $media->save();
        return $media->id;
    }
}
