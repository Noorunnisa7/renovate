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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('role'); 
            $table->string('NumberOfShares')->default(0)->after('phone');
            $table->string('address')->nullable()->after('NumberOfShares');
            $table->boolean('is_active')->default(1)->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'NumberOfShares', 'address', 'is_active']);
        });
    }
};
