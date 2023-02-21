@extends('master');

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Livro</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Livro</li>
            </ol>

            <a style="margin-bottom: 20px;" class="btn btn-warning" type="button" href="{{ url()->previous() }}">Voltar</a>

            <div class="card mb-4">
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" value="{{ $livro->isbn }}" class="form-control" id="isbn" disabled>
                  </div>
                  
                  <br>
                  <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" value="{{ $livro->titulo }}" class="form-control" id="titulo" disabled>
                  </div>
                  <br>
                  <div class="form-group">
                      <label for="subtitulo">Subtítulo</label>
                      <input type="text" name="subtitulo" value="{{ $livro->subtitulo }}" class="form-control" id="subtitulo" disabled>
                  </div>
                  <br>
                  <div class="form-group">
                      <label for="descricao">Descrição</label>
                      <textarea type="text" name="descricao" class="form-control" id="descricao" disabled>{{ $livro->descricao }}</textarea>
                  </div>
                  <br>
                  <div class="form-group">
                      <label for="quantidade">Quantidade</label>
                      <input type="text" name="quantidade" value="{{ $livro->quantidade }}" class="form-control" id="quantidade" disabled>
                  </div>
            </div>
        </div>
    </main>
</div>

@endsection