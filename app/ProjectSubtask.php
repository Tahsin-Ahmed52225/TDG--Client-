<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSubtask extends Model
{
    protected $table = 'project_subtask';
    protected $fillable = [
        'Name', 'project_id'
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
