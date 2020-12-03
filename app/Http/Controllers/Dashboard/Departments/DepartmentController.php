<?php

namespace App\Http\Controllers\Dashboard\Departments;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    private $user_object;
    public function __construct()
    {
        $this->user_object = new User();
    }
    public function index()
    {
        $departments = Department::all();
        return view('dashboard.departments.index',compact('departments'));
    }
    public function create()
    {
        $departments = Department::all();
        return view('dashboard.departments.create',compact('departments'));
    }
    public function store(DepartmentStoreRequest $request)
    {
        $validated = $request->validated();

        if($validated){
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename  = 'department-photo-' . time() . '.' . $extension;
            $image->storeAs('public/images',$filename);
            $department = Department::create([
                'name' =>$request->name,
                'img' =>'storage/images/' . $filename,
                'parent_id' =>$request->parent_department 
            ]);   
            $user = User::find(Auth::id());
            $department->users()->attach($user);
        }  
        $this->user_object->registerLog("create-department");
        return redirect()->route('dashboard.departments.index');         
    }
    public function edit($id)
    {
        $department = Department::find($id);
        $departments = Department::all();
        return view('dashboard.departments.edit',['department'=>$department,'departments'=>$departments]);
    }

    public function update(DepartmentUpdateRequest $request)
    {
        $department = Department::find($request->id);
        $imgPath = $department->img;
        if($request->image != null){
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename  = 'department-photo-' . time() . '.' . $extension;
            Storage::delete($imgPath);
            $image->storeAs('public/images',$filename);
            $imgPath = 'storage/images/' . $filename;
        }
        $department->name = $request->name;
        $department->img = $imgPath;
        $department->save();
        return redirect()->route('departments.index');
       
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        if($department != null){
            Storage::delete($department->img);
            $department->delete();
        }
        return redirect()->route('dashboard.departments.index');
    }
}
