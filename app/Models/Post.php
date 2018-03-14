<?php

namespace App\Models;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const VISIBILITY = [
        'public' => 'Công khai',
        'private' => 'Riêng tư',
        'password' => 'Đặt mật khẩu'
    ];
    const STATUS = [
        'publish' => 'Xuất bản',
        'draft' => 'Lưu nháp'
    ];
    protected $fillable = ['title', 'content', 'status', 'visibility', 'author', 'date', 'password', 'img_path'];
    public function categories(){
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function user(){
        return $this->belongsTo(User::class,'author', 'id');
    }
}
