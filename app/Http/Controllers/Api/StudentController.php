<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json(['success' => true, 'data' => $students]);
    }
    public function store(Request $request)
    {
        $student = Student::create($request->all());
        return response()->json(['success' => true, 'message' => 'Student added successfully', 'data' => $student], 201);
    }
    
    public function destroy($id) {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }
        $student->delete();
        return response()->json(['success' => true, 'message' => 'Student deleted successfully']);
    }
    
    public function update(Request $request, $id) {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }
        $student->update($request->all());
        return response()->json(['success' => true, 'message' => 'Student updated successfully', 'data' => $student]);
    }

}
