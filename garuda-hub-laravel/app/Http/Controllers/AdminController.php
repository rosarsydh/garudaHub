<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();
        $projects = Project::with('client')->latest('id')->get();

        return view('admin', compact('users', 'projects'));
    }

    public function setRole(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah peran akun sendiri.');
        }

        $data = $request->validate([
            'role' => 'required|in:klien,developer,admin',
        ]);

        $user->update($data);

        return back()->with('success', 'Peran user diubah.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete(); // proyek dan bid ikut terhapus (cascade)

        return back()->with('success', 'User dihapus.');
    }

    public function destroyProject(Project $project)
    {
        $project->delete(); // bid ikut terhapus (cascade)

        return back()->with('success', 'Proyek dihapus.');
    }
}
