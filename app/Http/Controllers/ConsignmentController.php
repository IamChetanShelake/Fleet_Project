<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;

class ConsignmentController extends Controller
{
    /**
     * Display a listing of the resource (Consignment Listing).
     */
    public function index()
    {
        $transports = Transport::orderBy('created_at', 'desc')->get();
        return view('admin.consignment.index', compact('transports'));
    }

    /**
     * Display the specified resource (View Details).
     */
    public function show(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        return view('admin.new-consignment.show', compact('transport'));
    }

    /**
     * Show the form for editing the specified resource (Continue Editing from Listing).
     */
    public function edit(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        // Store transport ID in session for the multi-step edit flow
        session(['transport_id' => $transport->id]);

        // Redirect to appropriate step based on status
        switch ($transport->status) {
            case 'draft':
                return redirect()->route('admin.new-consignment.create');
            case 'assigned':
                return redirect()->route('admin.freight-assignment.index');
            case 'confirmed':
                return redirect()->route('admin.charges-advance.index');
            default:
                return redirect()->route('admin.new-consignment.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->route('admin.consignment.index')->with('error', 'Consignment not found.');
        }

        $transport->delete();

        return redirect()->route('admin.consignment.index')->with('success', 'Consignment deleted successfully.');
    }
}
