<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['project_id', 'developer_id', 'harga', 'durasi', 'proposal', 'is_winner'])]
class Bid extends Model
{
    protected function casts(): array
    {
        return [
            'is_winner' => 'boolean',
        ];
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }
}
