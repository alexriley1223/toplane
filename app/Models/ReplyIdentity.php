<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyIdentity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reply_identity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identity',
        'user_id',
        'post_id',
    ];

    /**
     * Get the Parent category of this Forum
     */
     public function post()
     {
       return $this->belongsTo(Post::class);
     }

     public function user()
     {
       return $this->belongsTo(User::class);
     }
}
