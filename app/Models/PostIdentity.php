<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostIdentity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_identity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identity',
        'user_id',
        'forum_id',
    ];

    /**
     * Get the Parent category of this Forum
     */
     public function forum()
     {
       return $this->belongsTo(Forum::class);
     }

     public function user()
     {
       return $this->belongsTo(User::class);
     }
}
