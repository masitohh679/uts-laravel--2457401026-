<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique();
            $table->string('name');
            $table->string('classroom', 20);
            $table->date('birth_date');
            $table->decimal('average_score', 5, 2);
            $table->boolean('is_active')->default(true);
            $table->text('address')->nullable();
            $table->string('parent_phone', 30)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
