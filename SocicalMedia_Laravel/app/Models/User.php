<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 🔧 Khóa chính của bảng Users là UserID
    protected $primaryKey = 'UserID';

    // 🔧 Nếu bảng không có created_at và updated_at, bỏ timestamps
    public $timestamps = false;
    public function posts()
    {
        return $this->hasMany(Post::class, 'UserID');
    }
    
    /**
     * Các cột được phép gán dữ liệu hàng loạt
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];
}
