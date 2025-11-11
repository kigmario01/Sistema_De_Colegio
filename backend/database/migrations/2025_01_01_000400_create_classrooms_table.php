<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('grade_level');
            $table->string('section');
            $table->unsignedSmallInteger('capacity');
            $table->foreignId('academic_period_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['grade_level', 'section', 'academic_period_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
