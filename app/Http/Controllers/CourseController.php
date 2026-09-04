<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $courses = Course::where('name', 'like', "%$search%")->paginate(5);

        return view('courses.index', compact('courses', 'search'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|string|max:100',
            'fee' => 'required|numeric|min:0',
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'fee' => $request->fee,
        ]);

        return redirect('/courses')->with('success', 'Course added successfully!');
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect('/courses');
        }

        $course->delete();

        return redirect('/courses')->with('success', 'Course deleted successfully!');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|string|max:100',
            'fee' => 'required|numeric|min:0',
        ]);

        $course = Course::findOrFail($id);

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'fee' => $request->fee,
        ]);

        return redirect('/courses')->with('success', 'Course updated successfully!');
    }

    public function show($id)
    {
        $course = Course::with('students')->findOrFail($id);

        return view('courses.show', compact('course'));
    }
}