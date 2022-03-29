<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Forum;

use ForumHelper;

class ForumController extends Controller
{
    /**
     * Create a new Forum entry
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

      $request->validate([
        'name'          =>  ['required'],
        'description'   =>  ['required'],
        'category_id'   =>  ['required', 'integer'],
        'order'         =>  ['required', 'integer'],
      ]);

      $forum = new Forum;

      $forum->name        = $request->name;
      $forum->description = $request->description;
      $forum->category_id = $request->category_id;
      $forum->slug        = ForumHelper::generateSlug(Forum::class, $request->name, 1);
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
        'name'          =>  ['required'],
        'description'   =>  ['required'],
        'category_id'   =>  ['required', 'integer'],
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
}
