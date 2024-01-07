<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public $id;
    // function __construct()
    // {
    //     $this->id = Auth()->user()->id;
    // }

    public function editPassword()
    {
        $title      = 'Form Edit Password';

        return view('pages.user.password.index', ['title' => $title]);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password'  => 'required',
            'new_password'  => 'required'
        ]);

        try {
            $user           = User::where('id', auth()->user()->id)->first();
            $oldPassword    = $request->old_password;
            $dbOldPassword  = $user->password;
            $newPassword    = $request->new_password;
            if (Hash::check($oldPassword, $dbOldPassword)) {
                $user->password = bcrypt($newPassword);

                return back()->with('success', 'Password berhasil di update');
            } else {
                return back()->withErrors(['fail_password' => 'Make sure your old password its true']);
            }
        } catch (\Exception $e) {

            return back()->with('failed', $e->getMessage());
        }
    }
}
