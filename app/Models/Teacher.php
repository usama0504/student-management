<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModel;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'qualification'
    ];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }
}