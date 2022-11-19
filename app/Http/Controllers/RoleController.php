<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $datas = Role::with('permissions')->when(request()->q, function ($roles) {
            $roles = $roles->where('name', 'like', '%' . request()->q . '%');
        })->orderBy('id', 'DESC')->paginate(5);

        return view('page.role.index',  compact('datas'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('page.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $message = [
            'name.required' => Lang::get('web.name-required'),
            'permission.required' => Lang::get('web.permission-required')
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'required'
        ], $message);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.create-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }


        try {
            $role = Role::create([
                'name' => $request->name,
            ]);
            $role->syncPermissions($request->permission);
        } catch (\Exception $errors) {
            return redirect()->back()->withInput()->withErrors(['message' => Lang::get('web.create-failed')]);
        }

        Session::flash('message', Lang::get('web.create-success'));
        return redirect()->route('role.index');
    }

    public function edit(Role $role)
    {
        $permission = Permission::all();
        return view('page.role.edit', compact('role', 'permission'));
    }

    public function update(Request $request, Role $role)
    {
        $message = [
            'name.required' => Lang::get('web.name-required'),
            'permission.required' => Lang::get('web.permission-required')
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'permission' => 'required'
            ],
            $message
        );

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.update-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            $role->update([
                'name' => $request->name,
                'permission' => $request->permission
            ]);
            $role->syncPermissions($request->permission);
        } catch (\Exception $errors) {
            return redirect()->back()->withInput()->withErrors(['message' => Lang::get('web.create-failed')]);
        }

        Session::flash('message', Lang::get('web.update-success'));
        return redirect()->route('role.index');
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
        } catch (\Exception $errors) {
            return redirect()->route('role.index')->withErrors(['message' => Lang::get('web.delete-failed')]);
        }

        Session::flash('message', Lang::get('web.delete-success'));
        return redirect()->route('role.index');
    }
}