<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChMessage extends Model
{
    public function user()
    {
        return $this->hasMany(User::class, 'from_id', 'to_id');
    }

}
