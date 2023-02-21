@extends('master');

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Usuário</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Usuário</li>
            </ol>

            <a style="margin-bottom: 20px;" class="btn btn-warning" type="button" href="{{ route('user.index') }}">Voltar</a>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route("user.update", $user->id) }}">

                @csrf

                @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="form-group">
                  <label for="name">Usuário</label>
                  <input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control @error('name') is-invalid @enderror" id="user">
                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') ?? $user->email }}" class="form-control @error('email') is-invalid @enderror" id="user">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </main>
</div>

@endsection