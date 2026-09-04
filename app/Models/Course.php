<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\ClassModel;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration',
        'fee'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course');
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'course_id');
    }
}
