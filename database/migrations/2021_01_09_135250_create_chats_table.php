<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('dokter_id')->unsigned()->nullable();
            $table->string('pesan')->nullable();
            // $table->enum('status', ['0', '1']); //1 untuk terbaca . . 0 untuk belum
            $table->enum('from', ['0', '1']); //1 untuk user . . 0 untuk dokter
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
        Schema::dropIfExists('chats');
    }
}
