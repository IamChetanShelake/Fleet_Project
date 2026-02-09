<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CargoType;

class cargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $CargoTypes = CargoType::all();
        return view('admin.cargoTypes.index', compact('CargoTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cargoTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cargo_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            // dd('cc');
        $cargoType = new CargoType();
        $cargoType->title = $request->input('cargo_name');
        $cargoType->description = $request->input('cargo_description');
        // $cargoType->default_value = $request->input('default_value');

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = 'cargo'.$cargoType->id.'_'.uniqid().'.'. $file->getClientOriginalExtension();
            $file->move('assets/cargoImages', $fileName);

            $imagePath = 'assets/cargoImages/' . $fileName;
            $cargoType->image = $imagePath;
        }

        $cargoType->save();

        return redirect()->route('admin.cargoTypes.index')->with('success', 'Cargo Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cargotype = CargoType::find($id);
        return redirect()->route('admin.cargoTypes.show',compact('cargotype'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $cargotype = CargoType::find($id);
         return view('admin.cargoTypes.edit', compact('cargotype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cargo_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $cargoType = CargoType::find($id);
        $cargoType->title = $request->input('cargo_name');
        $cargoType->description = $request->input('description');
        // $cargoType->default_value = $request->input('default_value');

        if ($request->hasFile('image')) {

        //old image
        if ($cargoType->image && file_exists($cargoType->image)) {
            unlink($cargoType->image);
        }

            $file = $request->file('image');

            $fileName = 'cargo'.$cargoType->id.'_'.uniqid().'.'. $file->getClientOriginalExtension();
            $file->move('assets/cargoImages', $fileName);

            $imagePath = 'assets/cargoImages/' . $fileName;
            $cargoType->image = $imagePath;
        }

        $cargoType->save();

        return redirect()->route('admin.cargoTypes.index')->with('success', 'Cargo Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $cargoType = CargoType::find($id);
        if ($cargoType->image && file_exists($cargoType->image)) {
            unlink($cargoType->image);
        }
        $cargoType->delete();
        return redirect()->route('admin.cargoTypes.index')->with('success', 'Cargo Type deleted successfully.');
    }
}
