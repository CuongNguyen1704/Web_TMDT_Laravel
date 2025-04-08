<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use SoftDeletes;
    // Để sử dụng được factory tạo dữ liệu mẫu ta phải sử dụng thư viện
    use HasFactory;
    // Quy định model này thao tác với bảng nào
    protected $table = 'categories';
    // Các trường trong bảng đều phải đưa vào fillable
    protected $fillable = [
        'ten_danh_muc',
        'trang_thai',
    ];

    // Tạo mối quan hệ với products
    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }

    
}
