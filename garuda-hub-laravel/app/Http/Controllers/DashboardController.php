<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'klien') {
            $projects = Project::where('client_id', $user->id)
                ->withCount('bids')
                ->latest('id')
                ->get();

            return view('dashboard', ['projects' => $projects, 'bids' => collect()]);
        }

        $bids = Bid::where('developer_id', $user->id)
            ->with(['project.client'])
            ->latest('id')
            ->get();

        return view('dashboard', ['projects' => collect(), 'bids' => $bids]);
    }
}
