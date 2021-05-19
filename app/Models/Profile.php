<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $guarded = [];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function get_profile_image()
    {
        return '/storage/' . ($this->profile_image ? $this->profile_image : 'profile/OhkRSdJy9h5JxtFkqSyDyN2U6IUEhyFsyd3MondF.png');
    }
}
