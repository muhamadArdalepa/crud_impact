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
        Schema::create('chars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('rarity');
            $table->enum('weapon', ['sword', 'claymore', 'polearm', 'catalyst', 'bow']);
            $table->enum('vision', ['pyro', 'hydro', 'electro', 'cryo', 'dendro', 'anemo', 'geo']);
            $table->date('birthday');
            $table->string('constellation');
            $table->string('region');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chars');
    }
};
