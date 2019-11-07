<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $casts = [
        'is_done' => 'boolean',
    ];
}
