@extends('master');

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Usuário</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Usuário</li>
            </ol>

            <a style="margin-bottom: 20px;" class="btn btn-warning" type="button" href="{{ url()->previous() }}">Voltar</a>

            <div class="card mb-4">
                    <div class="form-group">
                      <input value="{{$user->name}}" class="form-control" id="user" disabled>
                    </div>                
            </div>

            <div class="card mb-4">
                <div class="form-group">
                  <input value="{{$user->email}}" class="form-control" id="email" disabled>
                </div>                
            </div>
        </div>
    </main>
</div>

@endsection