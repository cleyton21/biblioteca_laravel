@extends('master')


@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Livros</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Livros</li>
            </ol>

            <a href="{{ url()->previous() }}" class="btn btn-warning" type="button">VOLTAR</a>
            <a style="float: right" href="{{ route('livro.create')}}" class="btn btn-primary" type="button">CADASTRAR</a>
            <br>
            <br>

            @if(session('mensagem'))
                <div class="alert alert-{{session('alert')}}">
                    <p>{{session('mensagem')}}</p>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Livros cadastrados
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Título</th>
                                <th>SubTítulo</th>
                                <th>Qnt</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livros->chunk(10) as $item)
                            @foreach ($item as $livro)
                            <tr>
                                <td>{{ $livro->isbn }}</td>
                                <td>{{ $livro->titulo }}</td>
                                <td>{{ $livro->subtitulo }}</td>
                                <td>{{ $livro->quantidade }}</td>
                                <td>
                                    <a type="button" href="{{ route('livro.show', $livro->slug) }}" class="btn btn-sm btn-success">VER</a>
                                    <a type="button" href="{{ route('livro.edit', $livro->id )}}" class="btn btn-sm btn-warning">EDITAR</a>
                                  
                                    <form style="display: inline" action="{{ route('livro.destroy', $livro->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" href="" 
                                            onclick="return confirm('Tem certeza que deseja deletar este registro?')" 
                                            class="btn btn-sm btn-danger">
                                            EXCLUIR
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection