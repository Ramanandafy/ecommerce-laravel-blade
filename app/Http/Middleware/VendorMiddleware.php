<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté et s'il a un rôle de vendeur
        if (Auth::check() && Auth::user()->role === 'Vendor') {
            return $next($request);
        }

        // Redirige l'utilisateur vers la page d'accueil ou une autre page si ce n'est pas un vendeur
        return redirect('/login');
    }
}

