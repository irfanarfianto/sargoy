<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $roles = Role::all();
        return view('dashboard.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the user
        $user = User::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Update the user's name and email
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Check if roles were provided in the request
            if ($request->has('roles')) {
                // Get the roles assigned to the user
                $assignedRoles = $user->roles->pluck('id')->toArray();

                // Compare the assigned roles with the roles from the request
                $newRoles = array_diff($request->roles, $assignedRoles);
                $removedRoles = array_diff($assignedRoles, $request->roles);

                // Detach roles that were removed
                foreach ($removedRoles as $role) {
                    $user->removeRole($role);
                }

                // Attach new roles
                foreach ($newRoles as $role) {
                    $user->assignRole($role);
                }
            }

            // Commit the transaction
            DB::commit();

            // Redirect back with a success message
            flash()->success('User updated successfully.');
            return redirect()->route('dashboard.users.index');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();

            // Redirect back with an error message
            flash()->error('Failed to update user. Error message: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update user. Error message: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Hapus pengguna
            $user->delete();

            // Commit transaksi database
            DB::commit();

            // Redirect kembali dengan pesan sukses
            flash()->success('User deleted successfully.');
            return redirect()->route('dashboard.users.index');
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollback();

            // Redirect kembali dengan pesan kesalahan
            flash()->error('Failed to delete user. Error message: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete user. Error message: ' . $e->getMessage()]);
        }
    }
}
