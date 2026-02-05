<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        
        $customers = Customer::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('mobile_no', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(50);
            
        return view('admin.customer.index', compact('customers', 'search'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'mobile_no' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
        ];

        // Handle password
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('customer_photos'), $photoName);
            $data['photo'] = 'customer_photos/' . $photoName;
        }

        Customer::create($data);

        return redirect()->route('admin.customer.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified customer.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $id,
            'mobile_no' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
        ];

        // Handle password
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($customer->photo && file_exists(public_path($customer->photo))) {
                unlink(public_path($customer->photo));
            }

            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('customer_photos'), $photoName);
            $data['photo'] = 'customer_photos/' . $photoName;
        }

        $customer->update($data);

        return redirect()->route('admin.customer.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);

        // Delete photo if exists
        if ($customer->photo && file_exists(public_path($customer->photo))) {
            unlink(public_path($customer->photo));
        }

        $customer->delete();

        return redirect()->route('admin.customer.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
