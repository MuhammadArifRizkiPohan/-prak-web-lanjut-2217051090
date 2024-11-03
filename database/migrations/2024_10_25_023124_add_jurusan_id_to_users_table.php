<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJurusanIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('jurusan_id')->nullable()->after('npm'); // Menambahkan kolom jurusan_id
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade'); // Menambahkan foreign key
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['jurusan_id']); // Menghapus foreign key
            $table->dropColumn('jurusan_id'); // Menghapus kolom jurusan_id
        });
    }
}