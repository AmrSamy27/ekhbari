<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [ 'title','description','writer_id','editor_id','department_id'];
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function articleWriter(){
        return $this->belongsTo(User::class,'writer_id');
    }
    public function articleEditor(){
        return $this->belongsTo(User::class,'editor_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function articleChanges($request,$status)
    {
        
       if($status == "create"){
        $article = new Article();
        $writer_id = NULL;
        $editor_id = NULL;
        if(auth()->user()->roles[0]->name == "writer"){
            $writer_id = auth()->user()->id;
         }else{
             $editor_id = auth()->user()->id;
             $writer_id = auth()->user()->id;
         }
       }else if($status == "update"){
        $article = Article::find($request->id);
        $writer_id = $article->writer_id == null?null:$article->writer_id;
        $editor_id = $article->editor_id == null?null:$article->editor_id;
       }

        $article->title =$request->title;
        $article->description =$request->description;
        $article->writer_id = $writer_id;
        $article->editor_id  = $editor_id;
        $article->department_id = $request->department;
        $article->save();
        $image_obj = new Image();
        $image_obj->articleImageStore($request->file('images'),$article->id);
    }
}
