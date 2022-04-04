<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentityProvider extends Model

{
    protected $fillable = ['user_id', 'provider_name', 'provider_id'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
