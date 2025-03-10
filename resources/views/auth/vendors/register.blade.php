@extends('layouts.website-layout')
@section('content')

<div class="container">
    <div class="row">
       <div class="col-md-5 mx-auto">
          <h1 class="text-center text-muted mb-3 mt-5">ESPACE VENDEUR</h1>
          <p class="text-center text-muted mb-5">Rejoindre en tant que vendeur.</p>

          @if (Session::get('success'))
              <div class="alert alert-success">{{ Session::get('success') }}</div>
          @endif

          <form method="POST" action="{{ route('vendors.handleRegister') }}" class="row g-3" id="form-register" >

            @method('post')
             @csrf

             <div class="col-md-12">
                <label for="name" class="form-label text-muted">Nom et Prenom</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nom de vendeur" value="{{ old('name') }}">

                @error('name')
                 <div class="text-danger"> {{$message}} </div>

                 @enderror
            </div>

            <div class="col-md-12">
                <label for="email" class="form-label text-muted">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email de la vendeur" value="{{ old('email') }}" >

                @error('email')
                 <div class="text-danger"> {{$message}} </div>

                 @enderror
            </div>

            <div class="col-md-12">
                <label for="password" class="form-label text-muted">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe" >
                @error('password')
                <div class="text-danger"> {{$message}} </div>

                @enderror
            </div>

            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="agreeTerms" value="" >
                    <label class="form-check-label" for="agreeTerms">Agree terms</label> <br>

                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" >Creer mon compte</button>
             </div>

             <p class="text-center text-muted mt-5"> deja un compte ? <a href="{{ route('vendors.login') }}">Connecter</a></p>


          </form>
       </div>
    </div>
</div>
@endsection
