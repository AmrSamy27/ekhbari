<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->hasRole('admin') || $user->hasRole('super_admin')){
            $logs = Log::paginate(10);
            return view('dashboard.index',compact('logs'));
        }else if($user->hasRole('writer')){
            $articles = $user->articlesWriters()->paginate(5);
            return view('dashboard.articles.index',['articles' => $articles]);
        }else if($user->hasRole('Editor')){
            $articles = $user->articlesEditors()->paginate(5);
            return view('dashboard.articles.index',['articles' => $articles]);
        }else{
            return redirect()->route('articles.index');
        }
    }
}
