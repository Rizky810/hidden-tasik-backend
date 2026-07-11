<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'geographic_location',
        'status',
        'description',
        'image_url',
    ];

    protected $appends = ['image', 'location'];

    public function getImageAttribute()
    {
        return $this->image_url;
    }

    public function getLocationAttribute()
    {
        return $this->geographic_location;
    }
}
