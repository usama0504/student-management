<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel; // Agar aapke model ka naam kuch aur hai (misal ke tor par SchoolClass) toh yahan change kar lein
use App\Models\Course;
use App\Models\Teacher;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with(['course', 'teacher'])->latest()->paginate(5);
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('classes.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'course_id'  => 'required|exists:courses,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'start_time' => 'nullable',
            'end_time'   => 'nullable',
        ]);

        ClassModel::create($request->all());

        return redirect('/classes')->with('success', 'Class created successfully!');
    }

    public function show($id)
    {
        $class = ClassModel::with(['course', 'teacher'])->findOrFail($id);
        return view('classes.show', compact('class'));
    }

    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('classes.edit', compact('class', 'courses', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'course_id'  => 'required|exists:courses,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'start_time' => 'nullable',
            'end_time'   => 'nullable',
        ]);

        $class = ClassModel::findOrFail($id);

        $class->update([
            'name'       => $request->name,
            'course_id'  => $request->course_id,
            'teacher_id' => $request->teacher_id,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
        ]);

        return redirect('/classes')->with('success', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);
        $class->delete();

        return redirect('/classes')->with('success', 'Class deleted successfully!');
    }
}
