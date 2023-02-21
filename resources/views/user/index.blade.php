@extends('master')


@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Usuários</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Usuários</li>
            </ol>

            <a href="{{ url()->previous() }}" class="btn btn-warning" type="button">VOLTAR</a>
            <a style="float: right" href="{{ route('user.create')}}" class="btn btn-primary" type="button">CADASTRAR</a>
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
                    Lista de Usuários
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Level</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level }}</td>
                                <td>
                                    <a type="button" href="{{ route('user.show', $user->slug )}}" class="btn btn-sm btn-success">VER</a>
                                    <a type="button" href="{{ route('user.edit', $user->id )}}" class="btn btn-sm btn-warning">EDITAR</a>
                                  
                                    <form style="display: inline" action="{{ route('user.destroy', $user->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" 
                                            href="{{route('user.destroy', $user->id)}}" 
                                            onclick="return confirm('Tem certeza que deseja deletar este registro?')" 
                                            class="btn btn-sm btn-danger">
                                            EXCLUIR
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection