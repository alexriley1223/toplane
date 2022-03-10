<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeratorController extends Controller
{
    public function dashboard()
    {
        return view('auth.dashboard.mod');
    }
}
