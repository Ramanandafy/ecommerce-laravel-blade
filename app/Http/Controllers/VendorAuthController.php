<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorAuthController extends Controller
{
    public function login()
    {
       return view('auth.vendors.login');
    }
    public function register()
    {
       return view('auth.vendors.register');
    }

    public function handleRegister(Request $request )
    {
       $request->validate([
          'name'=> 'required',
          'email'=>'required| unique:vendors,email',
          'password'=>'required|min:4'
       ],
       ['name.required'=>'votre name est requis',
                'email.required'=>'votre adresse mail est requis',
                'email.unique'=>'l adresse mail deja reprise',
                'password.required'=>'votre mot de passe est required',
                'password.min'=>'le mot de passe au moins 4 caractères'
               ]);

               try{

              Vendor::create([
               'name'=>$request->name,
               'email'=>$request->email,
               'password'=>Hash::make($request->password),
              ]);
                 return redirect()->back()->with('success','votre compte vendor a creer avec succes, connecter vous.');
               } catch (Exception $e){

               }
    }

    public function handleLogin(Request $request)
    {
        $request->validate([

            'email'=>'required| exists:vendors,email',
            'password'=>'required|min:4'
         ],
         [
                  'email.required'=>'votre adresse mail est requis',
                  'email.exists'=>'cette adresse mail n\'est pas reconu',
                  'password.required'=>'votre mot de passe est require',
                  'password.min'=>'le mot de passe au moins 4 caractères'
                 ]);

              try {

                if(auth('Vendor')->attempt($request->only('email','password'))){
                 return redirect('vendors/dashboard');
                }else{
                    return redirect()->back()->with('error', 'Information de connection danq la boutique est non reconnu');
                      }
                 } catch (Exception $e) {
                 }
    }
}
