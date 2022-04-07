<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyMorePhotos extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'property_id'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    
}
