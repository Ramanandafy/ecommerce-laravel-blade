<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userAuthController extends Controller
{
    public function register()
    {
        return view('auth.users.register');
    }

    public function login()
    {
        return view('auth.users.login');
    }

    public function handleRegister(Request $request )
    {
       $request->validate([
          'name'=> 'required',
          'email'=>'required| unique:users,email',
          'password'=>'required|min:4'
       ],
       ['name.required'=>'votre name est requis',
                'email.required'=>'votre adresse mail est requis',
                'email.unique'=>'l adresse mail deja reprise',
                'password.required'=>'votre mot de passe est required',
                'password.min'=>'le mot de passe au moins 4 caractères'
               ]);

               try{

              User::create([
               'name'=>$request->name,
               'email'=>$request->email,
               'password'=>Hash::make($request->password),
              ]);
                 return redirect()->back()->with('success','votre compte a creer avec succes, connecter vous.');
               } catch (Exception $e){

               }
    }

    public function handleLogin(Request $request)
    {
        $request->validate([

            'email'=>'required| exists:users,email',
            'password'=>'required|min:4'
         ],
         [
                  'email.required'=>'votre adresse mail est requis',
                  'email.exists'=>'cette adresse mail n\'est pas reconue',
                  'password.required'=>'votre mot de passe est required',
                  'password.min'=>'le mot de passe au moins 4 caractères'
                 ]);

                 try {
               if (auth()->attempt($request->only('email','password'))){
                    //rediriger sur la page d'acceuil
                    return redirect('/');
               }else{
                return redirect()->back()->with('error', 'Information de connection reconnue');
               }
                 } catch (Exception $e) {

                 }
    }

    public function handleLogout()
    {
   Auth::logout();
   return redirect('/');
    }


}
