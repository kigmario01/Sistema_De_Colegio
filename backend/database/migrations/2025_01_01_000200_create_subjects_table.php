<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('grade_level');
            $table->unsignedSmallInteger('credits');
            $table->unsignedDecimal('pass_score', 4, 2)->default(10);
            $table->timestamps();
            $table->index(['grade_level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
