<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:member')->except('logout');
    }

    public function formAdminLogin()
    {
        return view('pages.auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('admin-index')->with('success', 'Hi..Admin');

        }
        return back()->withInput($request->only('username', 'remember'));
    }

    public function formMemberLogin()
    {
        return view('pages.auth.member-login');
    }

    public function memberLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);

        

        if (Auth::guard('member')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('member-index');

        }
        return back()->withInput($request->only('username', 'remember'))->with('error', 'Username or Wrong Password');
    }

    public function logout(Request $request){
        if(Auth::guard('admin')->check()) 
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin-login');
        } else if(Auth::guard('member')->check()) 
        {
            Auth::guard('member')->logout();
            return redirect()->route('member-login');
        }
        
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('admin-login');
        
    }
    
}
