<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class StudentController extends Controller
{
    // public function index() { 
    //     $students = Student::all(); 
    //     return view('students.index', compact('students'));
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhere('city', 'like', "%$search%")
            ->paginate(5);

        return view('students.index', compact('students', 'search'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }


    //     public function store(Request $request) { 

    //         $request->validate([ 'name' => 'required', 'email' => 'required|email|unique:students,email', 'phone' => 'required', 'city' => 'required', ]);

    //         Student::create([ 'name' => $request->name, 'email' => $request->email,
    //           'phone' => $request->phone, 'city' => $request->city, ]);

    //          return redirect('/students')->with('success', 'Student added successfully!'); 
    //    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'city' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photo = $request->file('photo')->store('students', 'public');

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'photo' => $photo,
        ]);

        return redirect('/students')->with('success', 'Student added successfully!');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $courses = Course::all();

        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required',
            'city' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $student = Student::findOrFail($id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
        ];

        if ($request->hasFile('photo')) {
            if ($student->photo && file_exists(storage_path('app/public/' . $student->photo))) {
                unlink(storage_path('app/public/' . $student->photo));
            }

            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($data);

        $student->courses()->sync($request->courses ?? []);

        if ($request->from == 'dashboard') {
            return redirect('/dashboard')->with('success', 'Student updated successfully!');
        }

        return redirect('/students')->with('success', 'Student updated successfully!');
    }


    //   public function destroy($id) {
    //      $student = Student::findOrFail($id);
    //       $student->delete(); 
    //       return redirect('/students')->with( 'success', 'Student deleted successfully!' );
    //   }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if ($student->photo && file_exists(storage_path('app/public/' . $student->photo))) {
            unlink(storage_path('app/public/' . $student->photo));
        }

        $student->delete();

        return redirect('/students')->with('success', 'Student deleted successfully!');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('students.show', compact('student'));
    }


    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalCourses = Course::count();
        $latestStudents = Student::with('courses')->latest()->take(10)->get();

        return view('students.dashboard', compact(
            'totalStudents',
            'totalCourses',
            'latestStudents'
        ));
    }
}
