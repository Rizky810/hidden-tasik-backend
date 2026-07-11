<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'category',
        'desc',
        'tags',
        'homepage',
        'size',
        'resolution',
        'date',
    ];

    protected $casts = [
        'homepage' => 'boolean',
    ];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        return $this->image_url;
    }
}
