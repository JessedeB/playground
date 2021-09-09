<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

    protected $fillable = [
        'name', 'email'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
