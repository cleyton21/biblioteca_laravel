@extends('master');

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            @if(session('mensagem'))
                <div class="alert alert-{{session('alert')}}">
                    <p>{{session('mensagem')}}</p>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Usuários</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('user.index') }}">{{ $users }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Livros</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('livro.index') }}">{{ $livros }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Empréstimos</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="">{{ $emprestimosCount }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Atrasados</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="">{{ $atrasados }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Últimos dias
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Empréstimos semanais
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%" height="40"></canvas>
                        </div>
                        <div style="display:none" id="emprestimos" data-emprestimos="{{ $data }}"></div>
                        <div style="display:none" id="countData" data-countData="{{ $countData }}"></div>

                        <script>
                            var dias = document.getElementById('emprestimos');
                            var count = document.getElementById('countData');
                        
                            const dateFormat = dias.getAttribute("data-emprestimos");
                            const countFormat = count.getAttribute("data-countData");
                        
                            const datas = dateFormat.split(',').reverse();
                            const dados = countFormat.split(',');
                        
                            var numberArray = dados.map(Number).reverse(); //retira as aspas dos itens
                        
                            const maxValue = numberArray.reduce(function(prev, current) { 
                                return prev > current ? prev : current; 
                            });
                        
                        </script>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Empréstimos realizados
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Livro</th>
                                <th>Data Devolução</th>
                                <th>Quantidade</th>
                                <th>LIVRO</th>
                                <th>USER</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emprestimos as $emprestimo)
                            <tr style="text-align: center">
                                <td>{{ $emprestimo->name }}</td>
                                <td>{{ $emprestimo->titulo }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($emprestimo->dt_end)->format('d/m/Y') }}
                                    @if(\Carbon\Carbon::parse($emprestimo->dt_end)->format('Y-m-d') < \Carbon\Carbon::today()->format('Y-m-d'))
                                        <small style="font-size: 0.8rem; color:red">Atrasado</small>
                                    @endif
                                </td>
                                <td>{{ $emprestimo->qnt }}</td>
                                <td>
                                    <a href="{{ route('emprestimo.livro.edit', $emprestimo->id_livro) }}" class="btn btn-success btn-sm">LIVRO</a>
                                </td>
                                <td>
                                    <a href="{{ route('emprestimo.user.edit', $emprestimo->id_user) }}" class="btn btn-warning btn-sm">USER</a>
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

@section('js')
{{-- <script>
    var dias = document.getElementById('emprestimos');
    var count = document.getElementById('countData');

    const dateFormat = dias.getAttribute("data-emprestimos");
    const countFormat = count.getAttribute("data-countData");

    const datas = dateFormat.split(',').reverse();
    const dados = countFormat.split(',');

    var numberArray = dados.map(Number).reverse(); //retira as aspas dos itens

    const maxValue = numberArray.reduce(function(prev, current) { 
        return prev > current ? prev : current; 
    });

</script> --}}
@endsection