<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_password_to_locataires_table.php

public function up()
{
    Schema::table('locataires', function (Blueprint $table) {
        $table->string('password')->after('photo');
    });
}

public function down()
{
    Schema::table('locataires', function (Blueprint $table) {
        $table->dropColumn('password');
    });
}
};
