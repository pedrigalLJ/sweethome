<?php

namespace App\Models;

use App\Models\PropertyMorePhotos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 
        'title',
        'category', 
        'type', 
        'bathroom', 
        'bedroom', 
        'street_brgy',
        'city',
        'province',
        'featured_image', 
        'price', 
        'status',
        'description',
        'avail_days',
        'avail_times',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'agent_id');
    }

    public function favorite()
    {
        $user_id = auth()->user()!=null ? auth()->user()->id : null;

        return $this->belongsTo(FavoriteProperty::class, 'id', 'property_id')->where('user_id', $user_id);
    }

    public function addToFavorites()
    {
        return $this->favorite()->selectRaw('property_id,count(*) as count')->groupBy('property_id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function morePhotos()
    {
     return $this->hasMany(PropertyMorePhotos::class, 'property_id');
    }
}
