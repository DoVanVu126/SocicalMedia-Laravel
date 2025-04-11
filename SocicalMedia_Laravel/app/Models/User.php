<?php
namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 🔧 Khóa chính của bảng Users là UserID
    protected $primaryKey = 'id';

    // 🔧 Nếu bảng không có created_at và updated_at, bỏ timestamps
    public $timestamps = false;
    public function posts()
    {
        return $this->hasMany(Post::class, 'id');
    }
    
    /**
     * Các cột được phép gán dữ liệu hàng loạt
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'profilepicture',
        'email',
        'phone',
        'two_factor_enabled',
    ];

    /**
     * Các cột bị ẩn khi xuất ra JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kiểu dữ liệu cần ép kiểu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
