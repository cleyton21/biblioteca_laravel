@extends('master')


@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Usuário:</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ $dados->name }}</li>
                <li class="breadcrumb-item active">{{ $dados->email }}</li>
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
                   Livros deste usuário
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Título</th>
                                <th>Data Entrega</th>
                                <th>Qnt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados->livros as $item)
                            <tr>
                                <td>{{ $item->isbn }}</td>
                                <td>{{ $item->titulo }}</td>
                                <td>
                                    {{ date_br($item->pivot->dt_end) }}
                                    @if($item->pivot->dt_end < Carbon\Carbon::today())
                                        <small style="font-size: 0.8rem; color:red">Atrasado</small>
                                    @endif
                                </td>
                                <td>{{ $item->pivot->qnt }}</td>
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