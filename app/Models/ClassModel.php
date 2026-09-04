<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Teacher;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'course_id',
        'teacher_id',
        'start_time',
        'end_time',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'class_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}