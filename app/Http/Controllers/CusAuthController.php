<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
                'password' => ['required','min:8', 'confirmed',Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'role' => $request->role, 
                'contactNum' => $request->contactNumber, 
                'contactEmail' => $request->contactEmail, 
                'password' => Hash::make($request->password), 
            ]);

            event(new Registered($user));

            // Log successful registration
            Log::info('User registered successfully');

            return redirect()->route('register')->with('success', 'borit'); 
        } catch(\Exception $e) {
            // Log registration error
            Log::error('Error registering user: ' . $e->getMessage());

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
            'contactEmail' => ['required', 'email','exists:tblstaff'],
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=>$request->contactEmail,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
    
        Mail::send("emails.forgPass",['token' => $token], function($message) use($request)
        {
            $message->to($request->contactEmail);
            $message->subject('Reset Password');
        });
        return redirect()->to(route("forgPass"))->with("success","We have send an email to reset your password.");
    }
    
    public static function showAlert($icon, $title, $text) {
        Session::flash('alertShow',true);
        Session::flash('icon',$icon);
        Session::flash('title',$title);
        Session::flash('text',$text);
    }

}