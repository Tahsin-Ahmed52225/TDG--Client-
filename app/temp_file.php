<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class temp_file extends Model
{
    protected $table = 'temp_file';
    protected $fillable = [
        'file_name'
    ];
}
