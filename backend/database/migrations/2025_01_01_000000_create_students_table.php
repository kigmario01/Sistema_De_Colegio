<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('document_type');
            $table->string('document_number')->unique();
            $table->date('birth_date');
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('current_grade');
            $table->string('current_section');
            $table->string('school_year');
            $table->string('status')->default('activo');
            $table->string('guardian_name');
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_email')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['current_grade', 'current_section']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
