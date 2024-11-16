<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\Fee;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    //
    public function index(Request $request)
    {
        $fee_structures = FeeStructure::with('Fee', 'Classes', 'AcademicYear')->orderBy('created_at', 'asc');

        if ($request->has('class_id') && $request->class_id != '') {
            $fee_structures = $fee_structures->where('class_id', $request->class_id);
        }

        if ($request->has('academic_id') && $request->academic_id != '') {
            $fee_structures = $fee_structures->where('academic_id', $request->academic_id);
        }
        $classes = Classes::all();
        $academic_years = AcademicYear::all();
        $fees = Fee::all();

        $fee_structures = $fee_structures->get();
        return view('admin.fee_structure.fee_structure', compact('fee_structures', 'classes', 'academic_years', 'fees'));
    }


    public function create()
    {
        $classes = Classes::all();
        $academic_years =  AcademicYear::all();
        $fees = Fee::all();
        return view('admin.fee_structure.fee_structure_create', compact('classes', 'academic_years', 'fees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'academic_id' => 'required',
            'fee_id' => 'required',
        ]);

        FeeStructure::create($request->all());
        return redirect()->route('fee_structure.index')->with('success', 'Fee created successfully!');
    }

    public function edit($id)
    {
        $fee_structure = FeeStructure::findOrFail($id); // Fetch fee structure by id
        $classes = Classes::all();
        $academic_years = AcademicYear::all();
        $fees = Fee::all();
        return view('admin.fee_structure.fee_structure_edit', compact('fee_structure', 'classes', 'academic_years', 'fees'));
    }

    public function update(Request $request)
    {
        // Find the fee structure by id
        $fee_structure = FeeStructure::findOrFail($request->id);

        // Update fee structure fields
        $fee_structure->class_id = $request->class_id;
        $fee_structure->academic_id = $request->academic_id;
        $fee_structure->fee_id = $request->fee_id;

        // Update each month's fee
        $fee_structure->january = $request->january;
        $fee_structure->february = $request->february;
        $fee_structure->march = $request->march;
        $fee_structure->april = $request->april;
        $fee_structure->may = $request->may;
        $fee_structure->june = $request->june;
        $fee_structure->july = $request->july;
        $fee_structure->august = $request->august;
        $fee_structure->september = $request->september;
        $fee_structure->october = $request->october;
        $fee_structure->november = $request->november;
        $fee_structure->december = $request->december;

        // Save the updated fee structure
        $fee_structure->save();

        // Redirect or return response
        return redirect()->route('fee_structure.index')->with('success', 'Fee structure updated successfully.');
    }

    public function destroy($id)
    {
        $fee_structure = FeeStructure::findOrFail($id);
        $fee_structure->delete();

        return redirect()->route('fee_structure.index')->with('success', 'Fee structure deleted successfully!');
    }
}
