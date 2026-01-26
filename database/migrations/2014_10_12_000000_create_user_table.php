<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('user')) {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('username', 50);
            $table->string('password');
            $table->string('no_hp', 50);
        });
    }
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
};
