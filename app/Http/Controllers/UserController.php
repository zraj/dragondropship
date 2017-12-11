<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserType;
use App\User;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth')->except('login','index');
    }

    public function index()
    {
        return view('user.login');
    }

    public function create(){
        $types = UserType::orderBy('type_name')->get();
        return view('user.create',compact('types'));
    }


    public function registration(){
    //  dd(request());
      try {
        $user =   User::create([
           'name' => request('name'),
           'username'=>request('username'),
           'user_type'=>request('user_type'),
           'email'=>request('email'),
           'password'=>bcrypt('1234')
        ]);
        return redirect('/listuser');
      } catch (Exception $e) {
        return back()->withErrors(['Error create user']);
      }



    }

    public function listuser(){
      $users = User::orderby('name')->get();

      return view('user.list',compact('users'));
    }

    public function login()
    {
      //  dd(request());
        if(! auth()->attempt(request(['username','password']))){
            return back()->withErrors([
                'message' =>  'Please check your username or password.'
            ]);
        }

        $message = 'Welcome '.auth()->user()->name;
       // dd($message);
        session()->flash('message',$message);
        return redirect('/dash');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function profile(){

        return view('user.profile');
    }

    public function viewprofile(User $user)
    {
       return view('user.viewprofile',compact('user'));
    }
}
