<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Mặc định trong 1 file migrations bắt buộc phải có đủ hàm up và down
    // Hàm up dùng để cập nhật cơ dữ liệu
    // Hàm down là những công việc ngược lại so với hàm up
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ma_san_pham',20)->unique(); // Quy định độ dài và không được phép mã sản phản trùng nhau
            $table->string('ten_san_pham');
            $table->decimal('gia',10,2);
            $table->decimal('gia_khuyen_mai',10,2)->nullable(); // cho phép chứa giá trị null
            $table->unsignedInteger('so_luong');// số nguyên dương
            $table->date('ngay_nhap');
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(true); // xét giá trị default mặc định
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
