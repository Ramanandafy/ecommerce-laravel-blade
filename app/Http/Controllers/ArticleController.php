<?php

namespace App\Http\Controllers;

use App\Models\CloudFile;
use App\Models\Produit;
use DB;
use Exception;
use Illuminate\Http\Request;

 class ArticleController extends Controller
{
    public function index(){

        $articles = Produit::latest()->get();

    return view('dashboard.vendors.articles.index' , compact('articles'));
    }

    public function create(){

        return view('dashboard.vendors.articles.create');
    }

    public function handleCreate(Request $request){
        $request->validate([
            'name' => 'required',
            'price' =>'required'
        ],[
            'name.required' => 'Le nom de produit est requis',
            'price.required' => 'Le prix de produit est requis'
        ]);

        try{

          DB::beginTransaction();
          $ProduitData = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'vendor_id' => auth('Vendor')->user()->id,
          ];

          $produit = Produit::create($ProduitData);

          $this->handleImageUpload($produit, $request, 'image','cloud_files/articles', 'cloud_file_id');
          //gerer ici l'uploade de l'images


          DB::commit();

          return redirect()->route('articles.index')->with('success', 'Produit enregistrer');


        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function handleImageUpload($data, $request, $inputkey, $destination, $attributeName){

        if($request->hasFile($inputkey)){

            //chemin vers le fichier
            $filePath = $request->file($inputkey)->store($destination, 'public');


            $cloudFile = CloudFile::create([
                'path' => $filePath
            ]);

            $data->{$attributeName} = $cloudFile->id;
            $data->update();

        }

    }
}
