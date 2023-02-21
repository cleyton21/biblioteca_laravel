<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_livro');
            $table->unsignedBigInteger('id_user');
            $table->date('dt_ini');
            $table->date('dt_end');
            $table->boolean('entregue')->default(0)->comment('0=não;1=sim');
            $table->integer('qnt')->default(1)->comment('só faz emprestimos de 1 livro');
            $table->timestamps();
        });

        Schema::table('emprestimos', function (Blueprint $table) {
            $table->foreign('id_livro')->references('id')->on('livros');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprestimos');
    }
}
