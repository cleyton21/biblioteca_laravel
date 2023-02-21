<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function livro($id)
    {
    //    $livros = Livro::find($id)->users; //dados usuarios + dados pivot quando id livro = $id
       $dados = Livro::with('users')->find($id); //dados livro + dados usuarios + dados pivot
       
        return view('emprestimos.livro', [
            'dados' => $dados
        ]);

    }

    public function user($id)
    {
        $dados = User::with('livros')
        ->find($id); //dados livro + dados usuarios + dados pivot

        return view('emprestimos.user', [
            'dados' => $dados
        ]);
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
        DB::beginTransaction();

        try {

        $update = Emprestimo::find($id);
        $update->entregue = 1;
        $update->save();

        DB::commit();
        return redirect()->route('home.index')->with(['mensagem' => 'Livro devolvido com sucesso!', 'alert' => 'success']);

        } catch (\Exception $e) {
            
            DB::rollBack();
            return redirect()->route('home.index')->with(['mensagem' => 'Erro ao devolver livro!', 'alert' => 'danger']);;;
        }
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
