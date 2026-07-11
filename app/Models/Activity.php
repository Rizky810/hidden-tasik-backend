<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'destination_id',
        'duration',
        'price',
        'description',
        'image_url',
    ];

    protected $appends = ['image', 'desc', 'dest', 'category'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function getImageAttribute()
    {
        return $this->image_url;
    }

    public function getDescAttribute()
    {
        return $this->description;
    }

    public function getDestAttribute()
    {
        return $this->destination ? $this->destination->name : 'Lokasi Umum';
    }

    public function getCategoryAttribute()
    {
        $name = strtolower($this->name);
        if (str_contains($name, 'makan') || str_contains($name, 'kuliner') || str_contains($name, 'liwet')) return 'kuliner';
        if (str_contains($name, 'budaya') || str_contains($name, 'tenun') || str_contains($name, 'batik')) return 'budaya';
        if (str_contains($name, 'hiking') || str_contains($name, 'gunung') || str_contains($name, 'trekking')) return 'wisataalam';
        return 'petualangan';
    }
}
