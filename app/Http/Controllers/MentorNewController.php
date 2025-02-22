<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MentorNewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mentor = User::where('role_as', 3) // Role 3 untuk mentor
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('mentor.index', compact('mentor'));
    }

}
