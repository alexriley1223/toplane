<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summoner extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'summoners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'summoner_name',
        'region',
        'validated',
    ];

    /**
     * Get the Parent category of this Forum
     */
     public function user()
     {
       return $this->belongsTo(User::class);
     }
}
