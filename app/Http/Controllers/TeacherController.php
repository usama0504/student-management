<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\ClassModel;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->paginate(5);

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::all(); // Yahan Teacher model use karna hai

        return view('teachers.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'qualification' => 'nullable|string|max:255',
        ]);

        Teacher::create($request->all());

        return redirect('/teachers')->with('success', 'Teacher added successfully!');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $courses = Course::all();
        $teachers = Teacher::all(); // Yahan bhi Teacher model use karna hai

        return view('teachers.edit', compact('teacher', 'courses', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'qualification' => 'nullable|string|max:255',
        ]);

        $teacher = Teacher::findOrFail($id);

        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'qualification' => $request->qualification,
        ]);

        return redirect('/teachers')->with('success', 'Teacher updated successfully!');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect('/teachers')->with('success', 'Teacher deleted successfully!');
    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('teachers.show', compact('teacher'));
    }
}