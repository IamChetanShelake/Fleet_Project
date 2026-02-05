<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use Illuminate\Support\Facades\Validator;

class FranchiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $franchises = Franchise::where('is_active', true)->get();
        return view('franchises.index', compact('franchises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('franchises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_name' => 'required|string|max:255',
            'currency' => 'required|string|max:10',
            'has_tax' => 'required|in:yes,no',
            'tax_percentage' => 'required_if:has_tax,yes|nullable|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'country_name' => $request->country_name,
            'currency' => $request->currency,
            'has_tax' => $request->has_tax === 'yes',
            'tax_percentage' => $request->has_tax === 'yes' ? $request->tax_percentage : 0.00,
            'is_active' => true
        ];

        Franchise::create($data);

        return redirect()->route('franchises.index')->with('success', 'Franchise created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        return view('franchises.show', compact('franchise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        return view('franchises.edit', compact('franchise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $franchise = Franchise::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'country_name' => 'required|string|max:255',
            'currency' => 'required|string|max:10',
            'has_tax' => 'required|in:yes,no',
            'tax_percentage' => 'required_if:has_tax,yes|nullable|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'country_name' => $request->country_name,
            'currency' => $request->currency,
            'has_tax' => $request->has_tax === 'yes',
            'tax_percentage' => $request->has_tax === 'yes' ? $request->tax_percentage : 0.00,
        ];

        $franchise->update($data);

        return redirect()->route('franchises.index')->with('success', 'Franchise updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        $franchise->delete();

        return redirect()->route('franchises.index')->with('success', 'Franchise deleted successfully.');
    }

    /**
     * Redirect to login page for selected franchise
     */
    public function login(string $id)
    {
        $franchise = Franchise::findOrFail($id);
        session(['selected_franchise_id' => $franchise->id]);
        return redirect()->route('login')->with('franchise', $franchise);
    }
}
