<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'location',
        'condition',
        'description',
        'icon_url',
    ];

    protected $appends = ['desc', 'image'];

    public function getDescAttribute()
    {
        return $this->description;
    }

    public function getImageAttribute()
    {
        return $this->icon_url;
    }
}
