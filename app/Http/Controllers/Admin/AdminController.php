<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('owner');
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('admin', 1)->whereNotIn('id', [Auth::user()->id])->orderBy('id', 'desc')->paginate(15);
        return view('admin.admins.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(UserRequest $request, User $model)
    {

        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('admins.index')->withStatus(__('Admin successfully created.'));
    }

    public function edit(User $admin)
    {
        return view('admin.admins.edit')->with(['user' => $admin]);
    }

    public function update(Request $request, User $admin)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|string|min:5|max:30',
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed',
        ];

        $this->validate($request, $rules);

        $admin->update(
            $request->merge(['password' => Hash::make($request->get('password'))])->except([$request->get('password') ? '' : 'password'])
        );

        return redirect()->route('admins.index')->withStatus(__('Admin successfully updated.'));
    }

    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admins.index')->withStatus(__('Admin successfully deleted.'));
    }
}
