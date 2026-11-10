<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['client_id', 'judul', 'deskripsi', 'kategori', 'budget_min', 'budget_max', 'batas_lelang', 'status'])]
class Project extends Model
{
    protected function casts(): array
    {
        return [
            'batas_lelang' => 'date',
        ];
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
