<?php

namespace App\Http\Controllers\cms;

use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        if (!is_null(\request('search'))) {
            $terms = explode(' ', \request('search'));
            $columns = ['id', 'email'];

            $query = null;

            foreach ($terms as $term) {
                foreach ($columns as $column) {
                    if (is_null($query)) {
                        $query = User::where($column, 'LIKE', '%' . $term . '%');
                    } else {
                        $query->orWhere($column, 'LIKE', '%' . $term . '%');
                    }
                }
            }
            $users = $query->with('roles')->paginate();
        } else {
            $users = User::with('roles')->paginate();
        }

        return view('cms.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::all();

        return view('cms.users.create', [
            'roles' => $roles
        ]);
    }

    public function show($id)
    {
        $roles = Role::all();
        $user = User::query()->findOrFail($id);

        return view('cms.users.update', [
            'roles' => $roles,
            'user'  => $user
        ]);
    }

    public function update($id)
    {
        $user = User::query()->findOrFail($id);

        $user->update([
            'name'     => \request('name'),
            'email'    => \request('email'),
            'password' => !is_null(\request('password')) ? Hash::make(\request('password')) : Hash::make($user->password)
        ]);

        $user->roles()->detach();

        if (\request('roles')) {
            $user->attachRoles(\request('roles'));
        }
        return redirect('/admin/users');
    }


    public function store()
    {
        $user = User::query()->create([
            'name'     => \request('name'),
            'email'    => \request('email'),
            'password' => Hash::make(\request('password'))
        ]);

        if (\request('roles')) {
            $user->attachRoles(\request('roles'));
        }
        return redirect('/admin/users');
    }

    public function login(Request $request)
    {
        if ($request->user() && count($request->user()->roles()->get())) {
            return redirect('admin/home');
        } elseif ($request->user()) {
            Auth::logout();
            return view('cms.auth.login');
        }
        return view('cms.auth.login');
    }

    public function verification(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::query()->where('email', '=', $credentials['email'])->first();

        if (count($user->roles()->get())) {
            if (Auth::attempt($credentials)) {
                return redirect('admin');
            }
        }
        return redirect()->back()->withErrors(['verificationError' => 'Email or password is incorrect']);
    }

    public function logOut()
    {
        Auth::logout();

        return redirect('/admin/login');
    }
}
