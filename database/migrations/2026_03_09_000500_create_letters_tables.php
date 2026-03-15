<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('letter_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('numbering_pattern')->default('{DEPT}/{CODE}/{SEQ:3}/{YYYY}');
            $table->enum('reset_cycle', ['year', 'month', 'never'])->default('year');
            $table->timestamps();
        });

        Schema::create('letter_counters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('letter_templates')->cascadeOnDelete();
            $table->string('period'); // e.g. 2026 or 2026-03
            $table->integer('current_seq')->default(0);
            $table->timestamps();
            $table->unique(['template_id', 'period']);
        });

        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable()->constrained('letter_templates')->nullOnDelete();
            $table->enum('direction', ['incoming', 'outgoing'])->default('outgoing');
            $table->string('number')->nullable()->unique();
            $table->string('subject');
            $table->text('body')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('letters');
        Schema::dropIfExists('letter_counters');
        Schema::dropIfExists('letter_templates');
    }
};
