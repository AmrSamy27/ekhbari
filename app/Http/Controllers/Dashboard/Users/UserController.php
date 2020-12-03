<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   private $user_object;

   public function __construct()
   {
       $this->user_object = new User();
   }
    public function index($role)
    {
        if($role == 'all'){
            $users = User::all();
        }else if($role == "editors"){
            $users = User::whereRoleIs('editor')->get();
        }else if($role == "writers"){
            $users = User::whereRoleIs('writer')->get();
        }else{
            $users = User::whereRoleIs('user')->get();
        }
        return view('dashboard.users.index',compact('users'));

    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create',compact('roles'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        if($user != null){
            $roles = Role::all();
            return view('dashboard.users.edit',['user'=>$user,'roles'=>$roles]);
        }   
    }

    public function store(UserStoreRequest $request)
    {
        $user = $this->user_object->userChanges($request,"create");
        $user->attachRole($request->role); 
        $this->user_object->registerLog('create-user');
        return redirect()->route('dashboard.users.index');
    }

    public function update(UserUpdateRequest $request)
    {
        $user = $this->user_object->userChanges($request,"update");
        if ($request->role != null && $request->role != $user->roles[0]) {
            $user->detachRole($user->roles[0]->name);
            $user->attachRole($request->role);
        }
        $this->user_object->registerLog('update-user');
        $userRole = User::find(Auth::id());
        if($userRole->hasRole("admin") || $userRole->hasRole("super_admin") ){
            return redirect()->route('dashboard.users.index',"all");
        }else if($userRole->hasRole("editor")){
            return redirect()->route("dashboard.index","writers");
        }
    }
}