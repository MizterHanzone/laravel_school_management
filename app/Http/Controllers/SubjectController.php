<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subjects = Subject::orderBy('id', 'desc')->get();
        return view('admin.subject.subject', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return view('admin.subject.subject_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->save();

        return redirect()->route('subject.index')->with('success', 'Subject created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $subject = Subject::findOrFail($id);
        return view('admin.subject.subject_edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $subject = Subject::findOrFail($request->id);
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->update();

        return redirect()->route('subject.index')->with('success', 'Subject update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully!');
    }
}
