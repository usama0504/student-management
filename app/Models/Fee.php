<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Fee extends Model
{
    protected $fillable = [
        'student_id',
        'fee_amount',
        'paid_amount',
        'pending_amount',
        'due_date',
        'status'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
