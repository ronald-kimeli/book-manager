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
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('added_by')->constrained('users');
            $table->string('publisher');
            $table->string('isbn');
            $table->string('category');
            $table->string('sub_category');
            $table->longText('description');
            $table->integer('pages');
            $table->string('image')->nullable();
            $table->string('status')->default('Available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
