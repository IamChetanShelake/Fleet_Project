<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewConsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.new-consignment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.new-consignment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.new-consignment.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.new-consignment.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show the freight assignment form.
     */
    public function freightAssignment()
    {
        return view('admin.new-consignment.freight-assignment');
    }

    /**
     * Store freight assignment data.
     */
    public function storeFreightAssignment(Request $request)
    {
        // Validation and processing logic here
        // For now, redirect to next step
        return redirect()->route('admin.charges-advance.index');
    }

    /**
     * Show the charges & advance form.
     */
    public function chargesAdvance()
    {
        return view('admin.new-consignment.charges-advance');
    }

    /**
     * Store charges & advance data.
     */
    public function storeChargesAdvance(Request $request)
    {
        // Validation and processing logic here
        // For now, redirect to final step
        return redirect()->route('admin.booking-confirmed.index');
    }

    /**
     * Show the booking confirmed page.
     */
    public function bookingConfirmed()
    {
        return view('admin.new-consignment.booking-confirmed');
    }
}
