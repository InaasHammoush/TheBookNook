<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
{
    $query = User::query();

    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    $users = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.users.index', compact('users'));
}

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        // Optional: delete related data if needed

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function promote(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->back()->with('message', 'User is already an admin.');
        }

        $user->role = 'admin';
        $user->save();

        return redirect()->back()->with('success', 'User promoted to admin successfully.');
    }

    public function demote(User $user)
    {
        if (!$user->isAdmin()) {
            return redirect()->back()->with('message', 'User is not an admin.');
        }

        $user->role = 'user'; 
        $user->save();

        return redirect()->back()->with('success', 'User demoted from admin successfully.');
    }
}