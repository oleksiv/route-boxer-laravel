<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = User::paginate();
        return view('user.index', compact('models'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'required|array|min:1',
        ]);

        $model = new User();
        $model->name = $request->input('name');
        $model->email = $request->input('email');
        $model->password = bcrypt($request->input('password'));
        $model->save();

        // Sync roles
        $model->roles()->sync($request->input('roles'));

        return redirect('/users/' . $model->getKey());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $model = User::where(['id' => $id])->with('roles')->first();
        return view('user.show', compact('model'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $roles = Role::all();
        $model = User::where(['id' => $id])->with('roles')->first();
        return view('user.update', compact('model', 'roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'required|array|min:1',
        ], [], [
            'roles.admin' => 'Admin role'
        ]);

        // Find user
        $model = User::find($id);

        // Admin user can't remove his role
        $validator->sometimes('roles.admin', 'required', function ($input) use ($model) {
            return $model->hasRole('admin');
        });

        // Redirect on validation failure
        if($validator->fails()) {
            return redirect('/users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        // Set user fields
        $model->name = $request->input('name');
        $model->email = $request->input('email');

        // Set password only if it's defined
        if($request->has('password')) {
            $model->password = bcrypt($request->input('password'));
        }

        $model->save();

        // Sync roles array
        $model->roles()->sync($request->input('roles'));

        return redirect('/users/' . $model->getKey())->with('status', 'Model updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $model = User::find($id);
        $model->delete();

        return redirect('/users')->with('status', 'User deleted!');
    }
}
