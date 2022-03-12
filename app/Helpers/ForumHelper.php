<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class ForumHelper
{
  /**
   * Generate a slug using Laravel's Helper function and some recursion to avoid duplicates
   * @param  model    $model  Model to reference in slug generation
   * @param  string   $name   String to be converted to slug
   * @param  integer  $count  Iteration of recursion (if needed)
   * @return string   Slug to be inserted in database
   */
    public static function generateSlug($model, $name, $count) {
      $slugCount = $count;
      $slug = Str::slug($name, '-');

      if($slugCount != 1) {
        $slug = $slug . '-' . $slugCount;
      }

      if($model::where('slug', $slug)->count() == 0) {
        // Good on first run
        return $slug;
      } else {
        // Recursively find a suitable integer to tack onto the end
        return ForumHelper::generateSlug($model, $name, $slugCount+1);
      }
    }
}
