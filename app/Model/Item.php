<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Item extends Eloquent {

    protected $table = 'items';

    protected $fillable = [
        'user_id', 'name', 'koppel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
