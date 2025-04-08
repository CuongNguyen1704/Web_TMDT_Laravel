<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    // $fillable : chọn những trường được phép thêm vào đb

    // protected $fillable = [
    //     'ma_san_pham',
    //     'ten_san_pham',
    //     'category_id',
    //     'hinh_anh',
    //     'gia',
    //     'gia_khuyen_mai',
    //     'so_luong',
    //     'ngay_nhap',
    //     'mo_ta',
    //     'trang_thai',
    // ];

    // $guarded là chọn những trường không được phép thêm vào đb còn lại thêm vô tư
    protected $fillable = [ 'phone', 'address'];

    // Tạo mối liên hệ với Review

// Trong model Customer
public function user()
{
    return $this->belongsTo(User::class);
}
  
}
