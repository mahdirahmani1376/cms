<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view('admin.users.index',['users' => $users]);
    }

    public function show(User $user){
        return view('admin.users.profile',['user'=>$user]);
    }

    public function update(User $user){

        $inputs = request()->validate([
            'name' => 'string|max:255',
            'email' => 'string|max:255',
            'avatar' => 'file',
//            'password' => 'min:6|max:255|confirmed',
        ]);

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);

        return back();

    }

    public function destroy(User $user){
        $user->delete();

        session()->flash('user-deleted','user has been deleted');

        return back();
    }

}
