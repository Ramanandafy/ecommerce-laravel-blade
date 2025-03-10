@extends('layouts.vendor-dashboard-layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Mes article</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Consulter la liste</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header" style="display: flex; justify-content: flex-end">
<a href=" {{ route('articles.create') }}" class="btn btn-primary btn-sm"> Ajouter un article </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th></th>
                        <th>Libelle</th>
                        <th>Prix</th>
                        <th>Disponiblilite</th>
                        <th>Action</th>

                    </tr>
                </thead>

              @foreach ($articles as $article)
              <tr>
                <td></td>
                <td>{{ $article->name }}</td>
                <td>{{ $article->price }}</td>
                <td>{{ $article->is_active?'Disponible':'Rupture de stock' }}</td>
                <td></td>
            </tr>
              @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
