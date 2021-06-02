<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['profile'])->paginate(15);
        return view('pages.admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->profile->delete();
        $user->delete();
        return redirect()->route('users.index')->with('message', 'Successfully deleted');
    }

}
