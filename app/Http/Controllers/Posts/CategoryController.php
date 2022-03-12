<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

use ForumHelper;

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
      $category->slug         = ForumHelper::generateSlug(Category::class, $request->name, 1);

      $category->save();

      return redirect()->route('admin.dashboard')->with('success', 'Category created successfully');
    }
}
