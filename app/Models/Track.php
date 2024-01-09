<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'artist',
        'image',
        'music',
        'display',
        'play_count',
    ];

    // Tried to add a default value but it says : "Constant expression contains invalid operations"
    
    // protected $attributes = [
    //     'uuid' => 'trk-' . Str::uuid(),
    // ];
}
