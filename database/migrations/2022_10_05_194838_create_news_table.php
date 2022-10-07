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
        Schema::create('news', function (Blueprint $table) {

            $table->id();
            $table->foreignId('category_id')->constrained('newsCategory');
            $table->string('title')->comment('Загаловок новости');
            $table->text('text')->comment('Текст новости');
            $table->boolean('isPrivate')
                ->default(false)
                ->comment('Доступно ли содержание новости для неавтризованного пользователя');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
