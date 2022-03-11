<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',
        'content',
        'forum_id',
        'slug',
    ];

    /**
     * Get the Parent category of this Forum
     */
     public function forum()
     {
       return $this->belongsTo(Forum::class);
     }

     public function replies()
     {
       return $this->hasMany(Reply::class);
     }
}
