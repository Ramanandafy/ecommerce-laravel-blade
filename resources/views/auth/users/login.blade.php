@extends('layouts.website-layout')
@section('content')

<div class="container">
    <div class="row">
       <div class="col-md-5 mx-auto">
          <h1 class="text-center text-muted mb-3 mt-5">MON SHOP</h1>
          <p class="text-center text-muted mb-5">se connecter en tant qu'utilisateur.</p>

          @if (Session::get('error'))
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
          @endif

          <form method="POST" action="{{ route('user.handleLogin') }}" class="row g-3" id="form-login" >

            @method('post')
             @csrf


            <div class="col-md-12">
                <label for="email" class="form-label text-muted">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Votre adresse email" value="{{ old('email') }}" >

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
                <button class="btn btn-primary" type="submit" >Connecter</button>
             </div>

             <p class="text-center text-muted mt-5"> nouveau membre? <a href="{{ route('user.handleRegister') }}">Creer un compte</a>

          </form>
       </div>
    </div>
</div>

@endsection
