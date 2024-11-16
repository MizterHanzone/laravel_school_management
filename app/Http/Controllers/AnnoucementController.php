<?php

namespace App\Http\Controllers;

use App\Models\Annoucement;
use Illuminate\Http\Request;

class AnnoucementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $annoucements = Annoucement::orderBy('created_at', 'desc')->get();
        return view('admin.annoucement.annoucement', compact('annoucements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.annoucement.annoucement_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'message' => 'required',
            'type' => 'required',
        ]);
        $annoucement = new Annoucement();
        $annoucement->message = $request->message;
        $annoucement->type = $request->type;
        $annoucement->save();

        return redirect()->route('annoucement.index')->with('success', 'Annoucement send successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $annoucements = Annoucement::findOrFail($id);
        return view('admin.annoucement.annoucement_edit', compact('annoucements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'message' => 'required',
            'type' => 'required',
        ]);
        $annoucements = Annoucement::findOrFail($request->id);
        $annoucements->message = $request->message;
        $annoucements->type = $request->type;
        $annoucements->update();
        
        return redirect()->route('annoucement.index')->with('success', 'Annoucement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $annoucement = Annoucement::findOrFail($id);
        $annoucement->delete();

        return redirect()->route('annoucement.index')->with('success', 'Annoucement deleted successfully!');
    }
}
