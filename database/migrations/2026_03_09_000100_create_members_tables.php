<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('member_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->decimal('fee', 12, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('member_categories')->nullOnDelete();
            $table->string('name');
            $table->string('membership_no')->unique();
            $table->enum('status', ['active','pending','expired','rejected'])->default('active');
            $table->date('valid_until')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status','valid_until']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('member_categories');
    }
};

