<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    //
    public function index()
    {
        $academic_years = AcademicYear::orderBy('created_at', 'desc')->get();
        return view('admin.academic_year.academic_year', compact('academic_years'));
    }

    public function create()
    {
        return view('admin.academic_year.academic_year_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $acdemic_year = new AcademicYear();
        $acdemic_year->name = $request->name;
        $acdemic_year->save();
        return redirect()->route('academic_year.index')->with('success', 'Academic Year created successfully!');
    }

    public function edit($id)
    {
        $academic_year = AcademicYear::findOrFail($id);
        return view('admin.academic_year.academic_year_edit', compact('academic_year'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $academic_year = AcademicYear::findOrFail($request->id);
        $academic_year->name = $request->name;
        $academic_year->save();
        return redirect()->route('academic_year.index')->with('success', 'Academic Year updated successfully!');
    }


    public function destroy($id)
    {
        $academic_year = AcademicYear::findOrFail($id);
        $academic_year->delete();

        return redirect()->route('academic_year.index')->with('success', 'Academic Year deleted successfully');
    }
}
