<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function gallery()
    {
        $images = Image::all();
        return view('dashboard.articles.gallery',compact('images'));
    }
    public function show($id)
    {
        $images = Article::find($id)->images;
        return view('dashboard.articles.gallery',compact('images'));
    }
    public function destroy($id)
    {
        $image = Image::find($id);
        $isDeleted = false;
        if($image != null){
            $isDeleted = $image->delete();
        }
        
        return response()->json(["isDeleted" => $isDeleted]);
    }
}
