<?php

// app/Models/Post.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    protected $table = 'Posts';             // nếu table tên là 'Posts'
    protected $primaryKey = 'PostID';       // nếu primary key là 'PostID'
    public $timestamps = false;             // nếu không có created_at, updated_at

    protected $fillable = [
        'UserID', 'Content', 'ImageURL', 'VideoURL', 'CreatedAt'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
