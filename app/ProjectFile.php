<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $table = 'project_files';
    protected $fillable = [
        'project_id', 'file_path', 'uploaded_by'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
