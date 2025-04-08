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
        Schema::table('reviews', function (Blueprint $table) {
            // Xóa khóa ngoại liên kết với bảng 'customers'
            // $table->dropForeign(['customer_id']);

            // Xóa cột 'customer_id' (nếu cần thiết)
            // $table->dropColumn('customer_id');
            
            // Thêm cột 'user_id' nếu chưa có
            // $table->unsignedBigInteger('user_id')->nullable();
            
            // Thêm khóa ngoại mới liên kết với bảng 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
};
