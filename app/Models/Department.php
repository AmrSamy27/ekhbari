<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SelfReferenceTrait;

class Department extends Model
{
    use HasFactory,SelfReferenceTrait;
    protected $fillable=['name','img','parent_id'];
    public function users(){
        return $this->belongsToMany(User::class,"user_department");
    }
    public function Articles(){
        return $this->hasMany(Article::class);
    }
}
