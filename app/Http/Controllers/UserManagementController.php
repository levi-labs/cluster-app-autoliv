<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar User';
        $data       = User::all();

        return view('pages.user.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title      = 'Form Add User';
        return view('pages.user.add', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'  => 'required',
            'nama'      => 'required',
            'password'  => 'required',
            'level'     => 'required'
        ]);

        try {
            $user           = new User();
            $user->username = $request->username;
            $user->nama     = $request->nama;
            $user->level    = $request->level;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect('user-management/index')->with('success', 'User berhasil di tambah');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title      = 'Form Edit User';
        $data       = User::where('id', $user->id)->first();

        return view('pages.user.edit', ['title' => $title, 'user' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username'  => 'required',
            'nama'      => 'required',
            'level'     => 'required'
        ]);

        try {
            $data           = User::where('id', $user->id)->first();
            $data->username = $request->username;
            $data->nama     = $request->nama;
            $data->level    = $request->level;
            $data->save();

            return redirect('user-management/index')->with('success', 'User berhasil di update');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $data           = User::where('id', $user->id)->first();
            $data->delete();

            return back()->with('success', 'User berhasil di delete');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function resetPassword(User $user)
    {
        try {
            $user           = User::where('id', $user->id)->first();
            $user->password = bcrypt('password');

            return back()->with('success', 'Password User ' . $user->username . ' Berhasil di reset (password)');
        } catch (\Throwable $e) {
            return back()->with('failed', $e->getMessage());
        }
    }
}
