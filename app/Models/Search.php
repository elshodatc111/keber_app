<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = [
        'region_id',
        'substanse_id',
        'fio',
        'addres',
        'photo',
        'qyj',
        'data',
        'type',
    ];
}