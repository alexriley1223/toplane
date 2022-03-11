<?php

namespace App\Http\Controllers\Posts;

use App\Models\Forum;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    /**
     * Create a new Forum entry
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

      $request->validate([
        'name'          =>  'required',
        'description'   =>  'required',
        'category_id'   =>  'integer|required',
        'order'         =>  'integer|required',
      ]);

      $forum = new Forum;

      $forum->name        = $request->name;
      $forum->description = $request->description;
      $forum->category_id = $request->category_id;
      $forum->slug        = $this->generateSlug($request->name, 1);
      $forum->order       = $request->order;

      $forum->save();

      return redirect()->route('admin.dashboard')->with('success', 'Forum created successfully');
    }

    /**
     * Update the given Forum entry
     * @param   \Illuminate\Http\Request   $request
     * @param   \App\Models\Forum          $forum
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum) {
      $request->validate([
        'name'          =>  'required',
        'description'   =>  'required',
        'category_id'   =>  'integer|required',
      ]);

      $forum->update($request->all());

      return redirect()->route('admin.dashboard')->with('success', 'Forum updated successfully');
    }

    /**
     * Soft delete a given Forum entry
     * @param  \App\Models\Forum          $forum
     * @return  \Illuminate\Http\Response
     */
    public function delete(Forum $forum) {
      $forum->delete();

      return redirect()->route('admin.dashboard')->with('success', 'Forum soft deleted successfully');
    }

    /**
     * Restore a given Forum entry
     * @param  \App\Models\Forum          $forum
     * @return  \Illuminate\Http\Response
     */
    public function restore(Forum $forum) {
      $forum->restore();

      return redirect()->route('admin.dashboard')->with('success', 'Forum restored successfully');
    }

    /**
     * Restore a given Forum entry
     * @param  \App\Models\Forum          $forum
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Forum $forum) {
      $forum->forceDelete();

      return redirect()->route('admin.dashboard')->with('success', 'Forum permanently deleted successfully');
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

      if(Forum::where('slug', $slug)->count() == 0) {
        // Good on first run
        return $slug;
      } else {
        // Recursively find a suitable integer to tack onto the end
        return $this->generateSlug($name, $slugCount+1);
      }
    }
}
