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
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedBigInteger('isbn')->length(10)->unique();
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('publisher_id');
            $table->timestamp('published_at')->useCurrent();
            $table->unsignedInteger('language_id');
            $table->unsignedInteger('book_type_id');
            $table->unsignedInteger('pages');
            $table->unsignedInteger('original_book_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('author_id')->references('id')->on('authors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('publisher_id')->references('id')->on('publishers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('book_type_id')->references('id')->on('book_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('original_book_id')->references('id')->on('books')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['isbn']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['publisher_id']);
            $table->dropForeign(['book_type_id']);
            $table->dropForeign(['language_id']);
            $table->dropForeign(['original_book_id']);
        });

        Schema::dropIfExists('books');
    }
};
