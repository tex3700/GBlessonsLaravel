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
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_in_soc', 20)->default('')->after('isAdmin');
            $table->enum('type_auth', ['site','vk','git'])->default('site')->after('id_in_soc');
            $table->string('avatar', 200)->default('')->after('type_auth');
            $table->index('id_in_soc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id_in_soc','type_auth','avatar']);
        });
    }
};
