@extends('layouts.vendor-dashboard-layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Mes article</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter un article</li>
    </ol>

    <div class="card my-4 ">
        <div class="card-header text-center"> Formulaire d'Ajout </div>
        <div class="card-body">

            @if (Session::get('error'))
                <div class="text-danger">{{ Session::get('error') }}</div>
            @endif

            <form action="{{ route('articles.handleCreate') }}" method="POST" enctype="multipart/form-data">
                @method('post')
                @csrf

                <div class="form-group mb-4">
                    <label for="">Image du produit</label>
                    <input type="file" name="image" class="form-control" accept=".png, .jpg" id="">
                </div>


                <div class="form-group mb-4">
                    <label for="">Libelle du produit</label>
                    <input type="text" name="name" class="form-control" placeholder="Iphone 14 pro max exemple" id="">

                    @error('name')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group mb-4">
                    <label for="">prix du produit</label>
                    <input type="number" name="price" class="form-control" placeholder="1300" id="">

                    @error('price')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group mb-4">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id=""></textarea>

                    @error('description')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror

                </div>


               <div style="display: flex; justify-content: center; align-items: center;">
                <button type="submit" class="btn btn-primary" > Enregistrer cet article </button>
               </div>

            </form>
        </div>

    </div>


@endsection
