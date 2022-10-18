<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUsersAddEmpresasProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordenes_de_trabajos', function (Blueprint $table) {
            $table->unsignedBigInteger('empresa_id')->nullable();

            $table->foreign('empresa_id')->references('empresas')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down($table)
    {
        $table->dropColumn('empresa_id');
    }
}
