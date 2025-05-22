<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold',
        'cover_image',
      



    ];
    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
    public function getSlug()
    {
        return Str::slug($this->title);
    }
   public function images()
{
    return $this->hasMany(Image::class);
}
public function getImageUrlAttribute()
{
    return $this->images->isNotEmpty()
        ? asset('storage/' . $this->images->first()->path)
        : asset('images/placeholder.jpg');
}

}
