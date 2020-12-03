<?php

namespace App\Http\Controllers\Dashboard\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Requests\EditorsAssignRequest;
use App\Models\Article;
use App\Models\Department;
use App\Models\User;


class ArticleController extends Controller
{
    private $user_object;
    private $article_object;

    public function __construct()
    {
        $this->article_object = new Article();
        $this->user_object = new User();
    }

    public function index()
    {
        $articles = Article::paginate(5);
        return view('dashboard.articles.index',compact('articles'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('dashboard.articles.create',compact('departments'));
    }

    public function store(ArticleStoreRequest $request)
    {
        $this->article_object->articleChanges($request,"create");
        $this->user_object->registerLog("create article");
        return redirect()->route('articles.index');
    }

    
    public function show($id)
    {
        $article = Article::find($id);
        if($article){
            $articleComments = $article->comments()->paginate(5);
            return view('dashboard.articles.show',['article' => $article,'articleComments'=> $articleComments]);
        }
    }
   public function edit($id)
    {
     $article = Article::find($id);
     $departments = Department::all();
      if($article != null){
        return view('dashboard.articles.edit',["article" => $article ,'departments' => $departments ]);
      }
     
      return back();
    }

    public function update(ArticleUpdateRequest $request)
    {
        $this->article_object->articleChanges($request,"update");
        $this->user_object->registerLog("update article");
        return redirect()->route('articles.index');
    }
    public function departmentArticles($id)
    {
        $department = Department::find($id);
        if($department != null){
            $articles = $department->articles()->paginate(5);
            return view('dashboard.articles.index',['articles'=>$articles]);
        }
        return back();
    }
    public function destroy($id)
    {

        $article = Article::find($id);
        $article->delete();
        return redirect()->route('articles.index');
    }
    public function assignEditor($article_id)
    {
        $editors = User::whereRoleIs('editor')->get();
        return view('dashboard.articles.assignEditor',['article_id'=>$article_id,'editors'=>$editors]);
    }
    public function assignedEditor(EditorsAssignRequest $request)
    {   
        $article=Article::find($request->article_id);
        $article->editor_id = $request->id;
        $article->save();
        return redirect()->route('articles.index');
    }
}
