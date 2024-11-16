<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    //
    public function index()
    {
        $classes = Classes::orderBy('id', 'desc')->get();
        return view('admin.classes.class', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.class_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $classes = new Classes();
        $classes->name = $request->name;
        $classes->save();
        return redirect()->route('class.index')->with('success', 'Class created successfully!');
    }

    public function edit($id)
    {
        $classes = Classes::findOrFail($id);
        return view('admin.classes.class_edit', compact('classes'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $classes = Classes::findOrFail($request->id);
        $classes->name = $request->name;
        $classes->save();
        return redirect()->route('class.index')->with('success', 'class updated successfully!');
    }
    

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('class.index')->with('success', 'Class deleted successfully!');
    }
}
