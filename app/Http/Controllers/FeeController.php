<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    //
    public function index()
    {
        $fees = Fee::orderBy('created_at', 'desc')->get();
        return view('admin.fee.fee', compact('fees'));
    }

    public function create()
    {
        return view('admin.fee.fee_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $fee = new Fee();
        $fee->name = $request->name;
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Fee created successfully!');
    }

    public function edit($id)
    {
        $fees = Fee::findOrFail($id);
        return view('admin.fee.fee_edit', compact('fees'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $fee = Fee::findOrFail($request->id);
        $fee->name = $request->name;
        $fee->save();

        return redirect()->route('fee.index')->with('success', 'Fee updated successfully!');
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete();

        return redirect()->route('fee.index')->with('success', 'Fee deleted successfully!');
    }
}
