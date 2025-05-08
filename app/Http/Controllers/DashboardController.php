<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $userCount = User::count();
        $threadCount = Thread::count();

        $threads = auth()->user()->threads()->latest()->paginate(5);

        return view('dashboard.admin', compact('userCount', 'threadCount', 'threads'));
    }

    public function userDashboard()
    {
        $threads = auth()->user()->threads()->latest()->paginate(5);

        return view('dashboard.user', compact('threads'));
    }
}
