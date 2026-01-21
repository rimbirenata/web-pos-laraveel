<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama', 50);
            $table->string('username', 50)->unique();
            $table->string('password', 50);
            $table->string('no_hp', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
};
