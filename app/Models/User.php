<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Customer;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Định nghĩa

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Xét mặc định khi đăng kí role sẽ là user

    protected $attributes = [
        'role' => self::ROLE_USER,
    ];

    // Kiểm tra có phải là ROLE_ADMIN hay không

    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isRoleUser(){
        return $this->role === self::ROLE_USER;
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id');  // Chỉ định rõ khóa ngoại nếu không phải 'user_id'
    }

    public function review(){
        return $this->hasMany(Review::class);
    }
}
