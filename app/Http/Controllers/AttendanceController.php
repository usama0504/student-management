<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // public function index()
    // {
    //     $attendances = Attendance::latest()->paginate(10);

    //     return view('attendance.index', compact('attendances'));
    // }

    public function index()
    {
        $attendances = Attendance::with([
            'student',
            'classModel.course',
            'classModel.teacher'
        ])->latest()->paginate(10);

        return view('attendance.index', compact('attendances'));
    }

    // public function create()
    // {
    //     return view('attendance.create');
    // }

    public function create()
    {
        $students = \App\Models\Student::all();
        $classes = \App\Models\ClassModel::with(['course', 'teacher'])->get();

        return view('attendance.create', compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        Attendance::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect('/attendance')->with('success', 'Attendance marked successfully!');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);

        $students = \App\Models\Student::all();

        $classes = \App\Models\ClassModel::with([
            'course',
            'teacher'
        ])->get();

        return view('attendance.edit', compact(
            'attendance',
            'students',
            'classes'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'class_id' => 'required|integer',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        $attendance = Attendance::findOrFail($id);

        $attendance->update([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect('/attendance')
            ->with('success', 'Attendance updated successfully!');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect('/attendance')->with('success', 'Attendance deleted successfully!');
    }

    // public function report(Request $request)
    // {
    //     $date = $request->date;

    //     $attendances = Attendance::query();

    //     if ($date) {
    //         $attendances->where('date', $date);
    //     }

    //     $attendances = $attendances->latest()->get();

    //     $total = $attendances->count();
    //     $present = $attendances->where('status', 'present')->count();
    //     $absent = $attendances->where('status', 'absent')->count();

    //     return view('attendance.report', compact(
    //         'attendances',
    //         'date',
    //         'total',
    //         'present',
    //         'absent'
    //     ));
    // }

    public function report(Request $request)
    {
        $date = $request->date;

        $attendances = Attendance::with([
            'student',
            'classModel.course',
            'classModel.teacher'
        ]);

        if ($date) {
            $attendances->where('date', $date);
        }

        $attendances = $attendances->latest()->get();

        $total = $attendances->count();
        $present = $attendances->where('status', 'present')->count();
        $absent = $attendances->where('status', 'absent')->count();

        return view('attendance.report', compact(
            'attendances',
            'date',
            'total',
            'present',
            'absent'
        ));
    }
}
