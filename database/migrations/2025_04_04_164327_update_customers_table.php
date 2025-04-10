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
        //
        Schema::table('customers', function (Blueprint $table) {
            $table->string('phone', 30)->change(); // ví dụ sửa độ dài cột
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('customers', function (Blueprint $table) {
            $table->string('phone', 15)->change(); // hoặc độ dài ban đầu
        });
    }
};
