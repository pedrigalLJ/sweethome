<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id','notes', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class,'agent_id');
    }
}
