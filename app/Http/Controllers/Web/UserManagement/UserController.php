<?php

namespace App\Http\Controllers\Web\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    $roles = '';
                    foreach ($user->getRoleNames() as $role) {
                        $roles .= '<label>' . $role . '</label><br>';
                    }
                    return $roles;
                })
                ->addColumn('action', function ($user) {
                    $btn = '<a href="' . route('users.show', $user) . '" href="javascript:void(0)" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $btn .= '<a href="' . route('users.edit', $user->id) . '" href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn .= '
                    <form style="display:inline" action="' . route('users.destroy', $user->id) . '" method="POST">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are You Sure Want to Delete?\')">
                      <i class="fas fa-trash-alt"></i>
                       </button>
                   </form>
                ';

                    return $btn;
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }
        return view('Layouts.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('Layouts.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:confirm-password',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
            ]
        ));
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('Layouts.users.show',
            compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->getRoleNames();

        return view('Layouts.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');

    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();
        return back()->with('message', 'User deleted.');
    }


}
