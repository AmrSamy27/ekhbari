<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['img','article_id'];
    public function article(){
        return $this->belongsTo(Article::class);
    }
    public function articleImageStore($images,$article_id)
    {  
        if ($images != null) {
            foreach($images as $image){
                $image_obj = new Image();
                $path = $image->path();
                $extension = $image->getClientOriginalExtension();
                $filename  = Hash::make($path) . '.' . $extension;
                $image->storeAs('public/images',$filename);
                $image_obj->img = $filename;
                $image_obj->article_id = $article_id;
                $image_obj->save();
            }
        }
    }
    public function userImageStore($image)
    {
        if($image != null){
            $extension = $image->getClientOriginalExtension();
            $filename  = 'profile-photo-' . time() . '.' . $extension;
            $image->storeAs('public/images',$filename);
            $photo_path ='storage/images/' . $filename;
            return $photo_path;
        }
    }
}
