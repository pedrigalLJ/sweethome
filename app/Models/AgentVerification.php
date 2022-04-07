<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentVerification extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'birthdate', 'license_no', 'id_picture'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
