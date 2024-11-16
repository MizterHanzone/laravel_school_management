<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //
    public function index(Request $request)
    {
        $classes = Classes::all();
        $academic_years = AcademicYear::all();

        $students = User::with(['Classes', 'AcademicYear'])
            ->where('role', 'student')  // Filter by 'student' role
            ->when($request->class_id, function ($query) use ($request) {
                return $query->where('class_id', $request->class_id);
            })
            ->when($request->academic_id, function ($query) use ($request) {
                return $query->where('academic_id', $request->academic_id);
            })
            ->orderBy('created_at', 'desc')->get();;

        return view('admin.student.student', compact('students', 'classes', 'academic_years'));
    }



    public function create()
    {
        $classes = Classes::all();
        $academic_years =  AcademicYear::all();
        return view('admin.student.student_create', compact('classes', 'academic_years'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'admission_date' => 'required|date',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required|date',
            'phone' => 'required|numeric',
            'class_id' => 'required',
            'academic_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->admission_date = $request->admission_date;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->class_id = $request->class_id;
        $user->academic_id = $request->academic_id;
        $user->save();

        return redirect()->route('student.index')->with('success', 'Student created successfully!');
    }

    public function edit($id)
    {
        $students = User::findOrFail($id);
        $classes = Classes::all();
        $academic_years = AcademicYear::all();
        return view('admin.student.student_edit', compact('students', 'classes', 'academic_years'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'admission_date' => 'required|date',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|numeric',
            'class_id' => 'required',
            'academic_id' => 'required',
        ]);

        $student = User::findOrFail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        // If password needs to be updated, uncomment this line:
        // $student->password = Hash::make($request->password);
        $student->admission_date = $request->admission_date;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->dob = $request->dob;
        $student->phone = $request->phone;
        $student->class_id = $request->class_id;
        $student->academic_id = $request->academic_id;

        $student->update(); // Use save() instead of update() on the model instance

        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }


    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }
}
