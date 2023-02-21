<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date[] = date('d/m/Y', strtotime('now'));
        array_push($date, date('d/m/Y', strtotime('-1 days')));
        array_push($date, date('d/m/Y', strtotime('-2 days')));
        array_push($date, date('d/m/Y', strtotime('-3 days')));
        array_push($date, date('d/m/Y', strtotime('-4 days')));
               
        $dateFormat = [];
        array_push($dateFormat, implode("-",array_reverse(explode("/",$date[0]))));
        array_push($dateFormat, implode("-",array_reverse(explode("/",$date[1]))));
        array_push($dateFormat, implode("-",array_reverse(explode("/",$date[2]))));
        array_push($dateFormat, implode("-",array_reverse(explode("/",$date[3]))));
        array_push($dateFormat, implode("-",array_reverse(explode("/",$date[4]))));
        
        $countDate1 = Emprestimo::select(DB::raw('sum(qnt) AS total'))
            ->where('dt_ini', '=', $dateFormat[0])
            ->groupBy('dt_ini')
            ->first()
        ;

        $countDate2 = Emprestimo::select(DB::raw('sum(qnt) AS total'))
            ->where('dt_ini', '=', $dateFormat[1])
            ->groupBy('dt_ini')
            ->first()
        ;
       
        $countDate3 = Emprestimo::select(DB::raw('sum(qnt) AS total'))
            ->where('dt_ini', '=', $dateFormat[2])
            ->groupBy('dt_ini')
            ->first()
        ;

        $countDate4 = Emprestimo::select(DB::raw('sum(qnt) AS total'))
            ->where('dt_ini', '=', $dateFormat[3])
            ->groupBy('dt_ini')
            ->first()
        ;

        $countDate5 = Emprestimo::select(DB::raw('sum(qnt) AS total'))
            ->where('dt_ini', '=', $dateFormat[4])
            ->groupBy('dt_ini')
            ->first()
        ;

        $countData = [
            $countDate1->total ?? 0, 
            $countDate2->total ?? 0, 
            $countDate3->total ?? 0, 
            $countDate4->total ?? 0, 
            $countDate5->total ?? 0
        ];

        $users = User::count();
        $livros = Livro::count();
        $emprestimosCount = Emprestimo::where('entregue', 0)->count();
        $atrasados = Emprestimo::where([['entregue', 0], ['dt_end', '<', date('Y-m-d')]])->count();

        $emprestimos = DB::table('emprestimos')
            ->join('users', 'users.id', '=', 'emprestimos.id_user')
            ->join('livros', 'livros.id', '=', 'emprestimos.id_livro')
            ->where('entregue', 0) //0=nao
            ->orderBy('dt_end', 'ASC')
            ->get()
        ;

        // dd($date, $countData);

        return view('home', [
            'users' => $users,
            'livros' => $livros,
            'emprestimosCount' => $emprestimosCount,
            'atrasados' => $atrasados,
            'emprestimos' => $emprestimos,
            'data' => (implode(',', $date)),
            'countData' => (implode(',', $countData))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
