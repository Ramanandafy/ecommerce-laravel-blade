<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
   public function index()
   {
    $articles = Produit::latest()->with('image')->paginate(20);
    return view('welcome', compact('articles'));
   }
}
