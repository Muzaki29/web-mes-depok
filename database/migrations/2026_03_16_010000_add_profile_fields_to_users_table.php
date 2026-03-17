<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (! Schema::hasColumn('users', 'organization')) {
                $table->string('organization')->nullable()->after('phone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('users', 'organization')) {
                $columns[] = 'organization';
            }
            if (Schema::hasColumn('users', 'phone')) {
                $columns[] = 'phone';
            }
            if (count($columns) > 0) {
                $table->dropColumn($columns);
            }
        });
    }
};
