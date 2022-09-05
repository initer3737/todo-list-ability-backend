<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr__todos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained()
                    // ->onUpdate('cascade')
                    // ->onDelete('cascade')
                    ;
            $table->foreignId('title_id')     
                    ->nullable()                
                    ->constrained()             
                    // ->onUpdate('cascade')
                    // ->onDelete('cascade')
                    ;     
            $table->foreignId('todo_id')
                    ->nullable()
                    ->constrained()
                    // ->onUpdate('cascade')
                    ->onDelete('cascade')
                    ;
            $table->timestamps();
        });
    }
            //on delete cascade berarti saat melakukan delete ke tabel induk/master
            //tabel anak /pivot akan terhapus juga
            //contoh saya mendelete data di tabel todos yane idnya bernilai 1
            //maka semua data di tr__todos yang dimana todo_id = 1 akan terhapus semua
            //yang terdelete adalah data todos.id = 1 saja untuk title yang memiliki id 1 masih ada di dalam tabel titles dan tidak terdelete
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr__todos');
    }
};
