@csrf

<label>Judul</label>
<input type="text" name="judul" value="{{ old('judul', $project->judul ?? '') }}">
@error('judul') <div class="error">{{ $message }}</div> @enderror

<label>Deskripsi</label>
<textarea name="deskripsi" rows="4">{{ old('deskripsi', $project->deskripsi ?? '') }}</textarea>
@error('deskripsi') <div class="error">{{ $message }}</div> @enderror

<label>Kategori</label>
<input type="text" name="kategori" value="{{ old('kategori', $project->kategori ?? '') }}">
@error('kategori') <div class="error">{{ $message }}</div> @enderror

<label>Budget Minimum</label>
<input type="number" name="budget_min" value="{{ old('budget_min', $project->budget_min ?? 0) }}">
@error('budget_min') <div class="error">{{ $message }}</div> @enderror

<label>Budget Maksimum</label>
<input type="number" name="budget_max" value="{{ old('budget_max', $project->budget_max ?? 0) }}">
@error('budget_max') <div class="error">{{ $message }}</div> @enderror

<label>Batas Lelang</label>
<input type="date" name="batas_lelang" value="{{ old('batas_lelang', isset($project) ? $project->batas_lelang->format('Y-m-d') : '') }}">
@error('batas_lelang') <div class="error">{{ $message }}</div> @enderror

<br><br>
<button class="btn">Simpan</button>
<a href="{{ route('projects.index') }}" class="btn btn-gray">Batal</a>
