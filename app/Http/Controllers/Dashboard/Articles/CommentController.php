<?php

namespace App\Http\Controllers\Dashboard\Articles;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $user_object;
    public function __construct()
    {

        $this->user_object = new User();
    }
    public function store(Request $request,$id)
    {
       
        $request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['article_id'] = $id;
        $comment = Comment::create($input);
         $this->user_object->registerLog("comment on article");   
        return back();
    }

    public function replyStore(Request $request,$id)
    {
        $request->validate([
            'body'=>'required',
        ]);

        $chiled_comment = new Comment([
            "user_id"   =>auth()->user()->id,
            "article_id"=>$request->article_id,
            "body"=>$request->body
        ]);

        $comment = Comment::find($id);
        $comment->replies()->save($chiled_comment);
        return back();
    }
}
