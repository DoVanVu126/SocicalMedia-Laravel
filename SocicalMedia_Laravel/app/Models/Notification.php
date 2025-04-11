<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Thêm dòng này để sử dụng model User


class Notification extends Model
{

    protected $fillable = [
        'user_id',
        'notification_content',
        'is_read'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
