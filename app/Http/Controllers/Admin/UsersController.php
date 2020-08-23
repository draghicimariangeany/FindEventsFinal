<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UsersController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->withUsers($users);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-users')){

            return redirect()->route('admin.users.index');

        }

        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){

            return redirect()->route('admin.users.index');

        }

        $user->roles()->detach();
        $user->delete();


        return redirect()->route('admin.users.index');
    }
}
