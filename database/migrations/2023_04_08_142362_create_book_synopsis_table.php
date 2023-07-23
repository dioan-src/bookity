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
        Schema::create('book_synopses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->unique();
            $table->text('synopsis');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_synopses', function (Blueprint $table) {
            $table->dropIndex(['book_id']);
            $table->dropForeign(['book_id']);
        });

        Schema::dropIfExists('book_synopses');
    }
};
