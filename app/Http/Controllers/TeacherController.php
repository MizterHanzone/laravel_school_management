<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //
    public function index()
    {
        $teachers = User::orderBy('id', 'desc')->where('role', 'teacher')->get();
        return view('admin.teacher.teacher', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teacher.teacher_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required|date',
            'phone' => 'required|numeric',
        ]);

        $teacher = new User();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
        $teacher->father_name = $request->father_name;
        $teacher->mother_name = $request->mother_name;
        $teacher->dob = $request->dob;
        $teacher->phone = $request->phone;
        $teacher->role = 'teacher';
        $teacher->save();

        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully!');
    }

    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        return view('admin.teacher.teacher_edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id, // Ensure email is unique except for current user
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required|date',
            'phone' => 'required|numeric',
        ]);

        $teacher = User::findOrFail($id); // Fetch the teacher by ID
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->father_name = $request->father_name;
        $teacher->mother_name = $request->mother_name;
        $teacher->dob = $request->dob;
        $teacher->phone = $request->phone;
        $teacher->save(); // Save the updated record

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy($id)
    {
        $teachers = User::findOrFail($id);
        $teachers->delete();

        return redirect()->route('teacher.index')->with('success', 'Student deleted successfully!');
    }
}
