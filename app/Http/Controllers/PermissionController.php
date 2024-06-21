<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\UserPermission;
use App\Models\Adduser;
use App\Models\User;
use App\Models\UserProfile;
use Auth;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.permission', [
            'permissions' => $permissions
        ]);
    }

    public function editPermission($id)
{
    $user = User::findOrFail($id);
    $permissions = Permission::all()->groupBy('type');
    return view('permissions.edit_permissions', [
        'permissions' => $permissions,
        'user' => $user
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
                'type' => 'required|string',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
        ]);

        Permission::create($request->all());
        // dd($request->all());
        // return redirect()->route('permissions.index');
        return redirect('/add-permission')->with('permission', 'New Permission saved successfully.');
    }

    public function savePermission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $userId = $request->input('user_id');
        $permissions = $request->input('permissions');

        // Delete old permissions
        UserPermission::where('user_id', $userId)->delete();

        // Assign new permissions
        foreach ($permissions as $permissionId) {
            UserPermission::create([
                'user_id' => $userId,
                'permission_id' => $permissionId,
            ]);
        }

        return redirect('/admin/users');
    }
}
