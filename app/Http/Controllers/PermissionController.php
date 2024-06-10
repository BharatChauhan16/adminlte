<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Adduser;
use App\Models\UserProfile;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.permission', [
            'permissions' => $permissions
        ]);
    }

    public function editPermission()
    {
        $permissions = Permission::all();
        return view('permissions.edit_permissions', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Permission::create($request->only('title', 'description'));

        // return redirect()->route('permissions.index');
        return redirect('/add-permission')->with('permission', 'New Permission saved successfully.');
    }
}
