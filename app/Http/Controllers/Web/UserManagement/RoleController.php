<?php

namespace App\Http\Controllers\Web\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderby('id')->paginate(10);
        return view('Layouts.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('Layouts.roles.show', compact('role', 'rolePermissions'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('Layouts.roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with($validator->errors());
        }
        $role = Role::create(['name' => $request['name']]);
        $role->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with('msg', 'Roles Created Done!');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $allPermissions = Permission::get();
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_has_permissions', $id)->pluck('role_has_permissions.permission_id')->get();
        return view('Layouts.roles.edit', compact('role', 'rolePermissions', 'allPermissions'));
    }

    public function update(Request $request, $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $role->id,
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with($validator->errors());
        }
        $role->name = $request->name;
        $role->update();

        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index')->with('msg','Update Done');
    }

    public function delete($id)
    {
        Role::destroy($id);
        return back()->with('msg', 'Deleted Done');
    }
}
