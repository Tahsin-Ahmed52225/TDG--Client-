<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    protected $table = 'project_details';
    protected $fillable = [
        'project_id', 'subtask'
    ];
}
