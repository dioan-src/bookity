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
        Schema::create('author_country', function (Blueprint $table) {
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('country_id');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('author_id')->references('id')->on('authors')->cascadeOnDelete();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();

            $table->primary(['author_id','country_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('author_country', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['country_id']);
        });

        Schema::dropIfExists('author_country');
    }
};
