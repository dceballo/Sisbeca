<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('informacion_contacto');
            $table->string('titulo');
            $table->string('slug');
            $table->string('url_imagen');
            $table->text('contenido');
            $table->enum('tipo',['noticia','articulo'])->default('noticia');
            $table->string('url_articulo')->nullable();
            $table->boolean('es_miembro_institucional')->default(false);
            $table->string('email_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->unsignedInteger('editor_id');
            $table->timestamps();
            $table->foreign('editor_id')->references('user_id')->on('editores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
