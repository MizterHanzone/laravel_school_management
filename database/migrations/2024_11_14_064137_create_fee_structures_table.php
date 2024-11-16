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
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('academic_id')->constrained('academic_years')->onDelete('cascade');
            $table->foreignId('fee_id')->constrained('fees')->onDelete('cascade');
            $table->string('january')->nullable();
            $table->string('february')->nullable();
            $table->string('march')->nullable();
            $table->string('april')->nullable();
            $table->string('may')->nullable();
            $table->string('june')->nullable();
            $table->string('july')->nullable();
            $table->string('august')->nullable();
            $table->string('september')->nullable();
            $table->string('october')->nullable();
            $table->string('november')->nullable();
            $table->string('december')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
