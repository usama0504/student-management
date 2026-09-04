<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Fee;
use App\Models\Attendance;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'city',  'photo',];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course');
    }
    public function fees()
    {
        return $this->hasMany(Fee::class, 'student_id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}
