<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\File;

class loginregis extends Controller
{
    public  function __construct()
    {
        $this->middleware('web')->except(['logout', 'dashboard']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function Store (Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'photo' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('photo')){
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/photos', $fileNameToStore);
        }else{
           //
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> hash::make($request->password),
            'photo' => $path
        ]);

        $credentials = $request->only('email','password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        ->withSuccess("Welcome! You have Successfully loggedin");
    }

   public function login(){
         return view('auth.login');
   } 

   public function authenticate(Request $request){
         $credentials = $request->validate([
                'email' => 'required', 'email',
                'password' => 'required',
         ]);

         if(Auth::attempt($credentials)){
              $request->session()->regenerate();
              return redirect()->route('dashboard')
              ->withSuccess("Welcome! You have Successfully loggedin");
         }
         return back()->withErrors([
              'email' => 'The provided credentials do not match our records',
         ])->onlyInput('email');
   }

    public function dashboard(){
        
        
        if (Auth::check()) {
            $user = Auth::user(); 
            return view('users', compact('user'));
        }
        return redirect()->route('login')
        ->withErrors(['You are not allowed to access',])->onlyInput('email');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->withSuccess("You have logged out");
    }

    public function editProfile($id)
    {
        $user = User::find($id);
        return view('editprofile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
{
    $user = User::find($id);

    $request->validate([
        'photo' => 'image|nullable|max:1999'
    ]);

    if ($request->hasFile('photo')) {
        $fileName = time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->storeAs('public/photos', $fileName);
        $user->photo = $fileName;
    }

    // Simpan perubahan atribut lain yang ingin diedit
    $user->save();

    return redirect()->route('dashboard')->withSuccess("Profil berhasil diperbarui");
}


}
