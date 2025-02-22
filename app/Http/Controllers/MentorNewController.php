<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MentorNewController extends Controller
{
    public function index()
    {
        $mentor = User::where('role_as', 3)->with('biodata')->get();
        return view('mentor.index', compact('mentor'));
    }
}
