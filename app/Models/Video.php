<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'course_id',
        'url',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')
                    ->withPivot('like');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
