<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_language', function (Blueprint $table) {
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('language_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnDelete();

            $table->primary(['book_id','language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_language', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['language_id']);
        });

        Schema::dropIfExists('book_language');
    }
};
