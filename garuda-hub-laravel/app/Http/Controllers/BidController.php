<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $data = $request->validate([
            'harga'    => 'required|integer|min:1|max:999999999999',
            'durasi'   => 'required|integer|min:1|max:3650',
            'proposal' => 'required|string|max:5000',
        ]);

        if (! $project->isOpen()) {
            return back()->with('error', 'Lelang sudah ditutup; penawaran tidak dapat diajukan.');
        }

        $sudah = Bid::where('project_id', $project->id)
            ->where('developer_id', Auth::id())
            ->exists();

        if ($sudah) {
            return back()->with('error', 'Anda sudah mengajukan penawaran pada proyek ini.');
        }

        $project->bids()->create($data + ['developer_id' => Auth::id()]);

        return back()->with('success', 'Penawaran berhasil dikirim.');
    }

    public function pick(Project $project, Bid $bid)
    {
        abort_unless($project->client_id === Auth::id(), 403, 'Proyek ini bukan milik Anda.');
        abort_unless($bid->project_id === $project->id, 404);

        $hasil = DB::transaction(function () use ($project, $bid) {
            // Kunci baris proyek supaya tidak ada dua pemenang
            $p = Project::whereKey($project->id)->lockForUpdate()->first();

            if ($p->status !== 'terbuka') {
                return 'Pemenang sudah dipilih atau lelang sudah ditutup.';
            }

            $bid->update(['is_winner' => true]);
            $p->update(['status' => 'ditutup']);

            return '';
        });

        if ($hasil !== '') {
            return back()->with('error', $hasil);
        }

        return back()->with('success', 'Pemenang berhasil dipilih.');
    }
}
