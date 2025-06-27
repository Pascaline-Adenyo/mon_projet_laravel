<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_add_photo_columns.php

public function up()
{
   

    // Table visites
    Schema::table('visites', function (Blueprint $table) {
        $table->string('photo')->nullable()->comment("Chemin d'accès à la photo");
    });

    // Table users
    Schema::table('users', function (Blueprint $table) {
        $table->string('photo')->nullable()->comment("Chemin d'accès à la photo");
    });
}

public function down()
{
    Schema::table('locataires', function (Blueprint $table) {
        $table->dropColumn('photo');
    });

    Schema::table('visites', function (Blueprint $table) {
        $table->dropColumn('photo');
    });

    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('photo');
    });
}
};
