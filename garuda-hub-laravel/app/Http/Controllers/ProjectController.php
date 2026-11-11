<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    private function rules(): array
    {
        return [
            'judul'        => 'required|string|max:200',
            'deskripsi'    => 'required|string|max:5000',
            'kategori'     => 'required|string|max:50',
            'budget_min'   => 'required|integer|min:0',
            'budget_max'   => 'required|integer|gte:budget_min',
            'batas_lelang' => 'required|date|after_or_equal:today',
        ];
    }

    private function authorizeOwner(Project $project): void
    {
        abort_unless($project->client_id === Auth::id(), 403, 'Anda tidak berhak mengelola proyek ini.');
    }

    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $projects = Project::with('client')
            ->withCount('bids')
            ->when($q !== '', function ($query) use ($q) {
                $like = '%' . addcslashes($q, '\\%_') . '%';
                $query->where(fn ($w) => $w->where('judul', 'like', $like)->orWhere('kategori', 'like', $like));
            })
            ->latest('id')
            ->get();

        return view('projects.index', compact('projects', 'q'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['client_id'] = Auth::id(); // dari sesi, bukan dari form
        $data['status'] = 'terbuka';

        Project::create($data);

        return redirect()->route('dashboard')->with('success', 'Proyek berhasil dipasang.');
    }

    public function show(Project $project)
    {
        $project->load('client');
        $bids = $project->bids()->with('developer')
            ->orderByDesc('is_winner')->orderBy('harga')->orderBy('id')->get();

        return view('projects.show', compact('project', 'bids'));
    }

    public function edit(Project $project)
    {
        $this->authorizeOwner($project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorizeOwner($project);

        $rules = $this->rules();
        $rules['batas_lelang'] = 'required|date'; // saat edit, tanggal lama boleh sudah lewat
        $data = $request->validate($rules);

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $this->authorizeOwner($project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
