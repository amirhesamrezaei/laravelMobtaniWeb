<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // فیلدهایی که قابلیت پر شدن گروهی دارند
    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    // هر پست متعلق به یک کاربر است
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // هر پست چند کامنت دارد
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
