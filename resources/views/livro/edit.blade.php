@extends('master');

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Livro</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Livro</li>
            </ol>

            <a style="margin-bottom: 20px;" class="btn btn-warning" type="button" href="{{ route('livro.index') }}">Voltar</a>

            @if(session('mensagem'))
                <div class="alert alert-{{session('alert')}}">
                    <p>{{session('mensagem')}}</p>
                </div>
            @endif

            <form method="POST" action="{{ route("livro.update", $livro->id) }}">

                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $livro->id }}">

                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn') ?? $livro->isbn }}" class="form-control @error('isbn') is-invalid @enderror" id="isbn">
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                  <br>
                <div class="form-group">
                  <label for="titulo">Título</label>
                  <input type="text" name="titulo" value="{{ old('titulo') ?? $livro->titulo }}" class="form-control @error('titulo') is-invalid @enderror" id="titulo">
                  @error('titulo')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="subtitulo">Subtítulo</label>
                    <input type="text" name="subtitulo" value="{{ old('subtitulo') ?? $livro->subtitulo }}" class="form-control @error('subtitulo') is-invalid @enderror" id="subtitulo">
                    @error('subtitulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea type="text" name="descricao" class="form-control @error('descricao') is-invalid @enderror" id="descricao">{{ old('descricao') ?? $livro->descricao }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="text" name="quantidade" value="{{ old('quantidade') ?? $livro->quantidade }}" class="form-control @error('quantidade') is-invalid @enderror" id="quantidade">
                    @error('quantidade')
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