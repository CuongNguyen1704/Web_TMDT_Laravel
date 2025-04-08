<?php

namespace App\Models;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';

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
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    // Tạo mối liên hệ với danh mục
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    
}
