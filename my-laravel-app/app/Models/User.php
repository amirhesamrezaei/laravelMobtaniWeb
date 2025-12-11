<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\Models\Comment;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // فیلدهایی که اجازه پر شدن گروهی دارند
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
    // هر کاربر چندین پست دارد
    return $this->hasMany(Post::class);
    }

    public function comments()
    {
    // هر کاربر می‌تواند چندین کامنت داشته باشد
    return $this->hasMany(Comment::class);
    }

    
}
