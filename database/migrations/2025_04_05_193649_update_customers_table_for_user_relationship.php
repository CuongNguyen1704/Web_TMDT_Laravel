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
        Schema::table('customers', function (Blueprint $table) {
            // Xóa các cột không cần thiết (nếu chưa xóa ở migration trước)
            $table->dropColumn(['name', 'email', 'password', 'created_at', 'updated_at', 'deleted_at']);

            // Đổi tên author_id thành user_id (nếu tồn tại)
            $table->renameColumn('author_id', 'user_id');

            // Thêm ràng buộc khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('customers', function (Blueprint $table) {
            // Bỏ khóa ngoại
            $table->dropForeign(['user_id']);

            // Đổi lại tên cột
            $table->renameColumn('user_id', 'author_id');

            // Thêm lại các cột đã xóa
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
