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
            // Kiểm tra xem cột 'customer_id' có tồn tại không, rồi mới thực hiện các thao tác
            if (Schema::hasColumn('reviews', 'customer_id')) {
                // Đổi tên cột từ customer_id thành user_id
                $table->renameColumn('customer_id', 'user_id');
                
                // Xóa khóa ngoại cũ nếu có
                $table->dropForeign(['customer_id']);
                
                // Thêm khóa ngoại mới liên kết với bảng users
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Kiểm tra xem cột 'user_id' có tồn tại không, rồi mới thực hiện các thao tác
            if (Schema::hasColumn('reviews', 'user_id')) {
                // Đổi tên cột từ user_id thành customer_id
                $table->renameColumn('user_id', 'customer_id');
                
                // Xóa khóa ngoại cũ nếu có
                $table->dropForeign(['user_id']);
                
                // Thêm lại khóa ngoại cũ liên kết với bảng customers
                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            }
        });
    }
};

