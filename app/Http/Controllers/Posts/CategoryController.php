<?php

namespace App\Http\Controllers\Posts;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Create a new Category entry
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

      $request->validate([
        'name'          =>  'required',
        'description'   =>  'required',
        'order'         =>  'integer|required',
      ]);

      $category = new Category;

      $category->name         = $request->name;
      $category->description  = $request->description;
      $category->order        = $request->order;
      $category->slug         = $this->generateSlug($request->name, 1);

      $category->save();

      return redirect()->route('admin.dashboard')->with('success', 'Category created successfully');
    }

    /**
     * Generate a slug using Laravel's Helper function and some recursion to avoid duplicates
     * @param  string   $name   String to be converted to slug
     * @param  integer  $count  Iteration of recursion (if needed)
     * @return string   Slug to be inserted in database
     */
    private function generateSlug($name, $count) {
      $slugCount = $count;
      $slug = Str::slug($name, '-');

      if($slugCount != 1) {
        $slug = $slug . '-' . $slugCount;
      }

      if(Category::where('slug', $slug)->count() == 0) {
        // Good on first run
        return $slug;
      } else {
        // Recursively find a suitable integer to tack onto the end
        $modifiedSlug = $this->generateSlug($name, $slugCount+1);
        return $modifiedSlug;
      }
    }
}
