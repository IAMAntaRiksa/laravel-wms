<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $datas = User::when(request()->q, function ($users) {
            $users = $users->where('username', 'like', '%' . request()->q . '%');
        })->orderBy('id', 'DESC')->paginate(5);

        return view('page.user.index', compact('datas'));
    }

    public function create()
    {
        $roles = Role::all();
        $logistics = Logistic::all();

        return view("page.user.create", compact('roles', 'logistics'));
    }

    public function store(Request $request)
    {
        $messages = [
            'username.required' => Lang::get('web.username-required'),
            'username.unique' => Lang::get('web.username-unique'),
            'name.required' => Lang::get('web.name-required'),
            'role_id.required' => Lang::get('web.role_id-required'),
            'role_id.integer' => Lang::get('web.role_id-integer'),
            'password.required' => Lang::get('web.password-required'),
            'confirmPassword.required' => Lang::get('web.confirm-password-required'),
            'confirmPassword.same' => Lang::get('web.confirm-password-same'),
            'file.mimes' => Lang::get('web.file-mimes'),
        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'role_id' => 'required|integer',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'file'  => 'nullable|mimes:jpg,png',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.create-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($request->file('file')) {
            $image = $request->file('file');
            $image->storeAs('/public/signatures/', $image->hashName());

            $data = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'logistic_id' => $request->logistic_id,
                'signature_path' => $image->hashName(),
                'role_id' => $request->role_id,
                'api_token' =>  Hash::make(Str::random(40))
            ]);
            $role = Role::find($request->role_id);
            $data->assignRole($role->name);
        } else {
            $data = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'logistic_id' => $request->logistic_id,
                'role_id' => $request->role_id,
                'api_token' =>  Hash::make(Str::random(40))
            ]);
            $role = Role::find($request->role_id);
            $data->assignRole($role->name);
        }

        Session::flash('message', Lang::get('web.create-success'));
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $logistics = Logistic::all();
        return view("page.user.edit", compact('user', 'roles', 'logistics'));
    }


    public function update(Request $request, User $user)
    {
        $messages = [
            'username.required' => Lang::get('web.username-required'),
            'name.required' => Lang::get('web.name-required'),
            'role_id.integer' => Lang::get('web.role_id-integer'),
            'confirmPassword.same' => Lang::get('web.confirm-password-same'),
            'file.mimes' => Lang::get('web.file-mimes'),
        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'role_id' => 'integer',
            'confirmPassword' => 'same:password',
            'file'  => 'nullable|mimes:jpg,png',
        ], $messages);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('web.update-failed'));
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // update password
        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }
        /// update image 
        if ($request->file('file')) {
            Storage::disk('local')->delete('/public/signatures/' . basename($user->signature_path));

            $image = $request->file('file');
            $image->storeAs('/public/signatures/', $image->hashName());

            $user->update([
                'signature_path' => $image->hashName(),
            ]);
        }

        try {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'logistic_id' => $request->logistic_id,
                'role_id' => $request->role_id,
            ]);
            $user->roles()->sync([$request->role_id]);
        } catch (\Exception $errors) {
            return redirect()->back()
                ->withInput()->withErrors(['message' => Lang::get('web.update-failed')]);
        }
        Session::flash('message', Lang::get('web.update-success'));
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        try {
            Storage::disk('local')->delete('/public/signatures/' . basename($user->signature_path));
            $user->delete();
        } catch (\Exception $errors) {
            return redirect()->route('user.index')->withErrors(['message' => Lang::get('web.delete-failed')]);
        }

        Session::flash('message', Lang::get('web.delete-success'));
        return redirect()->route('user.index');
    }
}