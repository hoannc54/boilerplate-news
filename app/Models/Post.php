<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const STATUS = [
        'public' => 'Công khai',
        'draft' => 'Lưu nháp',
        'password' => 'Đặt mật khẩu'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function user(){
        return $this->belongsTo(User::class,'author', 'id');
    }
}
