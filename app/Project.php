<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'project';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'assign_employee', 'due_date', 'status', 'priority', 'description', 'budget', 'payment_amount', 'manager_id', 'manager_id', 'project_files', 'client_id'
    ];
    /**
     * finding client projects
     *
     * @return client_Projects
     */
    static public function clientProject()
    {
        $client_projects =  DB::table('project')->where('client_id', auth()->user()->id)->where('status', '!=', 'todo')->get(['id', 'name']);
        return $client_projects;
    }
}
