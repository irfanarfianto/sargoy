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
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $search = $request->get('search');

        $query = User::query();

        // Filter data based on search query
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhereHas('roles', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        }
        
        $query->orderBy($sort, $direction);
        // Fetch the users with roles
        $users = $query->with('roles')->paginate(10);
        $roles = Role::all();

        // Define the breadcrumb items
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'User Management']
        ];

        // Pass users, roles, and breadcrumbs to the view
        return view('dashboard.users.index', compact('users', 'roles', 'breadcrumbs', 'search'));
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
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'roles' => 'required|array', // Ensure roles are provided as an array
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Update the user's name and email
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Sync the user's roles
            $user->syncRoles($request->roles);

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
        try {
            // Temukan pengguna berdasarkan ID
            $user = User::findOrFail($id);

            // Hapus pengguna
            $user->delete();

            // Redirect kembali dengan pesan sukses
            flash()->success('User deleted successfully.');
            return redirect()->route('dashboard.users.index');
        } catch (\Exception $e) {
            // Log the error for debugging
            logger()->error('Failed to delete user. Error message: ' . $e->getMessage());

            // Redirect kembali dengan pesan kesalahan
            flash()->error('Failed to delete user. Error message: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete user. Error message: ' . $e->getMessage()]);
        }
    }
}
