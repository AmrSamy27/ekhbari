<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user_object;
   
   public function __construct()
   {
       $this->user_object = new User();
   }
    public function edit($id)
    {
       $user = User::find($id);
       $current_user = User::find(Auth::id());
       if($user != null){
           if($user->id == $current_user->id || ($current_user->id == $user->created_by && $user->created_by != null) || $current_user->hasRole("super_admin") || $current_user->hasRole('admin')){
            return view('dashboard.users.profile',['user'=>$user]);
           }
       }
       return redirect()->route('dashboard.articles.index');
    }
    public function update(UserProfileUpdateRequest $request)
    {
        if(count((array)$request->password) < 8 || $request->password != $request->password_confirmation){
            return back();
        }
        $user = $this->user_object->updateUser($request);
        
        if($user != null)   
        $this->user_object->registerLog('update-user-profile');
        
        return redirect()->route('dashboard.articles.index');
    }
}
