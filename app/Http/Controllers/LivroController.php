<?php

namespace App\Http\Controllers;

use App\Http\Requests\Livro\LivroStoreRequest;
use App\Http\Requests\Livro\LivroUpdateRequest;
use App\Models\Livro;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::get();
        return view('livro.index', [
            'livros' => $livros
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livro.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivroStoreRequest $request)
    {
        DB::beginTransaction();

        try {
        $attributes = $request->validated(); //valida os dados

        $create = Livro::create($attributes);
        $create->setSlug();

        DB::commit();

        return redirect()->route('livro.index')->with(['mensagem' => 'Livro cadastrado com sucesso!', 'alert' => 'success']);

        } catch (\Exception $e) {
            
            DB::rollBack();

            return redirect()->route('livro.create')->with(['mensagem' => 'Erro ao cadastrar!', 'alert' => 'danger']);;;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $livro = Livro::where('slug', $slug)->first();

        return view('livro.show', [
            'livro' => $livro
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = Livro::where('id', $id)->first();
        // dd($livro);
        return view('livro.edit', [
            'livro' => $livro
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(LivroStoreRequest $request, $id)
    {
        DB::beginTransaction();

        try {
        $attributes = $request->validated(); //valida os dados

        $update = Livro::where('id', $id)->first();
        $update->update($attributes);
        $update->setSlug();

        DB::commit();
        return redirect()->route('livro.index')->with(['mensagem' => 'Livro editado com sucesso!', 'alert' => 'success']);

        } catch (\Exception $e) {
            
            DB::rollBack();
            return redirect()->route('livro.index')->with(['mensagem' => 'Erro ao editar!', 'alert' => 'danger']);;;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livro = Livro::find($id);

        $delete = $livro->delete();

        if ($delete) {
            return redirect()->back()->with(['mensagem' => 'Livro deletado com sucesso!', 'alert' => 'success']);
        }

        return redirect()->back()->with(['mensagem' => 'Erro ao deletar!', 'alert' => 'danger']);
    }
}
