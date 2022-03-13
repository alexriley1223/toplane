<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\User;

class UserController extends Controller
{
    public function editShow()
    {
      return view('user.edit');
    }

    public function editProfile(Request $request)
    {
      $request->validate([
        'profile_picture' =>  'nullable|file|image|max:1024',
      ]);

      $user = User::where('id', Auth::id())->first();

      // Change Profile Picture
      if($request->profile_picture) {
        $oldpath = $user->picture_url;
        $path = $request->file('profile_picture')->store('images/avatars');
        $user->picture_url = $path;

        if($user->getOriginal('picture_url') != 'images/avatars/profile.png')
        {
          Storage::disk('public')->delete($oldpath);
        }
      }

      $user->save();

      return redirect()->route('user.edit')->with('success', 'Updated successfully');
    }
}
