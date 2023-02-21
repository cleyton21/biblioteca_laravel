<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return view('user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $attributes = $request->validated(); //valida os dados
            $attributes['level'] = 'user';
            $attributes['password'] = bcrypt('password');
            // $attributes = $request->all();
    
            $create = User::create($attributes);
            $create->setSlug();
    
            DB::commit();
    
            return redirect()->route('user.index')->with(['mensagem' => 'Usuário cadastrado com sucesso!', 'alert' => 'success']);
    
            } catch (\Exception $e) {
                
                DB::rollBack();
    
                return redirect()->route('user.create')->with(['mensagem' => 'Erro ao cadastrar!', 'alert' => 'danger']);;;
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();

        return view('user.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreRequest $request, $id)
    {
        DB::beginTransaction();

        try {
        $attributes = $request->validated(); //valida os dados

        $user = User::where('id', $id)->first();
        $user->update($attributes);
        $user->setSlug();

        DB::commit();
        return redirect()->route('user.index')->with(['mensagem' => 'Usuário editado com sucesso!', 'alert' => 'success']);

        } catch (\Exception $e) {
            
            DB::rollBack();
            return redirect()->route('user.index')->with(['mensagem' => 'Erro ao editar!', 'alert' => 'danger']);;;
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

        $user = User::where('id', $id)
        ->withCount('userDelete')
        ->find($id);

        if ($user->user_delete_count > 0) {
            return redirect()->back()->with(['mensagem' => 'Este usuário tem livro emprestado. Impossível excluir!', 'alert' => 'danger']);
        }

        $delete = $user->delete();

        if ($delete) {
            return redirect()->back()->with(['mensagem' => 'Usuário deletado com sucesso!', 'alert' => 'success']);
        }

        return redirect()->back()->with(['mensagem' => 'Erro ao deletar!', 'alert' => 'danger']);
    }
}
