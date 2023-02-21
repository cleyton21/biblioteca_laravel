@extends('master')


@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Livro:</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ $dados->titulo }}</li>
            </ol>

            <a href="{{ url()->previous() }}" class="btn btn-warning" type="button">Voltar</a>
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
                   Usuários com este livro
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Data inicial</th>
                                <th>Data Final</th>
                                <th>Qnt</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados->users as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ date_br($item->pivot->dt_ini) }}</td>
                                <td>
                                    {{ date_br($item->pivot->dt_end) }}
                                    @if($item->pivot->dt_end < Carbon\Carbon::today())
                                        <small style="font-size: 0.8rem; color:red">Atrasado</small>
                                    @endif
                                </td>
                                <td>{{ $item->pivot->qnt }}</td>
                                <td>
                                    <form style="display: inline" action="{{ route('emprestimo.update', $item->pivot->id) }}" method="POST">
                                        @csrf

                                        @method('PUT')

                                        <input type="hidden" name="id" value="{{ $item->pivot->id }}">

                                        <button type="submit" href="" 
                                            onclick="return confirm('Deseja que o usuário devolva o livro?')" 
                                            class="btn btn-sm btn-danger teste">
                                            DEVOLVER
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