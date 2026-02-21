<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_code', 'course_name', 'description', 'capacity'];

    public function students() 
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }
}
