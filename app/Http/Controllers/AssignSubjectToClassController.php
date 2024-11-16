<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assign_subjects = AssignSubjectToClass::with(['class', 'subject']);
        if ($request->has('class_id') && $request->class_id != '') {
            $assign_subjects = $assign_subjects->where('class_id', $request->class_id);
        }
        if ($request->has('subject_id') && $request->subject_id != '') {
            $assign_subjects = $assign_subjects->where('subject_id', $request->subject_id);
        }
        $assign_subjects = $assign_subjects->get();
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.assign_subject.assign_subject', compact('assign_subjects', 'classes', 'subjects'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.assign_subject.assign_subject_create', compact('classes', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        // dd($request->all());
        foreach ($subject_id as $subject_id) {
            AssignSubjectToClass::updateOrCreate(
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                ],
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                ],
            );
        }
        return redirect()->route('assign_subject.index')->with('success', 'Assign subject to class successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $classes = Classes::all(); // Fetch all classes
        $subjects = Subject::all(); // Fetch all subjects
        $assign_subjects = AssignSubjectToClass::findOrFail($id); // Fetch the specific assignment

        // Get the IDs of the subjects already assigned to the class
        // $assigned_subject_ids = $assign_subjects->subjects->pluck('id')->toArray();

        return view('admin.assign_subject.assign_subject_edit', compact('assign_subjects', 'classes', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);
        $assign_subjects = AssignSubjectToClass::findOrFail($request->id);
        $assign_subjects->class_id = $request->class_id;
        $assign_subjects->subject_id = $request->subject_id;
        $assign_subjects->save();

        return redirect()->route('assign_subject.index')->with('success', 'Assign subject to class updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $assign_subject = AssignSubjectToClass::findOrFail($id);
        $assign_subject->delete();

        return redirect()->route('assign_subject.index')->with('success', 'Assign subject to class deleted successfully!');
    }
}
