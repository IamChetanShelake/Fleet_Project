<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamMembers = User::with('role')
                          ->whereNotNull('role_id')
                          ->where('email', '!=', 'adminqwikhom@gmail.com') // Exclude system admin
                          ->get();
        return view('admin.team-members.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team-members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'mobile' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'date_of_joining' => 'nullable|date',
            'status' => 'required|in:Active,Inactive',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only([
            'name', 'email', 'mobile', 'role_id', 'department',
            'position', 'date_of_joining', 'status'
        ]);

        // Hash the password
        $data['password'] = bcrypt($request->password);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_images'), $filename);
            $data['profile_image'] = 'profile_images/' . $filename;
        }

        User::create($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member created successfully.');
    }

    /**
     * Toggle the status of a team member.
     */
    public function toggleStatus(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Active,Inactive'
        ]);

        $user->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teamMember = User::with('role')->findOrFail($id);
        return view('admin.team-members.show', compact('teamMember'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teamMember = User::with('role')->findOrFail($id);
        return view('admin.team-members.edit', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'mobile' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'date_of_joining' => 'nullable|date',
            'status' => 'required|in:Active,Inactive',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only([
            'name', 'email', 'mobile', 'role_id', 'department',
            'position', 'date_of_joining', 'status'
        ]);

        // Hash the password only if provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old file if exists
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_images'), $filename);
            $data['profile_image'] = 'profile_images/' . $filename;
        }

        $user->update($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete profile image if exists
        if ($user->profile_image && file_exists(public_path($user->profile_image))) {
            unlink(public_path($user->profile_image));
        }

        $user->delete();

        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted successfully.');
    }
}
