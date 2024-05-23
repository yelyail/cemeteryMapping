<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;

class CusAuthController extends Controller
{
    public function logIn(){
        return view('auth.login');
    }
    public function storelogIn(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::where('contactEmail', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('signinID', $user->staffID);
            return redirect()->route('home');
        } else {
            $this->showAlert('error', 'Error!', 'Email or password is incorrect. Please try again.');
            return back();
        }
    }
    public function registration(){
        return view('auth.register');
    }
    public function storeRegister(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'role' => ['required', 'string', 'max:255'],
                'contactNumber' => ['required', 'string', 'max:255'],
                'contactEmail' => ['required', 'string', 'email', 'max:255', 'unique:tblstaff,contactEmail'],
                'passRecQues' => ['required', 'string', 'max:255'],
                'passRecAns' => ['required', 'string', 'max:255'],
                'password' => ['required','min:8', 'confirmed',Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'role' => $request->role, 
                'contactNum' => $request->contactNumber, 
                'contactEmail' => $request->contactEmail, 
                'passRecQues' => $request->passRecQues,
                'passRecAns' => $request->passRecAns,
                'password' => Hash::make($request->password), 
            ]);

            event(new Registered($user));
            return redirect()->route('register')->with('success', 'Successfully'); 
        } catch(\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
    public function logout(){

        if(Session::has('signinID')){
            Session::pull('signinID');
        }
        return redirect()->route('signin');

    }
    public function forgPass(){
        return view('auth.forgot-password');
    }
    public function forgPassStore(Request $request){
        $request->validate([
            'email' => ['required', 'email', 'exists:tblstaff,contactEmail'],
            'passRecQues' => ['required', 'string'],
            'passRecAns' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::where('contactEmail', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found.']);
        }
        if ($user->passRecQues !== $request->passRecQues) {
            return redirect()->back()->withErrors(['passRecQues' => 'The provided question does not match our records.']);
        }
        if (!Hash::check($request->passRecAns, $user->passRecAns)) {
            return redirect()->back()->withErrors(['passRecAns' => 'The provided answer does not match our records.']);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        self::showAlert('success', 'Password Reset Successful', 'Your password has been reset successfully.');
        return redirect()->route('signin');
    }
    
    public static function showAlert($icon, $title, $text) {
        Session::flash('alertShow',true);
        Session::flash('icon',$icon);
        Session::flash('title',$title);
        Session::flash('text',$text);
    }

}