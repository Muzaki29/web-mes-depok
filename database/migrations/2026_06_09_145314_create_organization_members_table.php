<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('division');
            $table->string('photo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('period')->default('2026-2029');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->index(['division', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
