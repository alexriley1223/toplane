<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'slug',
        'order',
        'image_url'
    ];

    /**
     * Get the Parent category of this Forum
     */
     public function category()
     {
       return $this->belongsTo(Category::class);
     }

     public function posts()
     {
       return $this->hasMany(Post::class);
     }
}
