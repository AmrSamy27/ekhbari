<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable 
{
    use HasFactory;
    use Notifiable;
    use LaratrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_photo_path',
        'status',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function departments(){
        return $this->belongsToMany(Department::class,"user_department");
    }
    public function articlesWriters()
{
    return $this->hasMany(Article::class,'writer_id');
}

public function comments()
{
    return $this->hasMany(Comment::class);
}
public function articlesEditors()
{
    return $this->hasMany(Article::class,'editor_id');
}

    public function logs(){
        return $this->hasMany(Log::class);
    }

    public function registerLog($description){
        $log = Log::create([
            'user_id'=>Auth::id(),
            'description' =>$description
        ]);
        if($log){
            return true;
        }
        return false;
    }
    public function userChanges($request,$status)
    {
        $image_object = new Image();
        if($status == "update"){
            $user = User::find($request->id);
            if($user != null){
              $photo_path = $user->profile_photo_path;
            }     
        }else if($status == "create"){
            $user = new User();
        }

        $image = $request->file('image');
        if($status == "update" && $image != null){
            $photo_path = $image_object->userImageStore($image);
            Storage::delete($user->profile_photo_path);
        }
        
        $current_time = \Carbon\Carbon::now()->timestamp;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        if($status =="create"){
            $photo_path = $image_object->userImageStore($image);
            $user->email_verified_at = $current_time;
            $user->created_by = Auth::id();
            $user->status = 0;
        }
        $user->profile_photo_path = $photo_path;
        $user->updated_at = $current_time;
        $user->save();
        return $user;
    }
}
